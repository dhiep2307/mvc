<?php
    class LoginModel extends DB {

        public function checkUserLogin($form_req = []) {
            if (!empty($form_req['user']) && !empty($form_req['pass'])) {
                // lấy mật khẩu của user trong database
                $pass = $this->selectWhere("password", "user", "username='" . $form_req['user'] . "'");

                if (!empty($pass[0]['password'])) { // kiểm tra user đó có tồn tại hay không
                    $pass = $pass[0]['password'];
                    if (password_verify($form_req['pass'], $pass)) { // đối chiếu mật khẩu
                        // lấy dữ liệu của user nếu mật khẩu trùng khớp
                        $infoUser = $this->selectWhere(
                            "maso_US, linkimage_US, type_US, name_US, email",
                            "user",
                            "username='" . $form_req['user'] . "' AND password='$pass'" 
                        )[0];

                        if (!empty($infoUser['linkimage_US'])) {
                            $infoUser['linkimage_US'] = _WEB_ROOT . '/public/assets/images/users/' . $infoUser['linkimage_US'];
                        }

                        if (!empty($infoUser)) {
                            return $infoUser;
                        }
                    }
                }

            }
            // không tồn tại user hoặc sai mật khẩu sẽ trả về false
            return false;
        }

    }
?>