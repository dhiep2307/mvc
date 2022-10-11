<?php
    class UserModel extends DB {
        public function getInfoUser() {
            $user = Session::login();
            if (isset($user['maso_US'])) {
                unset($user['maso_US']);
            }
            if (!empty($user)) {
                return $user;
            }
        }
    }