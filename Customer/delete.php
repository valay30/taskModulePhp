<?php
require_once __DIR__ . '/customer.php';

if(empty($_POST['ids'])){
    header('Location: ../index.php?page=customer&error=noselect');
    exit;
}

foreach($_POST['ids'] as $id){
    $customer = new Customer();
    $customer->load($id);
    $customer->delete();
}

header('Location: ../index.php?page=customer');
exit;
?>