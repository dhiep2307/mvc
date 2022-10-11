<?php
    class Response {
        public static function to($uri = '') {
            if (preg_match('~^(http|https)~is', $uri)) {
                header("Location: " . $uri);
            }
            else {
                header("Location: " . _WEB_ROOT . "/" . $uri);
            }
        }
    }
?>