<?php

include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

//若未傳入資料時的檢查
if(! isset($_POST['name']) or ! isset($_POST['email']) or ! isset($_POST['mobile']) or ! isset($_POST['birthday']) or ! isset($_POST['address'])){
    $output['error'] = '未填寫完整資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


// 資料格式檢查
if(mb_strlen($_POST['name'])<2){
    $output['error'] = '姓名長度太短';
    $output['code'] = 410;
    echo json_encode($output);
    exit;
}

if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $output['error'] = 'email 格式錯誤';
    $output['code'] = 420;
    echo json_encode($output);
    exit;
}


/*
//因為語法問題可能會產生漏洞，不建議使用此做法
$sql = "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`)
    VALUES(
        '{$_POST['name']}', '{$_POST['email']}', '{$_POST['mobile']}',
        '{$_POST['birthday']}', '{$_POST['address']}', NOW()
    )";

$stmt = $pdo->query($sql);
*/

$sql = "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`)
    VALUES(
        ?, ?, ?, ?, ?, NOW()
    )";

$stmt = $pdo->prepare($sql);
$stmt -> execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['address'],
]);

$output['rowCount'] = $stmt -> rowCount(); //新增幾筆

if($stmt->rowCount()==1){
    $output['success'] = true;
}

echo json_encode($output);

?>