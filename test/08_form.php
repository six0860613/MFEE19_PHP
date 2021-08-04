<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- 表單連結到php檔案進行運算 -->
    <form action="07.php" method="get">

        <input type="number" name="a" placeholder="num_a">+
        <input type="number" name="b" placeholder="num_b">
        <button>=</button>

    </form>

    <a href="07.php?a=20&b=30">+++++</a>
</body>
</html>