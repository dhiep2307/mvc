<?php
    class Request {

        private $__rules, $__mess;
        
        public static function getMethod() {
            if (!empty($_SERVER['REQUEST_METHOD'])) {
                return strtolower($_SERVER['REQUEST_METHOD']);
            }
            return false;
        }

        public static function isPost() {
            return self::getMethod() == 'post';
        }

        public static function isGet() {
            return self::getMethod() == 'get';
        }

        public static function getFields() {
            $arr = [];
            // get data get method
            if (self::isGet()) {
                if (!empty($_GET)) {
                    foreach ($_GET as $key => $value) {
                        $arr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
            // get data post method
            if (self::isPost()) {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $arr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                } 
            }
            // return data array
            return $arr;
        }

        public function setRules($rules = []) {
            $this->__rules = $rules;
        }

        public function setMessage($mess = []) {
            $this->__mess = $mess;
        }

        public function validate() {

        }

        public function errors() {

        }
    }

?>