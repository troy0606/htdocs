<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="lib/jquery-3.4.1.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
<?php

$ar = [2, 4, 6, 99, 'hi']; // 索引式陣列

// 關聯式陣列
$br = [
    'name' => 'david',
    'age' => 20,
    'hello',
];

// $cr = [];

for($i=1; $i<10; $i++){
    $cr[] = $i*$i;
}

echo '<pre>';

print_r($ar);
print_r($br);
print_r($cr);
//var_dump($ar);
//var_dump($br);
echo count($ar). "\n";
echo count($br). "\n";
echo count($cr). "\n";




echo '</pre>';



?>

</div>

</body>
</html>
