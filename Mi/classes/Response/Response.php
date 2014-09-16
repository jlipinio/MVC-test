<?
namespace Mi\Response;

use Mi\Component\DataObject;
use Mi\Exception\MiException;

class Response extends DataObject implements IResponse
{

    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;

    public static $messages = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',

        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',

        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );

    public static function redirect($url, $code = 301)
    {
        header("Cache-Control: no-cache");
        header('Location: /' . $url, true, $code);
        die();
    }

    protected $_header;

    function __construct($data, $code = 200, IDataType $data_type = null)
    {
        $this->_header = array(
            'HTTP/1.0' . $code . static::$messages[$code]
        );

        if($data_type === null)
            $data_type = new DataType;

        $this->push_header($data_type::header());
        $this->_data = $data_type::encode($data);
    }

    public function push_header($header)
    {
        $this->_header[] = $header;
    }

    protected function send_header($headers)
    {
        foreach($headers as $header) {
            if(is_array($header))
                $this->send_header($header);
            else
                header($header);
        }

    }

    public function send($exit = true)
    {
        if(!headers_sent())
            $this->send_header($this->_header);

        echo $this->_data;

        if($exit)
            exit(1);
    }



}