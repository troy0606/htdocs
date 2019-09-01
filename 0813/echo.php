<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>echo</title>
</head>
<body>
    <?php

        echo (17+9). '<br>';
        // 因為是後端，所以網頁瀏覽器無法看到程式碼
        // php自串串接必須使用.
        // 運算子+ 只用在數值運算
        echo __DIR__;
        // 檔案在哪個資料夾
        echo'<br>';

        echo __FILE__;
        // 檔案路徑
        echo'<br>';

        echo __LINE__;
        // 目前第幾行(多用在除錯)
        echo'<br>';
    ?>
</body>
</html>