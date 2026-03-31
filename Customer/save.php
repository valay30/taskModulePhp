<?php
require_once __DIR__ . '/customer.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $customer = new Customer();
    $id = $_POST['customer_id'] ?? '';
    
    if($id !== ''){
        $customer->load($id);
    }

    $skip = ['customer_id'];
    foreach ($_POST as $key => $value){
        if(in_array($key,$skip)) continue;
        if($key === 'customer_group_id' && $value === ''){
            $customer->value($key, null);
        } else {
            $customer->value($key, $value);
        }
    }

    if($id === ''){
        $customer->value('created_date', date('Y-m-d H:i:s'));
    }else{
        $customer->value('updated_date', date('Y-m-d H:i:s'));
    }

    $customer->save();
}

header('Location: ../index.php?page=customer');
exit;