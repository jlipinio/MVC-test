<?php
namespace Mi\Component;


interface IView
{
    public static function getInstance();

    public function file($file = null);
    public function string($str, $data = null);

    public function render($file = null, $data = null);

} 