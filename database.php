<?php

class database
{
    protected $conn = null;

    public function connection(){
        if($this->conn === null){
            $this->conn = mysqli_connect("localhost","root","root","TaskModule");

            if(!$this->conn){
                die("Connection failed" . mysqli_connect_error());
            }
        }
        return $this->conn;
    }

    public function insert($query){
        mysqli_query($this->connection(),$query);
        return mysqli_insert_id($this->connection());
    }

    public function update($query){
        return mysqli_query($this->connection(),$query);
    }

    public function delete($query){
        return mysqli_query($this->connection(), $query);
    }

    public function fetchRow($query){
        $result = mysqli_query($this->connection(),$query);
        return mysqli_fetch_assoc($result);
    }

    public function fetchAll($query){
        $result = mysqli_query($this->connection(), $query);

        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

}
?>