<?php

include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

//上傳後存放地
$folder = __DIR__ . '/imgs/';

//允許的檔案類型
$imgTypes = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];


$output = [
    'success' => false,
    'error' => '資料未修改',
    'code' => 0,
    'postData' => $_POST,
];

//如果暱稱沒有修改(增加其他欄位只需要增加or條件)
if (empty($_POST['nickname'])) {
    echo json_encode($output);
    exit;
}

$isSaved = false;
// 如果有上傳檔案
if (!empty($_FILES) and !empty($_FILES['avatar'])) {
    $ext = isset($imgTypes[$_FILES['avatar']['type']]) ? $imgTypes[$_FILES['avatar']['type']] : null  ; //取得副檔名
    if (!empty($ext)) { //如果是imgTypes允許的檔案類型
        $filename = sha1($_FILES['avatar']['name'] . rand()) . $ext;

        if (move_uploaded_file(
            $_FILES['avatar']['tmp_name'],
            $folder.$filename
        )) {
            $sql = "UPDATE `members` SET `avatar`=?, `nickname`=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $filename,
                $_POST['nickname'],
                $_SESSION['user']['id'],
            ]);
            if ($stmt->rowCount()) {
                $isSaved = true;
                $output['filename'] = $filename;
                $output['success'] = true;
                $output['error'] = '';

                $_SESSION['user']['avatar'] = $filename;
                $_SESSION['user']['nickname'] = $_POST['nickname'];

                echo json_encode($output);
                exit;
            }
        }
    }
}

if (!$isPassed) {
    $sql = "UPDATE `members` SET `nickname`=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nickname'],
        $_SESSION['user']['id'],
    ]);
    if ($stmt->rowCount()) {
        $output['success'] = true;
        $output['error'] = '';
        $_SESSION['user']['nickname'] = $_POST['nickname'];
    }
}

echo json_encode($output);