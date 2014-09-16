<?php

namespace Mi\Component;

interface IDataObject
{
    public static function editData(&$data, $val = null, $obj = null);

    public function bind($key, &$value);
    public function data($val = null);
    public function clear();
} 