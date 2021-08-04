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
    <form onsubmit="ajaxSend(); return false">

        <input type="number" name="a" placeholder="num_a">+
        <input type="number" name="b" placeholder="num_b">
        <button>=</button>
        <span id="result"></span>

    </form>

<script>
    const af = document.querySelector('input[name=a]');
    const bf = document.querySelector('input[name=b]');
    const result = document.querySelector('#result');

    function ajaxSend(){

        const sp = new URLSearchParams();

        sp.set('a', af.value);
        sp.set('b', bf.value);

        console.log(sp);
        console.log(sp.toString());

        const xhr = new XMLHttpRequest();
        xhr.onload = function(){
            result.innerHTML = xhr.responseText
        }
        xhr.open('GET','07.php?'+ sp.toString() );
        xhr.send();


    }
</script>
</body>
</html>