<?php

include __DIR__ . '/mod/initialization.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

//empty，參數為0 / 空 / 空陣列 會回傳true
if(! empty($sid)){
    $sql = "DELETE FROM `product` WHERE sid=$sid";
$stmt = $pdo -> query($sql);
}

if(isset($_SERVER['HTTP_REFERER'])){
    header("Location: ".$_SERVER['HTTP_REFERER']);    
}else{
    header('Location: product.php');
}
