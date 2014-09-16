<?php
namespace Mi\Response;


class DataJson extends DataType
{

    public static function header()
    {
        return 'Content-type: application/json';
    }

    public static function encode($data, $params = null)
    {
        return json_encode($data);
    }

} 