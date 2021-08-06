<?php

require __DIR__.'/partials/init.php'; //初始化session & db_connect

$stmt = $pdo->query("SELECT * FROM address_book LIMIT 10");

//echo json_encode( $stmt->fetch(), JSON_UNESCAPED_UNICODE );

while($r = $stmt->fetch()){
    echo "<p>{$r['name']}</p>";
} //把stmt鐘用fetch抓到的資料跑while迴圈,讓r去接stmt的陣列(fetch出來的就是陣列)之後用key返回要的value
?>