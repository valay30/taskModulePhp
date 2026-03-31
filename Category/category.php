<?php
require_once __DIR__ . '/../database.php';require_once __DIR__ . '/../row.php';

class Category extends Row{
    public $tableName = 'category';
    public $primaryKey = 'category_id';
}

?>