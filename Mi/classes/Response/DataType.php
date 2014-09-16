<?php

namespace Mi\Response;


class DataType implements IDataType
{

    public static function header()
    {
        return '';
    }

    public static function encode($data, $params = null)
    {
        return $data;
    }

} 