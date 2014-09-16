<?php

namespace Mi\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testResponse()
    {
        $response = new Response('test');

        $this->expectOutputString('test');
        $response->send(false);
    }

    public function testResponseJson()
    {
        $arr = array('test' => 't1');
        $response = new Response( $arr, Response::HTTP_OK, new DataJson);

        $this->assertJsonStringEqualsJsonString( json_encode($arr), $response->data() );
    }

    public function testResponseSend()
    {
        $response = new Response('test', Response::HTTP_OK, new DataHtml);
        $response->send(false);

        $this->assertTrue(headers_sent());
    }

} 