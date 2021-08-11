<?php

session_start();
//用戶資料
$users = [
    'test001' => [
        'pw' => '123456',
        'nickname' => '用戶001',
    ],
    'test002' => [
        'pw' => '123456',
        'nickname' => '用戶002',
    ]
];
//輸出格式
$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
];

//若未傳入資料時的檢查
if(! isset($_POST['account']) or ! isset($_POST['password'])){
    $output['error'] = '未填寫帳號或密碼';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


//當傳入的account值作為users的key去比對有沒有這個變數
if(! isset($users[$_POST['account']])){
    $output['error'] = '帳號錯誤';
    $output['code'] = 401;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$userData = $users[$_POST['account']];
if($_POST['password'] !== $userData['pw']){
    $output['error'] = '密碼錯誤';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}else{
    $output['success'] = true;
    $output['code'] = 200;

    $_SESSION['user'] = [
        'account' => $_POST['account'],
        'nickname' => $userData['nickname'],
    ];
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>