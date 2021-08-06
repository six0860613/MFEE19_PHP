<?php

require __DIR__.'/partials/init.php'; //初始化session & db_connect

$stmt = $pdo->query("SELECT * FROM address_book LIMIT 10");

echo json_encode( $stmt->fetch(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE );

//改用fetchALL可以拿出全部資料
//fetch中也可以不設定PDO
?>