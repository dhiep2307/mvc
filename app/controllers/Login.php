<?php
    class Login extends Controller {

        private $__model;

        public function index() {
            if (Session::data('user')) {
                Response::to('home');
            }
            $this->renderView('login');
        }

        // public function check() { // để tạm chưa xử lý
        //     $req = new Request();

        //     $req->setRules([
        //         'username' => 'require',
        //         'password' => 'require'
        //     ]);

        //     $req->setMessage([
        //         'username.require' => "Tên đăng nhập không được bỏ trống",
        //         'password.require' => "Mật khẩu không được bỏ trống"
        //     ]);
        // }

        public function submit() {
            $this->__model = $this->model('LoginModel');

            $req = new Request();
            $info = $this->__model->checkUserLogin($req->getFields()); 
            if (!empty($info)) {
                /// luu session
                Session::data("user", $info);
                Response::to("home");
            }
            else {
                Response::to("login");
            }
        }

    }
?>
