<?php
namespace Mi;

class ClassLoader
{
    public static function register()
    {
        spl_autoload_register("self::autoLoad");
    }

    public static function getFileName($class)
    {
        $class = ltrim($class, '\\');

        if(strpos($class, 'Mi') !== false) {
            $file  = MI_CLASSES_PATH . preg_replace('#^Mi\\\(.*?)#', '${1}', $class, 1);
        } elseif (strpos($class, 'App') !== false) {
            $file  = APP_PATH . preg_replace('#^App\\\(.*?)\\\#', '${1}' . DS . CLASSES_DIR . DS, $class, 1);
        } else {
            $file  = LIB_PATH . $class;
        }

        $file = str_replace('\\', DS,  $file . EXT );

        return $file;
    }

    public static function autoLoad($class)
    {
        $file = self::getFileName($class);

        if(file_exists($file))
             require_once $file;
    }

} 