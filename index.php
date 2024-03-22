<?php

    require_once realpath('./vendor/autoload.php');
    require_once './app/config/Config.php';

    class Router {
        private $config;

        public function __construct() {
            $this->config = new Config();
        }

        public function route() {
            $view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'home';
            $directory = $this->config->getDirectory();
            if (array_key_exists($view, $directory)) {
                require_once $directory[$view] . '.view.php';
            } else {
                require_once $directory['error'] . '.view.php';
            }
        }

    }

    $router = new Router();
    $router->route();

?>
