<?php
session_start();

//session_destroy(); 會清除所有session，不建議使用，可能會清除掉其他正在使用的session

unset($_SESSION['user']); //移動某個陣列中的元素

header('Location:index_.php');

?>