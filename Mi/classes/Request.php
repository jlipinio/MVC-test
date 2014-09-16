<?
namespace Mi;

use Mi\Component\DataObject;

class Request extends DataObject
{
    protected $_pattern;

    public function __construct(array $params = null)
    {
        $this->params($params);
    }

    public function params($params = null)
    {
        return $this->data($params);
    }

    public function post($val = null)
    {
        return self::editData($_POST, $val, $this);
    }

    public function get($val = null)
    {
        return self::editData($_GET, $val, $this);
    }

    public  function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

    public function generate_uri($params = null)
    {
        $url = '';

        if($params === null)
            $params = array();

        if($this->_pattern !== null ) {
            $url = $this->_pattern;
            $params = $params + $this->_data;

            foreach($params as $key => $value) {
                $search[] = "<$key>";
                $replace[] = "$value";
            }

            $url = str_replace($search, $replace, $url);
            $url = str_replace(array('\\', '(/)', '(', ')'), '', $url);

            if($params['vars'] === '')
                $url = str_replace('?', '', $url);

        }

        return ltrim($url, '/');
    }


    public function isAjax()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    public function pattern($pattern = null)
    {
        return DataObject::editStringData(
            $this->_pattern,
            $pattern,
            $this
        );
    }


}