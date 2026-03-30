<?php

class Row{
    public $tableName = null;
    public $primaryKey = null;
    protected $db = null;
    public $data = [];

    public function __construct()
    {
        $this->db = new database();
    }

    public function value($key, $value = null){
        if(!isset($key)){
            throw new Exception("Key should not be null");
        }

        if($value !== null){
            $this->data[$key] = $value;
            return $this;
        }

        if(array_key_exists($key, $this->data)){
            return $this->data[$key];
        }
        return null;
    }

    public function load($value, $column = null){
        $column = $column ?? $this->primaryKey;

        $query = "select * from {$this->tableName} where $column = '$value' limit 1";
        $row = $this->db->fetchRow($query);

        if($row){
            $this->data = $row;
            return $this;
        }
        return false;
    }

    public function insert(){
        $column = implode(",", array_keys($this->data));
        $values = implode(",", array_values($this->data));

        $query = "insert into {$this->tableName} ($column) values ($values)";
        $id = $this->db->insert($query);

        if($id){
            $this->data[$this->primaryKey] = $id;
            return $this;
        }

        return false;
    }

    public function update(){
        if(!isset($this->data[$this->primaryKey])){
            return false;
        }

        $id = $this->data[$this->primaryKey];
        $data = $this->data;

        unset($data[$this->primaryKey]);

        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key='$value'";
        }

        $set = implode(",", $set);
        $query = "update {$this->tableName} set $set where {$this->primaryKey} = $id";
        return $this->db->update($query);
    }

    public function save(){
        if (!isset($this->data[$this->primaryKey])) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete(){
        if(!isset($this->data[$this->primaryKey])){
            return false;
        }

        $id = $this->data[$this->primaryKey];
        $query = "delete from {$this->tableName} where {$this->primaryKey} = $id";
        return $this->db->delete($query);
    }

    public function getAll($table = null){
        $query = "select * from {$this->tableName}";
        return $this->db->fetchAll($query);
    }
}