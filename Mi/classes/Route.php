<?php
namespace Mi;

use Mi\Exception\MiException;

class Route
{

    protected static $_apps = array();

    static function push($name, $uri, array $regex = null)
    {
        return self::$_apps[$name] = new App($name, $uri, $regex);
    }

    static function get($name = null)
    {
        if($name === null)
            self::$_apps;

        return self::$_apps[$name];
    }

    static function clear()
    {
        self::$_apps = array();
    }

    static function findByUri($uri, &$params = null)
    {
        if(empty(self::$_apps))
            return null;

        foreach(self::$_apps as $key => $app) {
            if($app->match($uri, $params))
                return $app;
        }
        return null;
    }

    static function run()
    {
        $request = new Request();
        $params = null;

        if($app = self::findByUri($request->uri(), $params)) {

            $request
                    ->params($params)
                    ->pattern($app->pattern());

            $app
                ->request($request)
                ->run();

            return;
        }

        MiException::sendHandler( new MiException('Not found app!') );
    }

} 