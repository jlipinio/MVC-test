<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.08.14
 * Time: 16:41
 */

namespace Mi\Component;

use Mi\Exception\MiException;


class Config extends DataObject implements IConfig
{
    public function __construct($val = null)
    {
        if($val === null)
            $this->_data = null;
        else if( is_array($val) )
            $this->_data = $val;
        elseif( !file_exists($val) )
            throw new MiException('Not found config file!');
        else
            $this->load($val);
    }

    public function load($file)
    {
        $this->_data = include_once $file;
        return $this;
    }

} 