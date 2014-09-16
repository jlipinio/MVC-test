<?php

namespace Mi\Component;


class DataObjectTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAndGet()
    {
        $data = array( 'test' => 't1', 'text' => 'qwer');

        $obj = new DataObject;
        $obj->data($data);

        $this->assertEquals($data, $obj->data());
        $this->assertEquals($data['test'], $obj->data('test'));


    }

    public function testBind()
    {
        $data = array( 'test' => 't1' );
        $ref  = 't2';

        $obj = new DataObject;
        $obj->bind('test', $ref);

        $this->assertNotEquals($data, $obj->data());

        $ref  = 't1';
        $this->assertEquals($data, $obj->data());
    }

} 