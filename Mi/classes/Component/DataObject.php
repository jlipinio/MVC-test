<?php

namespace Mi\Component;

class DataObject implements IDataObject {

    public static function editData(&$data, $val = null, $obj = null)
    {
        if($val === null)
            return $data;

        if(is_string($val))
            return $data[$val];

        $data = $val;
        return $obj;
    }

    public static function editStringData(&$data, $val = null, $obj = null)
    {
        if($val === null)
            return $data;

        $data = $val;
        return $obj;
    }

    protected $_data = array();

    public function bind($key, &$value)
    {
        $this->_data[$key] = &$value;
        return $this;
    }

    public function data($val = null)
    {
        return self::editData($this->_data, $val, $this);
    }

    public function clear()
    {
        $this->_data = array();
        return $this;
    }


} 