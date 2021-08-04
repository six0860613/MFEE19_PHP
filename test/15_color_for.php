<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table{
        border-collapse: collapse;
    }
    td{
        width: 30px;
        height: 30px;
    }
</style>
<body>
    <table border="1">
        <?php for($i = 1; $i <= 255; $i+=17): ?>
        <tr>
            <td style="background-color: #<?= sprintf("%'.02X", $i)?>0000"></td>
            <?php for($k = 1; $k <= 255; $k+=17): ?>
                <td style="background-color: #<?= sprintf("%'.02X%'.02X", $i,$k)?>00"></td>
            <?php endfor?>
        </tr>
        
        <?php endfor?>
    </table>
</body>
</html>