<?
namespace Mi\Response;

use Mi\Component\DataObject;
use Mi\Exception\MiException;

class ResponseJson extends Response
{

    function __construct($data)
    {
        parent::__construct($data, parent::HTTP_OK, new DataJson);
    }

}