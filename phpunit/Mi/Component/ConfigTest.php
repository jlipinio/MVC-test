<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.08.14
 * Time: 17:39
 */

namespace Mi\Component;


class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testAsNull()
    {

        $config = new Config();

        $this->assertNull($config->data());
        $this->assertNull($config->data('test'));
    }

    public function testAsArray()
    {
        $data = array('test' => 't1');

        $config = new Config($data);

        $this->assertSame($data, $config->data());
        $this->assertSame($data['test'], $config->data('test'));
    }

    public function testAsFile()
    {
        $config = new Config('../App/HelloWorld/config.php');
        $this->assertNotNull($config->data());
    }

    /**
     * @expectedException \Mi\Exception\MiException
     */
    public function testAsNotFile()
    {
        $config = new Config('nofile.php');
        $this->assertNull($config->data());
    }
} 