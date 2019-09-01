<?php
    date_default_timezone_set("Asia/Taipei");
    // 設定預設時區為 台北

    echo time(). "<br>";
    // 取得從1970到現在的秒數
    echo $today = date("Y-m-d H:i:s"). "<br>";     
    // 2001-03-10 17:16:18 （MySQL DATETIME 格式）
    echo $nextMonthToday = date("Y-m-d", time()+ 30*24*60*60). "<br>";
    // 取得30天後的日期+(天*小時*分*秒)

    echo $strD = date("Y-m-d", strtotime('+30 days')). '<br>'; 
    // 字串轉時間
    echo $strBth = date("2019-8-2"). '<br>'; 
?>