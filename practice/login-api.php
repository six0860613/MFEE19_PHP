<?php
include __DIR__ . '/mod/initialization.php';
$title = "登入";

//傳入後比對帳號的輸出結果
$output = [
    'login_success' => false,
    'error' => '',
    'code' => 0,
];

//【檢查】帳密為空
if(! isset($_POST['account']) or ! isset($_POST['password'])){
    $output['error'] = '未填寫帳號或密碼';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM member WHERE account=?"; //SQL語法：選擇帳號
$stmt = $pdo->prepare($sql); //準備PDO
$stmt->execute([$_POST['account']]); //帳號傳入
$m = $stmt->fetch();


//帳號比對
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

$output['login_success'] = true;
$output['code'] = 200;

$_SESSION['user'] = $m;

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>