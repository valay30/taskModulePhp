<?php
require_once __DIR__ . '/../row.php';
require_once __DIR__ . '/../database.php';

class Product extends Row{
    public $tableName = 'product';
    public $primaryKey = 'product_id';
}
