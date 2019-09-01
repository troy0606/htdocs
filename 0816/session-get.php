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
    function clSession()
    {
        session_destroy();
    }
    ?>
    <?php
    session_start();
    echo $_SESSION['mySession'];
    ?>
    <button onclick="clSession()">clear</button>
</body>

</html>