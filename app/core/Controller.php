
<?php
    class Controller {
        public function model($model) {
            if (file_exists("./app/models/" . $model . ".php")) {
                require_once "./app/models/" . $model . ".php";
                if (class_exists($model)) {
                    return new $model();
                }
            }
        }

        public function renderView($view, $data = []) {
            extract($data); // đổi key của mảng thành các biến tương ứng
            if (file_exists("./app/views/" . $view . ".php")) {
                require_once "./app/views/" . $view . ".php";
            }
        }
    }