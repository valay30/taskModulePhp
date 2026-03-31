<?php
require_once __DIR__ . '/customer_group.php';

if(empty($_POST['ids'])){
    header('Location: ../index.php?page=customer_group&error=noselect');
    exit;
}


foreach($_POST['ids'] as $id){
    $group = new CustomerGroup();
    $group->load($id);
    $group->delete();
}

header('Location: ../index.php?page=customer_group');
exit;
?>