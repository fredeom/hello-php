<?php

class Router {
    var $controller;
    var $action;
    public function parseUrl($url) {
        $parts = explode("/", $url);
        $c = "goods";
        $a = "index";
        switch (count($parts)) {
            case 1:break;
            case 2: $c = empty($parts[1]) ? "goods" : $parts[1]; $a = "index"; break;
            case 3: $c = empty($parts[1]) ? "goods" : $parts[1]; $a = empty($parts[2]) ? "index" : $parts[2]; break;
            default: throw new NotFoundException("too long route");
        }
        $c = ucfirst(strtolower($c));
        $a = explode("?", strtolower($a))[0];

        $this->controller = $c;
        $this->action = $a . "Action";
    }
}