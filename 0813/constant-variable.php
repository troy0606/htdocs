<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        define("MY_CONSTANT","常數(通常使用全大寫)定義時必須是字串，賦值後不可再復職");
        echo MY_CONSTANT;

        $my_var = 66;
        $b = "22";
        $c = "abc";
        echo "<br>";
        echo ($my_var + $b). "<br>";
        echo $my_var + $c;
    ?>
</body>
</html>