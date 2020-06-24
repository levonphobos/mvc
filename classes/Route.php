<?php


class Route
{
    static $validRoutes = array();

    static function set($route, $function){
        self::$validRoutes[] = $route;
        if($_GET['url'] === $route) {
            $function->__invoke();
        }
    }

}