<?php
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../row.php';

class CustomerGroup extends Row{
    public $tableName = 'customer_group';
    public $primaryKey = 'customer_group_id';
}

?>