<h2>

<?php

// echo $_GET['a'] ?? '';

//用?a=10&b=20傳入試試
//判斷是否有設定變數
$a = isset($_GET['a']) ? intval($_GET['a']) :0;

$b = isset($_GET['b']) ? intval($_GET['b']) :0;

echo $a+$b;


?>



</h2>