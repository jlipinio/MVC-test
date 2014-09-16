<?php

namespace Mi\Component;

interface IConfig extends IDataObject
{
    public function load($file);
} 