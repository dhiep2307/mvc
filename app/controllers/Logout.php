<?php
    class Logout {
        public function index() {
            Session::delete();
            Response::to('login');
        }
    }