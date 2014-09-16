<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 01.09.14
 * Time: 11:55
 */

namespace Mi;


class SandBoxTest extends \PHPUnit_Framework_TestCase
{

    public function test()
    {
        $r = false;
        $words = "пожалуста я же твоя прелесть";
        $pattern = '#(пожалуста я же (твой психолог|твоя прелесть|твоя последняя твоя умная мысля))#i';
        if(preg_match($pattern, $words, $matches))
            $r = true;

        $this->assertTrue($r);




    }
} 