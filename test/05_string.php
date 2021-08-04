<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $a = 10;
    $b = "20";
    $c = '12aaa';
    $d = 'hi';


    echo $a + $b;
    echo '<br>';

    echo "$a + $d"; //用雙引號可以把變數切換為變數值
    echo '<br>';

    echo '$a + $b';//單引號就是純字串
    echo '<br>';

    echo $c.$d;//字串串接
    echo '<br>';
    
    ?>
</body>
</html>