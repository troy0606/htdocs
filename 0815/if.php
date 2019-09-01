<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>if condition</title>
</head>

<body>
    <?php
        if(isset($_GET['name']) and $_GET["name"] == 'Benson'){
    ?>
        <p>您好!Benson</p>
        <?php
            } else {
        ?>
        <p>您好!陌生人</p>
        <?php
            }
        ?>
</body>

</html>