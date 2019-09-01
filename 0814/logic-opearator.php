<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
// PHP 的邏輯運算子拿到的一定是布林值
$a = 7 && 5; // true, 輸出到頁面會變成 1(布林值)
echo "$a <br>";
echo $a == 1 ? "true<br>":"false";
echo $a === true ? "true<br>":"false";

$a = 0 && 5; // false, 輸出到頁面會變成空字串
echo "$a <br>";

$a = 7 and 5;
// 會先賦值，a會先拿到7
echo "$a <br>";
$a = 0 and 5;
echo "$a <br>";


echo ($a = 7 and 5) ? 'true<br>' : 'false<br>';
echo ($a = 0 and 5) ? 'true<br>' : 'false<br>';

?>
</body>
</html>