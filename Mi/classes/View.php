<?
namespace Mi;


use Mi\Component\Config;
use Mi\Component\DataObject;
use Mi\Component\IConfig;
use Mi\Component\IView;
use Mi\Exception\ViewException;

class View extends DataObject implements IView
{

    protected static $_instance;

    final public static function getInstance()
    {
        if (View::$_instance === null)
            View::$_instance = new static();

        return View::$_instance;
    }

    protected $_config;
    protected $_file;

    protected $_loader;
    protected $_twig_temp;
    protected $_twig_str;
    protected $_template;

    public function __construct(IConfig $config = null)
    {

        View::$_instance = $this;

        if($config !== null)
            $this->_config = new Config($config->data('view'));

        $this->_loader = new \Twig_Loader_Filesystem(
            ($this->_config)? ROOT_PATH . $this->_config->data('path'): MI_TEMPLATE_PATH
        );

        $this->_twig_temp = new \Twig_Environment($this->_loader);
        $this->_twig_str  = new \Twig_Environment( new \Twig_Loader_String());

        $this->_file = 'error';
    }

    public function file($file = null)
    {
        if($file === null)
            return $this->_file;

        $this->_file = $file;
        $file = $this->_file . EXT_TEMPLATE;

        try {
            $this->_template = $this->_twig_temp->loadTemplate($file);
        } catch (\Twig_Error_Loader $e) {
            throw new ViewException(
                'Not file \':file\' for template!',
                array(':file' => $file)
            );
        }

        return $this;
    }

    public function string($str, $data = null)
    {
        if($data === null)
            $data = $this->_data;

        return $this->_twig_str->render($str, $data);
    }

    public function render($file = null, $data = null)
    {
        if($file !== null)
             $this->file($file);

        if($data === null)
            $data = $this->_data;

        if($this->_template === null)
            throw new ViewException('Template is null!');

        return $this->_template->render($data);
    }
}