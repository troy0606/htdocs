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

    $a = 10;
    $b = &$a;

    $c = 20;
    $d = $c;

    $b = 33;
    $d = 55;

    echo "\$a: $a <br>";
    echo "\$c: $c <br>";

    ?>
    </pre>
</div>

</body>
</html>
