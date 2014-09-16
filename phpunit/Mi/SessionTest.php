<?php

namespace Mi;

class SessionTest extends \PHPUnit_Framework_TestCase{

    protected $backupGlobalsBlacklist = array( '_SESSION' );

    public function testOne() {
        $session = new Session();

        $session->user = "admin";
        $this->assertEquals( array("user" => "admin"), $session->data() );
    }



} 