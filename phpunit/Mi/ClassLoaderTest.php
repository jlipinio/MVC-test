<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.08.14
 * Time: 23:14
 */

namespace Mi;


class ClassLoaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider additionProvider
     */
    public function testGetName($class, $path, $exception)
    {
        $full_path = str_replace('\\', DS, ROOT_PATH . $path);

        if($exception) {
            $this->assertSame(ClassLoader::getFileName($class), $full_path);
            //$this->assertFileExists($full_path);
        } else {
            $this->assertNotSame(ClassLoader::getFileName($class), $full_path);
            //$this->assertFileNotExists($full_path);
         }
    }

    public function additionProvider()
    {
        return array(

            array('Mi\View', 'Mi\classes\View.php', true),
            array('Mi\Controller', 'Mi\classes\Controller.php', true),
            array('Mi\Controller', 'Mi\Controller\Controller.php', false),

            array('Mi\Component\IConfig', 'Mi\classes\Component\IConfig.php', true),
            array('Mi\Exception\MiException', 'Mi\classes\Exception\MiException.php', true),

            array('App\HelloWorld\Controller\Text', 'App\HelloWorld\Controller\Text.php', false),
            array('App\HelloWorld\Controller\Text', 'App\HelloWorld\classes\Controller\Text.php', true),

            array('Doctrine\ORM', 'lib\Doctrine\ORM.php', true),
            array('Doctrine\ORM', 'lib\Doctrine\class\ORM.php', false),
        );
    }

} 