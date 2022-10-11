<?php
    class Session {
        /**
         * 
         * data(key, value) => set Session
         * data(key) => get Session
         * 
         */
        public static function data($key= '', $value = '') {
            $sessionKey = self::isInvalid();

            if (!empty($value)) {
                if (!empty($key)){
                    $_SESSION[$sessionKey][$key] = $value; //set session
                    return true;
                }
                return false;
            }
            else {
                if (empty($key)){
                    if (isset($_SESSION[$sessionKey])){
                        return $_SESSION[$sessionKey];
                    }
                }
                else {
                    if (isset($_SESSION[$sessionKey][$key])){
                        return $_SESSION[$sessionKey][$key]; //get session
                    }
                }
            }
        }

        /*
        * delete(key) => Xoá session với key
        * delete() => Xoá hết session
        * */
        public static function delete($key = '') {
            $sessionKey = self::isInvalid();
            if (!empty($key)) {
                if (isset($_SESSION[$sessionKey][$key])) {
                    unset($_SESSION[$sessionKey][$key]);
                    return true;
                }
                return false;
            }
            else {
                unset($_SESSION[$sessionKey]);
                return true;
            }
            return false;
        }

        /*
        * Flash Data
        * - set flash data => giống như set session
        * - get flash data => giống như get session, xoá luôn session sau khi get
        *
        * */
        public static function flash($key = '', $value = '') {
            $dataFlash = self::data($key, $value);
            if (empty($value)) {
                self::delete($key);
            }
            return $dataFlash;
        }

        public static function showErrors($message) {
            $data = ['message' => $message];
            App::loadErrors('exception', $data);
            die();
        }

        static function isInvalid() {
            global $session_config;
            if (!empty($session_config)){
                if (!empty($session_config['session_key'])){
                    $sessionKey = $session_config['session_key'];
                    return $sessionKey;
                }
                else {
                    self::showErrors('Thiếu cấu hình session_key. Vui lòng kiểm tra file: configs/session.php');
                }
            }
            else {
                self::showErrors('Thiếu cấu hình session. Vui lòng kiểm tra file: configs/session.php');
            }
        }

        public static function login($url = 'login') {
            if (self::data('user')) {
                return self::data('user');
            }
            if (!empty($url)) {
                Response::to($url);
            }
        }

    }

?>