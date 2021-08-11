<?php
echo json_encode($_FILES);
// 上傳後的檔案要放在哪裡
$folder = __DIR__ .'/imgs';


// 如果有上傳檔案
if (!empty($_FILES)) {

  if (move_uploaded_file(
    $_FILES['avatar']['tmp_name'],
    $folder. $_FILES['avatar']['name']
  )) {
    echo 'OK';
  } else {
    echo 'move file error';
  }
} else {
  echo 'no files';
}
?>