<h2>
    <?php
    //設定時區
    //date_default_timezone_set('Asia/Taipei');

    echo time(). '<br>';
    echo date("y-m-d H:i:s"). '<br>'; 
    echo date("D N w"). '<br>';
    echo date("y-m-d H:i:s", time()+40*24*60*60). '<br>'; 
    
    $t = strtotime('2021/08/05');
    echo date("Y-m-d H:i:s", $t).'<br>';//參數表示法
    ?>
</h2>