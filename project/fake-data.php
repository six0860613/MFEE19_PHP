<?php

include __DIR__ . '/partials/init.php';

header('Content-Type: application/json');

$sql = "INSERT INTO `address_book`(
    `name`,`email`,`mobile`,`birthday`,`address`,`created_at`)
    VALUES(
        ?, ?, ?, ?, ?, NOW()
    )";

$stmt = $pdo->prepare($sql);

$str = '傷兵滿營的洋基不斷傳出壞消息繼先發投手和捕手陸續傳出新冠肺炎檢測陽性後';
$chrArray = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);

for($i=0;$i<50;$i++){

    shuffle($chrArray);
    $name = implode('', array_slice($chrArray, 0, 3));

    $stmt -> execute([
        $name,
        uniqid().'@test.com',
        '09'.strval(rand(10000000, 99999999)),
        date('Y-m-d', rand(strtotime('1990-01-01'), strtotime('2022-01-01'))),
        '台北市',
    ]);
}

echo 'done';

?>