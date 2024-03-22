<?php

    class Config {
        private $server;
        private $depImg;
        private $depJs;
        private $depCss;
        private $directory;

        public function __construct() {
            $this->server = 'http://back-end.local/';
            $this->depImg = $this->server . 'public/img/';
            $this->depJs = $this->server . 'public/js/';
            $this->depCss = $this->server . 'public/css/';
            $this->directory = array(
                'home' => 'view/home',
                'login' => 'view/login',
                'error' => 'view/error'
            );
        }

        public function getServer() {
            return $this->server;
        }

        public function getDepImg() {
            return $this->depImg;
        }

        public function getDepJs() {
            return $this->depJs;
        }

        public function getDepCss() {
            return $this->depCss;
        }

        public function getDirectory() {
            return $this->directory;
        }
    }

?>
