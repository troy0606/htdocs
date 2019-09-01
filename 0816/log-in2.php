<?php
$account = [
    "benson" => '123456',
    "benson0" => '7891011',
    "benson1" => '11121314',
    "benson2" => '15161718', 
];
// 建立儲存會員資料的關聯式陣列
session_start();
// 啟動session
if (isset($_POST["account"])) {
    // 如果$_POST["account"]有從表單取得值
    if ($account[$_POST["account"]] == $_POST["password"]) {
        // account[benson] 取得的值 == 123456 是否符合表單取得的密碼
        $_SESSION["user"] = $_POST["account"];
        // 將使用者帳號的值賦值給$_SESSION["user"]
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