<?php

include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '資料欄位不足',
    'code' => 0,
    'rowCount' => 0,
    'postData' => $_POST,
];

//若未傳入資料時的檢查
if(! isset($_POST['sid']) or ! isset($_POST['name']) or ! isset($_POST['email']) or ! isset($_POST['mobile']) or ! isset($_POST['birthday']) or ! isset($_POST['address'])){
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


$sql = "UPDATE `address_book` SET 
`name`=?, `email`=?, `mobile`=?, `birthday`=?, `address`=? WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt -> execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['address'],
    $_POST['sid']
]);

$output['rowCount'] = $stmt -> rowCount(); // 修改幾筆

if($stmt->rowCount()==1){
    $output['success'] = true;
    $output['error'] = '';
}else{
    $output['error'] = '未修改資料';
}

echo json_encode($output);

?>