<?php
    class Connection {
        private static $instance = null, $conn = null;

        private function __construct($config){
            //Kết nối database
            try{

                //Cấu hình dsn
                $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'];

                //Cấu hình $options
                /*
                * - Cấu hình utf8
                * - Cấu hình ngoại lệ khi truy vấn bị lỗi
                * */
                $options = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];
                //Câu lệnh kết nối
                $con = new PDO($dsn, $config['user'], $config['pass'], $options);

                self::$conn = $con;

            }catch (Exception $exception){
                $mess = $exception->getMessage();
                App::loadErrors('database', ['message'=>$mess]);
                die();
            }
        }
        // Chống lại việc kết nối database lại nhiều lần
        public static function getInstance($config){
            if (self::$instance == null)
            {
                $connection = new Connection($config);
                self::$instance = self::$conn;
            }

            return self::$instance;
        }
    }