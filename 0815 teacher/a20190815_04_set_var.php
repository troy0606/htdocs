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
    <pre>
    <?php
    // 關聯式陣列
    $br = [
        'name' => 'david',
        'age' => 20,
    ];

    $cr = $br; // 設定值, 複製一份後再設定
    $dr = &$br; // 設定位址

    $cr['age'] = 100;
    $dr['age'] = 66;

    print_r($br);
    print_r($cr);
    print_r($dr);

    ?>
    </pre>
</div>

</body>
</html>
