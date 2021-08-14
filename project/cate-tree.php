<?php
include __DIR__ . '/partials/init.php';

$sql = "SELECT * FROM `categories` ORDER BY `sequence`";

$rows = $pdo->query($sql)->fetchALL();

$cate1 = [];

//取得一層
foreach($rows as $r){
    if($r['parent_sid']=='0'){
        $cate1[] = $r;
    }
}
/*
foreach($cate1 as $k => $c){
    foreach($rows as $r){
        if($r['parent_sid']==$c['sid']){
            $cate1[$k]['nodes'][] = $r;
        }
    }
}
*/
//取得二層
foreach($cate1 as &$c){
    foreach($rows as $r){
        if($r['parent_sid']==$c['sid']){
            $c['nodes'][] = $r;
        }
    }
}


echo json_encode($cate1, JSON_UNESCAPED_UNICODE);