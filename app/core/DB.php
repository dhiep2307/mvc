<?php

class DB {

    public $conn;

    function __construct() {
        global $db_config;
        $this->conn = Connection::getInstance($db_config);
    }
    // ví dụ truyền vào :
    // $tablename = MyGuests
    // $content = "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //              firstname VARCHAR(30) NOT NULL,
    //              lastname VARCHAR(30) NOT NULL,
    //              email VARCHAR(50),
    //              reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
    public function creactTable($tablename, $content) {
        try {              
            // sql to create table
            $sql = "CREATE TABLE $tablename ($content)";
          
            // use exec() because no results are returned
            $this->conn->exec($sql);
            // echo "Table $tablename created successfully";
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return $sql . "<br>" . $e->getMessage();
        }
        $this->conn = null;
    }
    

    // ví dụ:
//          $tablename = "user"
//          $properties = username, password
//          $value      = admin , 12345678       // value tương ứng với các trường dữ liệu của $properties truyền vào
//         
    public function insert($tablename, $properties, $value) {
        try {
            $sql = "INSERT INTO $tablename ($properties) VALUES ($value)";
            // use exec() because no results are returned
            $this->conn->exec($sql);
            return $this->conn->lastInsertId();
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return $sql . "<br>" . $e->getMessage();
        }
        $this->conn = null;
    }


    // truyền vào tên của bảng
    public function selectAllTable($tablename) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM $tablename");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->conn = null;
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    
    // ví dụ truyền vào:
    // $properties = "id_user, fullname"
    // $tablename = "user"
    public function selectFrom($properties, $tablename) {
        try {
            $stmt = $this->conn->prepare("SELECT $properties FROM $tablename");
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    public function selectWhere($properties, $tablename, $condition) {
        try {
            $stmt = $this->conn->prepare("SELECT $properties FROM $tablename WHERE $condition");
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    public function selectOrder($properties, $tablename, $proper) {
        try {
            $stmt = $this->conn->prepare("SELECT $properties FROM $tablename ORDER BY $proper");
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return "Error: " . $e->getMessage();
        }
        $this->conn = null;
    }

    public function deteleFromWhere($tablename, $condition) {
        try {
            // sql to delete a record
            $sql = "DELETE FROM $tablename WHERE $condition";
          
            // use exec() because no results are returned
            $this->conn->exec($sql);
            return "Record deleted successfully";
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return $sql . "<br>" . $e->getMessage();
        }
        $this->conn = null;
    }

    public function updateRow($tablename, $setValues, $condition) {
        try {
            // sql to delete a record
            $sql = "UPDATE $tablename SET $setValues WHERE $condition";
          
            // use exec() because no results are returned
            $this->conn->exec($sql);
            return "Record UPDATED successfully";
        } catch(PDOException $e) {
            $mess = $e->getMessage();
            App::loadErrors('database', ['message'=>$mess]);
            return $sql . "<br>" . $e->getMessage();
        }
        $this->conn = null;
    }

}

?>