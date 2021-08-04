<pre>
<?php

    for($i = 1; $i<10; $i++){
        $br[] = $i * $i;
    }

    print_r($br);
    echo '<br>';
    echo json_encode($br);

    array_push($br, 100, 101);
    echo '<br>';
    print_r($br);
    echo '<br>';

    echo implode(',',$br).'<br>';
    echo '<br>';
    $str = '1-3-1-5-1-7';
    $ar = explode('-',$str);
    print_r($ar);
?>
</pre>