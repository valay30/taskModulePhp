<?php

class Row
{
    public $tableName = null;
    public $primaryKey = null;
    protected $db = null;
    public $data = [];

    public function __construct()
    {
        $this->db = new database();
    }
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }

    // public function value($key, $value = null)
    // {
    //     if (!isset($key)) {
    //         throw new Exception("Key should not be null");
    //     }

    //     if ($value !== null) {
    //         $this->data[$key] = $value;
    //         return $this;
    //     }

    //     if (array_key_exists($key, $this->data)) {
    //         return $this->data[$key];
    //     }
    //     return null;
    // }

    public function load($value, $column = null)
    {
        $column = $column ?? $this->primaryKey;

        $query = "select * from {$this->tableName} where $column = '$value' limit 1";
        $row = $this->db->fetchRow($query);

        if ($row) {
            $this->data = $row;
            return $this;
        }
        return false;
    }

    public function fetchRow($query)
    {
        $result = $this->db->fetchRow($query);
        if ($result) {
            $this->data = $result;
            return $this;
        }
        return false;
    }

    public function fetchAll($query)
    {
        // $rows = []; 
        $rows = $this->db->fetchAll($query);
        if ($rows) {
            foreach ($rows as $key => $value) {
                $obj = new static();
                $obj->data = $value;
                $rows[$key] = $obj;
                // $rows[] = $obj;
            }
            return $rows;
        }
        return false;
    }

    public function insert()
    {
        $column = implode(",", array_keys($this->data));
        $values = array_map(function ($v) {
            return "'$v'";
        }, array_values($this->data));

        $values = implode(",", $values);

        $query = "insert into {$this->tableName} ($column) values ($values)";
        $id = $this->db->insert($query);

        if ($id) {
            $this->data[$this->primaryKey] = $id;
            return $this;
        }

        return false;
    }

    public function update()
    {
        if (!isset($this->data[$this->primaryKey])) {
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
        
        if ($this->db->update($query)) {
            return $this;
        }
        return false;
    }

    public function save()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete()
    {
        if (!isset($this->data[$this->primaryKey])) {
            return false;
        }

        $id = $this->data[$this->primaryKey];
        $query = "delete from {$this->tableName} where {$this->primaryKey} = $id";
        return $this->db->delete($query);
    }

    public function getAll($table = null)
    {
        $query = "select * from {$this->tableName}";
        // return $this->db->fetchAll($query);
        return $this->fetchAll($query);
    }
}
