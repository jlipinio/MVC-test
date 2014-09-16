<?

namespace Mi;

use Mi\Exception\MiException;

class AppTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateController()
    {
        $app = new App('HelloWorld', '');
        $controller = $app->controller('text','config.php');

        $this->assertNotNull($controller);
        $this->assertNotSame('Mi\Controller', get_class($controller));
    }

    /**
     * @expectedException        \Mi\Exception\MiException
     */
    public function testNotCreateController()
    {
        $app = new App('NotApp', '');
        $controller = $app->controller('NotAction','NotConfig.php');
    }

    /**
     * @dataProvider additionProvider
     */
    public function testMatch($data)
    {
        $uri = $data['uri'];

        $app = new App('Test', $data['pattern'], $data['regex']);

        $app->defaults( $data['default'] );
        $data['params'] = array_merge($app->defaults(), $data['params']);

        if($data['bool']){
            $this->assertTrue($app->match($uri, $parmas));
            $this->assertEquals($data['params'], $parmas);
        } else {
            $this->assertFalse($app->match($uri));
        }


    }

    public function additionProvider()
    {
        return array(
            array (
                array(
                    'uri' => 'begin/act1',
                    'pattern' => 'begin/<action>',
                    'regex' => Array( ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'act1', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/act1?test=123',
                    'pattern' => 'begin/<action>',
                    'regex' => Array( ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'act1', 'controller' => 'c_test', 'vars' => 'test=123'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/lol',
                    'pattern' => 'begin/(<action>/)lol',
                    'regex' => Array( ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'index', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/',
                    'pattern' => 'begin/(<id>/)',
                    'regex' => Array( 'id' => '\d+' ),
                    'bool' => true,
                    'default' => Array('id' => 1, 'controller' => 'c_test'),
                    'params'  => Array('id' => 1, 'action' => 'index', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/777/',
                    'pattern' => 'begin/<id>/',
                    'regex' => Array( 'id' => '\d+' ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('id' => 777 , 'action' => 'index', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/lol/',
                    'pattern' => 'begin/<id>/',
                    'regex' => Array( 'id' => '\d+' ),
                    'bool' => false,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('id' => 'lol' , 'action' => 'index', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'begin/act3/lol',
                    'pattern' => 'begin/(<action>/)lol',
                    'regex' => Array( ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'act3', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'end/act1',
                    'pattern' => 'begin/<action>',
                    'regex' => Array( ),
                    'bool' => false,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'act1', 'controller' => 'c_test'),
                )
            ),

            array (
                array(
                    'uri' => 'hello/world.php',
                    'pattern' => '<controller>/(<action>.<format>)',
                    'regex' => Array( 'format' => '(php|html)' ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'world', 'controller' => 'hello', 'format' => 'php'),
                )
            ),

            array (
                array(
                    'uri' => 'hello/world',
                    'pattern' => '<controller>/(<action>.<format>)',
                    'regex' => Array( 'format' => '(php|html)' ),
                    'bool' => false,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'world', 'controller' => 'hello', 'format' => 'php'),
                )
            ),

            array (
                array(
                    'uri' => 'guestbook/',
                    'pattern' => '<controller>/(<id>/)(<action>.<format>)',
                    'regex' => Array( 'id' => '\d+', 'format' => '(php|html)' ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('action' => 'index', 'controller' => 'guestbook'),
                )
            ),

            array (
                array(
                    'uri' => 'guestbook/100/',
                    'pattern' => '<controller>/(<id>/)(<action>.<format>)',
                    'regex' => Array( 'id' => '\d+', 'format' => '(php|html)' ),
                    'bool' => true,
                    'default' => Array('controller' => 'c_test'),
                    'params'  => Array('id' => 100, 'action' => 'index', 'controller' => 'guestbook'),
                )
            ),

        );
    }
} 