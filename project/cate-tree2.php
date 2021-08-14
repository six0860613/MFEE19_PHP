<?php
include __DIR__ . '/partials/init.php';

$sql = "SELECT * FROM `categories` ORDER BY `parent_sid`, `sequence`";

$rows = $pdo->query($sql)->fetchALL();

$dictionary = [];

//取得三層

foreach($rows as &$r){
    $dictionary[$r['sid']] = $r;
}

$tree = [];
foreach($dictionary as $sid => $item){
    if($item['parent_sid']==0){
        //判斷是否為首層
        $tree[] = &$dictionary[$sid];
    }else{
        //非首層的就一定有上層
        $dictionary[$item['parent_sid']]['nodes'][] = &$dictionary[$sid];
    }
}


echo json_encode($tree, JSON_UNESCAPED_UNICODE);