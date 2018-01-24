<?php

require "Router.php";
require "NotFoundException.php";

class Application {
    public function run() {
        // reporting errors
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        //

        try {
            $router = new Router;
            $router->parseUrl($_SERVER["REQUEST_URI"]);

            $controller_name = $router->controller . 'Controller';
            $controller_path = __DIR__ . "/../modules/" . $router->controller . "/" . $controller_name . ".php";

            if (!file_exists($controller_path)) {
                throw new NotFoundException("Cant find controller");
            }

            require $controller_path;

            $controller = new $controller_name();

            require __DIR__ . "/../config/config.php";

            $controller->setConfig($config);

            $viewmodel = $controller->{$router->action}();
            $viewmodel->render("../modules/" . $router->controller . "/views/index.php");
        } catch (NotFoundException $e) {
            require "ViewModel.php";
            $viewmodel = new ViewModel(array("errors" => $e->getMessage()), "../layouts/main.php");
            $viewmodel->render("../layouts/404.php");
        }
    }
}