<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.14
 * Time: 16:15
 */

namespace Mi;

use Mi\Exception\ViewException;

class ViewTest extends \PHPUnit_Framework_TestCase
{

    public function testData()
    {
        $view = new View();
        $data = array('test' => 't1');

        $this->assertEmpty( $view->data() );

        $view->data($data);
        $this->assertSame($data, $view->data());
        $this->assertSame($data['test'], $view->data('test'));
    }

    public function testRender()
    {
        $view = new View();
        $data = array('text' => 't1');

        $this->assertSame('Text:' . $data['text'], $view->render('test', $data));
    }

    public function testString()
    {
        $view = new View();
        $data = array('text' => 'world!');

        $this->assertSame('Hello ' . $data['text'], $view->string('Hello {{text}}', $data));
    }

    public function testInstance()
    {
        $view = View::getInstance();

        $this->assertNotNull($view);
        $this->assertSame('Mi\View', get_class($view));

        $view2 = new View();
        $this->assertNotSame($view2, $view);

        $this->assertSame($view2, $view::getInstance());
        $this->assertSame($view2::getInstance(), $view::getInstance());
    }

    /**
     * @dataProvider providerFile
     */

    public function testLoadFile($file, $exception)
    {
        try
        {
            $view = new View();
            $view->file($file);

            $this->assertSame(false, $exception);
        }
        catch(ViewException $e)
        {
            $this->assertSame(true, $exception);
        }
    }

    public function providerFile()
    {
        return array(
            array('test', false),
            array('index', false),
            array('error', false),
            array('not_file', true),
        );
    }


} 