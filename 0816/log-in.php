<?php
session_start();
if (isset($_POST["account"])) {
    if ($_POST["account"] == "benson" && $_POST["password"] == "123456") {
        $_SESSION["user"] = $_POST["account"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php if (isset($_SESSION["user"])) : ?>
    <h2><?php echo $_SESSION["user"] . "您好" ?></h2>
    <p><a href="log-out.php">登出</a></p>
    <?php else : ?>
    <form method="post">
        <input type="text" name="account" placeholder="帳號"><br>
        <input type="password" name="password" placeholder="密碼"><br>
        <input type="submit">
    </form>
    <?php endif ?>
</body>

</html>