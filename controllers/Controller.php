<?php

class Controller {
    static function createView($viewName){
        require_once("./views/$viewName.php");
    }

}