<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>string</title>
</head>
<body>
    <?php
        $a = "Victor";
        echo "Hello, $a123 <br>";
        // 會把整個名稱當成變數
        echo "Hello, ${a}123 <br>";
        // 用大括弧把變數跟一般字串做區隔
        echo "Hello, {$a}123 <br>";
        echo $a. "<br>"

        // Notice 會往下跑
        // Warning  會往下跑
        // Error 不會跑程式
    ?>
</body>
</html>