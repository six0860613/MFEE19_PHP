<pre>
<?php

//純粹list寫法(key為陣列排序位置0,1,2...)
$ar1 = array(3,5,7);
$ar2 = [3,5,7];

var_dump($ar1);
print_r($ar1);

var_dump($ar2);
print_r($ar2);

//key+value寫法

$ar3 = array(
    'name' => 'David',
    'age' => 23,
);
$ar4 = [
    'name' => 'David',
    'age' => 23,
];

print_r($ar4);
?>
</pre>