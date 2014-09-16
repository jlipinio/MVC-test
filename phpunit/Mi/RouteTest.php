<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.14
 * Time: 18:55
 */

namespace Mi;

use Mi\Exception\MiException;


class RouteTest  extends \PHPUnit_Framework_TestCase
{

    // @codingStandardsIgnoreStart
    public function setUp()
    // @codingStandardsIgnoreEnd
    {
        parent::setUp();
        Route::clear();
    }

    // @codingStandardsIgnoreStart
    public function tearDown()
    // @codingStandardsIgnoreEnd
    {
        parent::tearDown();
        Route::clear();
    }


    function testNull()
    {
        $this->assertNull( Route::get() );
    }

    function testPush()
    {
        $app = new App('test', 'test/');
        Route::push('test', 'test/');

        $this->assertEquals( $app, Route::get('test') );
    }

    function testFindNull()
    {
        $this->assertNull(Route::findByUri(''));
    }

    function testFind()
    {
        try {
            Route::push('HelloWorld', '')->defaults(array('controller' => 'text'));
            $this->assertSame('HelloWorld', Route::findByUri('')->name());

        } catch (MiException $e) {
            $this->fail($e->getMessage());
        }

    }

} 