<?php

namespace Mi\Response;


interface IDataType
{

    public static  function header();
    public static function encode($data, $params = null);

} 