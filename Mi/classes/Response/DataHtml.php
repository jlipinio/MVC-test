<?php
namespace Mi\Response;


class DataHtml extends DataType
{

    public static function header()
    {
        return 'Content-type: text/html';
    }

} 