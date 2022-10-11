<?php
    class User extends Controller {
        private $__model;
        function __construct() {
            Session::login('login');
            $this->__model = $this->model("UserModel");
        }

        public function index() {
            echo json_encode($this->__model->getInfoUser());
        }
    }