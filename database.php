<?php

class database
{
    public $server = "localhost";
    public $username = "root";
    public $password = "root";
    public $dbname = "TaskModule";
    protected $conn = null;

    public function connect(){
        if($this->conn === null){
            $this->conn = mysqli_connect($this->server,$this->username,$this->password,$this->dbname);

            if(!$this->conn){
                die("Connection failed" . mysqli_connect_error());
            }
        }
        return $this->conn;
    }

    public function insert($query){
        $result = mysqli_query($this->connect(), $query);
        if(!$result){
            return false;
        }
        return mysqli_insert_id($this->connect());
    }

    public function update($query){
        $result = mysqli_query($this->connect(), $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public function delete($query){
        $result = mysqli_query($this->connect(), $query);
        if(!$result){
            return false;
        }
        return true;
    }

    public function fetchRow($query){
    $result = mysqli_query($this->connect(), $query);
        if(!$result){
            return false;
        }
        return mysqli_fetch_assoc($result);
    }

    public function fetchAll($query){
        $result = mysqli_query($this->connect(), $query);
        if(!$result){
            return false;
        }

        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

}
?>