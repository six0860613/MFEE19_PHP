<?php


session_start();

unset($_SESSION['user']); //移除某個陣列中的元素

header('Location:index_.php');


?>