<?php 
    class Equipment extends Controller {

        private $__model;
        private $__userInfo;
        function __construct() {
            $this->__userInfo = Session::login('login');
            $this->__model = $this->model("EquipmentModel");
        }

        public function index() {
            echo json_encode($this->__model->getInfoEquipments($this->__userInfo));
        }
    }