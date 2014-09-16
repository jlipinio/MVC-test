<?php
namespace Mi\Component;

class ConfigYAML extends Config
{
    public function load($file)
    {
        $this->_data = yaml_parse_file($file);
        return $this;
    }

} 