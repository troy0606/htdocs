<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cookie</title>
</head>

<body>
    <div class="container">
        <?php echo $_COOKIE["myC"]; ?>
        <?php echo time(); ?>
    </div>
    <!-- 不同php可以取得相同的cookie -->
</body>

</html>