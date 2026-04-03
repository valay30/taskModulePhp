<?php
require_once __DIR__ . '/customer_group.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $group = new CustomerGroup();
    $id = $_POST['customer_group_id'] ?? '';

    if($id !== ''){
        $group->load($id);
    }

    $skip = ['customer_group_id'];
    foreach($_POST as $key => $value){
        if(!in_array($key,$skip)){
            $group->$key = $value;
        }
    }

    if($id === ''){
        $group->created_date = date('Y-m-d H:i:s');
    }else{
        $group->updated_date = date('Y-m-d H:i:s');
    }

    $group->save();
}

header('Location: ../index.php?page=customer_group');
exit;
?>