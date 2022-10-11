<?php
    class App {

        private $__controller, $__action, $__params;
        private $__route;

        function __construct() {
            global $routes;

            if (!empty($routes['default_controller'])) {
                $this->__controller = $routes['default_controller'];
            }

            $this->__action = 'index';
            $this->__params = [];
            $this->__route = new Route();

            $this->handleUrl();
        }

        public function getUrl() {
            if (!empty($_SERVER['PATH_INFO'])) {
                $url = $_SERVER['PATH_INFO'];
            }
            else {
                $url = '/';
            }
            return $url;
        }

        public function handleUrl() {
            
            $url = $this->getUrl();
            $url = $this->__route->handleRoute($url);
            
            $urlArr = array_values(array_filter(explode("/", $url)));

            $urlCheck = '';
            if (!empty($urlArr)) {
                foreach ($urlArr as $key => $item) {
                    $urlCheck = strtolower($urlCheck) . "/" . ucfirst($item);
                    $fileCheck = rtrim($urlCheck, '/');
                    if (!empty($urlArr[$key - 1])) {
                        unset($urlArr[$key - 1]);
                    }
                    if (file_exists('./app/controllers/'.($fileCheck).'.php')) {
                        $urlCheck = $fileCheck;
                        break;
                    }
                }
                $urlArr = array_values($urlArr);
            }
            // controller handle
            if (!empty($urlArr[0])) {
                $this->__controller = ucfirst($urlArr[0]);
            }
            else {
                $this->__controller = ucfirst($this->__controller);
            }

            if (empty($urlCheck)) {
                $urlCheck = $this->__controller;
            }
            
            if (file_exists('./app/controllers/'.($urlCheck).'.php')) {
                require_once './app/controllers/'.($urlCheck).'.php';

                if (class_exists($this->__controller)) {
                    $this->__controller = new $this->__controller();
                }
                else {
                    $this->loadErrors();
                }
                unset($urlArr[0]);
            }
            else {
                $this->loadErrors();
            }

            // action handle
            if (!empty($urlArr[1])) {
                $this->__action = $urlArr[1];
                unset($urlArr[1]);
            }

            //params handle
            $this->__params = array_values($urlArr);
            
            if (method_exists($this->__controller, $this->__action)) {
                call_user_func_array([$this->__controller, $this->__action], $this->__params);
            }
            else {
                $this->loadErrors();
            }
        }

        public static function loadErrors($err = '404', $data = []) {
            extract($data);
            if (file_exists('./app/errors/' . $err . '.php')) {
                require_once './app/errors/' . $err . '.php';
            }
        }

    }