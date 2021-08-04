<?php

header('Content-Type: application/json');


// echo $_POST['a'] ?? '';

//用?a=10&b=20傳入試試
//判斷是否有設定變數
$a = isset($_POST['a']) ? intval($_POST['a']) :0;

$b = isset($_POST['b']) ? intval($_POST['b']) :0;

echo json_encode([
    'postDate' => $_POST,
    'result' => $a + $b,
]
);


?>
