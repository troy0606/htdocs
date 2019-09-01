<?php
session_start();

$accounts = [
    'shin0' => '1234',
    'shin1' => 'dsfgdsf',
    'shin2' => 'fgds',
    'shin3' => '5464fdf',
    'shin4' => 'dfgd345A',
];

if(isset($_POST['account'])){

    if(isset($accounts[$_POST['account']])){
        if($_POST['password']==$accounts[$_POST['account']]){
            $_SESSION['user'] = $_POST['account'];
        }
    }

}
?>
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
<?php if(isset($_SESSION['user'])): ?>
    <h2><?= $_SESSION['user'] ?>, 您好</h2>
    <p><a href="a20190816_07_logout.php">登出</a></p>
<?php else: ?>
<form method="post">
    <input type="text" name="account" placeholder="帳號"><br>
    <input type="password" name="password" placeholder="密碼"><br>
    <input type="submit">
</form>
<?php endif; ?>


</body>
</html>








