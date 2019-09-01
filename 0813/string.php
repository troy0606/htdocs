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
        $a = "abc";
        echo "Hello,$a";
        // 如果使用雙引號，可以抓到變數內的值
        echo "<br>". 'Hello $a';
        // 使用單引號則會是為整個字串
    ?>
</body>
</html>