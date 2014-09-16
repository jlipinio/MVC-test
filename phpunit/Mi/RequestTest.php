<?php

namespace Mi;

class RequestTest extends \PHPUnit_Framework_TestCase {

    public function testParams()
    {
        $request = new Request();

        $params = Array ('id' => '1', 'text' => 'test');
        $request->params($params);

        $this->assertEquals($params, $request->params());
        $this->assertEquals($params['id'], $request->params('id'));
    }

    public function testPattern()
    {
        $request = new Request();

        $pattern = '<test>/test';
        $request->pattern($pattern);

        $this->assertSame($pattern, $request->pattern());
    }

    public function testGenerateUri()
    {
        $request = new Request();
        $request->pattern('test/<action>');

        $params = array(
            'action' => 'index'
        );

        $this->assertSame('test/index', $request->generate_uri($params));
    }

} 