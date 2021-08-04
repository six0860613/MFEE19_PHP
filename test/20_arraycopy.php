<pre>
<?php
    $ar = array(
        'name' => 'David',
        'age' => 23,
        'gender' => '男生',
    );
    
    $ar2 = $ar;  // set by value (複製後再指定)
    $ar2['name'] = 'Adam';
    echo json_encode($ar);
    echo '<br>------<br>';
    echo json_encode($ar2);
    echo '<br>------<br>';

    $ar3 = &$ar;  // set by address (指定位址)
    $ar3['name'] = 'Kevin';
    echo json_encode($ar);
    echo '<br>------<br>';
    echo json_encode($ar3);
    echo '<br>------<br>';


?>
</pre>