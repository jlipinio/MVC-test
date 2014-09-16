<?php

namespace Mi;

use HelloWorld\Controller\Text;
use Mi\Component\Config;


class ControllerTeste extends \PHPUnit_Framework_TestCase
{

    function testConstruct()
    {
        $controller = new Controller( new Config(), new Request());
        $this->assertNotNull( $controller );
    }

} 