<?php
namespace Mi\Exception;

class ExceptionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException        \Mi\Exception\MiException
     * @expectedExceptionMessage Error!
     */
    public function testExceptionText()
    {
        throw new MiException('Error!');
    }

    /**
     * @expectedException        \Mi\Exception\MiException
     * @expectedExceptionMessage Error 100!
     */
    public function testExceptionVars()
    {
        throw new MiException('Error :code!', Array(':code' => 100) );
    }

    public function testException() {

        try {
            throw new MiException("Error!");
        }
        catch (MiException $e) {
            return;
        }

        $this->fail('Not error');
    }

} 