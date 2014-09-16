<?php

namespace Mi\Exception;

use Mi\Response\DataHtml;
use Mi\View;
use Mi\Response\Response;

class MiException extends \Exception
{

    public static function getText(\Exception $e)
    {
        return sprintf("%s [ %s ]: %s -> %s [ %d ] \r\n",
            get_class($e), $e->getCode(), strip_tags($e->getMessage()), $e->getFile(), $e->getLine());
    }

    public static function sendHandler(\Exception $e)
    {
        try {
            $view = View::getInstance();

            $response = new Response( $view->render('error', array(
                'error' => array(
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'details' => self::getText($e)
                )
            )), $e->getCode(), new DataHtml);

            $response->send();

        } catch (\Exception $e) {
            ob_get_level();
            ob_clean();

            header('Content-Type: text/plain;', true, $e->getCode());
            echo self::getText($e);
            exit(1);
        }

    }

    public function __construct($message = "", array $variables = null, $code = 0, \Exception $previous = null)
    {
        if(!empty($variables))
            $message = str_replace(array_keys($variables), array_values($variables), $message);

        parent::__construct($message, (int) $code, $previous);
    }

    public function __toString()
    {
        return self::getText($this);
    }




} 