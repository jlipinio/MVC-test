<?php

namespace Mi;

use Mi\Component\Config;

class ModelTest extends \PHPUnit_Framework_TestCase {

    function testConstruct()
    {
        $config = new Config(array('model' => array()));
        $model = new Model($config);

        $this->assertNotNull( $model->data() );

        return $model;
    }

    /**
     * @depends testConstruct
     */

    public function testSetVar(Model $model) {
        $model->user = "admin";
        $this->assertEquals( array("user" => "admin"), $model->data() );

        return $model;
    }

    /**
     * @depends testSetVar
     */
    public function testReference(Model $model) {
        $user = &$model->user;
        $user = "admin2";
        $this->assertEquals( array("user" => "admin2"), $model->data() );

        return $model;
    }

    /**
     * @depends testReference
     */
    public function testClear(Model $model) {

        $model->clear();
        $this->assertEmpty( $model->data() );

        return $model;
    }

    /**
     * @depends testClear
     */

    function testData(Model $model)
    {
        $data = array('test' => 't1');

        $model->data($data);
        $this->assertSame($model->session()->data() + $data, $model->data());
        $this->assertSame($data['test'], $model->data('test'));

        return $model;
    }

} 