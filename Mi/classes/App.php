<?
namespace Mi;

use Mi\Exception\MiException;
use Mi\Component\DataObject;
use Mi\Component\Config;


class App
{
    const REGEX_SEGMENT = '[\w\d]+';

    static function compile($pattern, array $regex = null)
    {

        $expression = $pattern;
        if (strpos($expression, '(') !== false)
            $expression = str_replace(array('(', ')'), array('(?:', ')?'), $expression);

        if (strpos($expression, '<') !== false)
            $expression = str_replace(array('<', '>'), array('(?P<', '>' . self::REGEX_SEGMENT . ')'), $expression);

        if ($regex) {
            $search = $replace = array();

            foreach ($regex as $key => $value) {
                $search[] = "<$key>" . self::REGEX_SEGMENT;
                $replace[] = "<$key>$value";
            }

            $expression = str_replace($search, $replace, $expression);
        }

        return '#^'.$expression.'$#uD';
    }

    static function getAppPath($name)
    {
        return APP_PATH . $name . DS;
    }

    static function getClassController($app_name, $class_name)
    {
        return 'App\\' . $app_name . '\\Controller\\' . ucwords($class_name);
    }

    protected $_name;
    protected $_pattern;
    protected $_regex;

    protected $_default = array( 'action' => 'index', 'config' => 'config.php' );

    protected $_request;

    function __construct($name, $pattern, array $regex = null)
    {
        $this->_name  = $name;

        $this->_pattern = $pattern.'(\?<vars>)';
        $regex['vars'] = '.*?';

        $this->_regex = self::compile($this->_pattern, $regex);

        $this->_request  = new Request();
    }

    public function match($uri, array &$params = null)
    {
        if(!preg_match($this->_regex, $uri, $matches))
            return false;

        $params = $this->_default;
        foreach ($matches as $key => $val) {
            if(!is_int($key) && !($params[$key] !== '' && $val === ''))
                $params[$key] = $val;
        }

        return true;
    }

    public function controller($name, $config_name)
    {
        $controller_class = self::getClassController($this->_name, $name);
        $config_file      = self::getAppPath($this->_name) . $config_name;

        if(class_exists($controller_class))
            return new $controller_class( new Config($config_file), $this->_request);

        throw new MiException('Not found in app \':app_name\' controller \':controller\' !',
            array(
                ':app_name' => $this->_name,
                ':controller' => $controller_class
            ));

        return null;
    }

    public function run()
    {
        try {
            $params = $this->_request->params();

            $controller = $this->controller(
                $params['controller'],
                $params['config']
            );

            $controller
                        ->action( $params['action'] )
                        ->send();

        } catch (MiException $e) {
            MiException::sendHandler($e);
        }
    }

    public function defaults(array $default = null)
    {
        return DataObject::editData(
            $this->_default,
            ($default === null)? null: $default + $this->_default,
            $this
        );
    }

    public function name($name = null)
    {
        return DataObject::editStringData(
            $this->_name,
            $name,
            $this
        );
    }

    public function pattern($pattern = null)
    {
        return DataObject::editStringData(
            $this->_pattern,
            $pattern,
            $this
        );
    }

    public function regex($regex = null)
    {
        return DataObject::editStringData(
            $this->_regex,
            $regex,
            $this
        );
    }

    public function request(Request $request = null)
    {
        return DataObject::editData(
            $this->_request,
            $request,
            $this
        );
    }

}