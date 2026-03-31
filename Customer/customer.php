<?php
require_once __DIR__ . '/../row.php';

class Customer extends Row{
    public $tableName = 'customer';
    public $primaryKey = 'customer_id';
}
?>