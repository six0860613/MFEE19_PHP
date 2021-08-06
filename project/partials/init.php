<?php
//初始化時的功能

require __DIR__.'/db_connect.php';

if(! isset($_SESSION)){
    session_start();
}

?>