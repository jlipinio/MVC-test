<?
namespace Mi;

use Mi\Component\IConfig;
use Mi\Component\Config;

use Mi\Exception\MiException;
use Mi\Exception\ModelException;

use Mi\Component\DataObject;

class Model extends DataObject
{

    protected $_config;
    protected $_session;

    public function __construct(IConfig $config = null, $data = null)
    {
        if($config !== null)
            $this->_config = new Config($config->data('model'));

        if($data !== null)
            $this->_data = $data;

        $this->_session = new Session();
    }

    public function __set( $name, $value )
    {
        $this->_data[$name] = $value;
    }

    public function &__get( $name )
    {
        return $this->_data[$name];
    }

    public function session()
    {
        return $this->_session;
    }


    public function data($val = null)
    {

        if($val === null) {
            return $this->_session->data() + $this->_data;
        }

        if(is_string($val))
            return $this->_data[$val];

        $this->_data = $val;
        return $this;
    }

}