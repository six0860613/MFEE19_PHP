<?php
include __DIR__ . '/mod/initialization.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$output = [
    'success' => false,
    'error' => '未提供sid',
    'sid' => $sid,
];

//empty，參數為0 / 空 / 空陣列 會回傳true
if(!empty($sid)){

    $sql = "DELETE FROM `product` WHERE sid=$sid";
    $stmt = $pdo -> query($sql);

    if($stmt->rowCount()==1){
        $output['success'] = true;
        $output['error']='';
    }else{
        $output['error']='刪除失敗';
    }
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
