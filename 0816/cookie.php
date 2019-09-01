<?php
    setcookie("myC","My cookie~");
?>
<!-- 必須放在html之前，html檔案會放在request(http)-body -->
<!-- cookie的儲存是透過瀏覽器儲存(client)，在response 才設定setcookie -->
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
    <!-- 第一次會抓不到，第一次發request給server設定，無法拿到值 -->
    <!-- 第二次才抓到 -->
    </div>
</body>
</html>