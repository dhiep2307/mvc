<?php 
    class Home extends Controller {

        private $__model;
        function __construct() {
            Session::login('login');
            $this->__model = $this->model("HomeModel");
        }
        
        public function index() {
            $this->renderView('home');
        }

    }