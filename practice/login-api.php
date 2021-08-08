<?php

session_start();

//會員資料
$users = [
    'hua01' => [
        'pw' => '123456',
        'nickname' => '華01',
        'gender_call' => '先生',
    ],
    'hua02' => [
        'pw' => '654321',
        'nickname' => '華02',
        'gender_call' => '小姐',
    ],
];

//傳入後比對帳號的輸出結果
$output = [
    'login_success' => false,
    'error_message' => '',
    'code' => 0,
];


if(! isset($users[$_POST['account']])){
    $output['error_message'] = '帳號有誤';
    $output['code'] = 878701;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$userData = $users[$_POST['account']];
if($_POST['password'] !== $userData['pw']){
    $output['error_message'] = '密碼有誤';
    $output['code'] = 878702;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}else{
    $output['login_success'] = true;
    $output['code'] = 200;
    
    $_SESSION['user'] = [
        'account' => $_POST['account'],
        'nickname' => $userData['nickname'],
        'gender_call' => $userData['gender_call'],
    ]; //將帳號詳細資訊包入session暫存
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

?>