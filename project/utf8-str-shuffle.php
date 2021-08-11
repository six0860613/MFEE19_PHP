<?php

$str = '傷兵滿營的洋基不斷傳出壞消息繼先發投手和捕手陸續傳出新冠肺炎檢測陽性後';

$chrArray = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);

//print_r($chrArray);

shuffle($chrArray);  // 隨機排序

$ar = array_slice($chrArray, 0, 3); // 取前面三個元素

echo implode('', $ar);
