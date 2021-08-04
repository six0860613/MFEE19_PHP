<pre>
<?php

    for($i = 1; $i<10; $i++){
        $br[] = $i * $i;
    }

    print_r($br);

    array_push($br, 100, 101);
    print_r($br);
    echo '<br>';

    foreach($br as $v){
        echo " $v <br>";
    }
    echo '---------------------<br>';

    $ar = array(
        'name' => 'David',
        'age' => 23,
        'gender' => 'male',
    );

    foreach($ar as $key => $value){
        echo " $key => $value <br>";
    }
    echo '---------------------<br>';

    echo count($ar);
?>
</pre>