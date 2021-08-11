<?php

$db_host = 'localhost';
$db_name = 'wandering';
$db_user = 'admin';
$db_pass= 'admin';

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

$pdo_options =[
    //錯誤報告的設定 EXCEPTION會回傳異常報告並停止
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    
    //fetch的回傳型態，FETCH_ASSOC為陣列，FETCH_OBJ為物件，FETCH_BOTH為兩者皆是(預設)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    
    //設定MYSQL編碼
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

?>