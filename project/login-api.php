<?php
include __DIR__ . '/partials/init.php';

//輸出格式
$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

//若未傳入資料時的檢查
if(empty($_POST['account']) or empty($_POST['password'])){
    $output['error'] = '未填寫帳號或密碼';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM members WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST['account']]);
$m = $stmt->fetch();

//查看帳號
if(empty($m)){
    $output['error'] = '帳號錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

//密碼比對
if(! password_verify($_POST['password'], $m['password'])){
    $output['error'] = '密碼錯誤';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['success'] = true;
$output['code'] = 200;

$_SESSION['user'] = $m;

echo json_encode($output, JSON_UNESCAPED_UNICODE);
