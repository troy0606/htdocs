<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nine</title>
</head>
<body>
    <table border = 1>
        <?php
            for($i = 1;$i <=9;$i ++):
                echo "<tr>";
                for($j = 1;$j <=9;$j ++):
                    echo "<td>";
                    // 從php裡回傳 
                    echo sprintf('%s*%s=%s',$i,$j,$i*$j); 
                    // "<td>". "${i}*${j} = ". $i*$j. "</td>"; 
                    echo "</td>"; 
                endfor;
                // 左掛號
                echo "<tr>";

        endfor ?>
    </table>
</body>
</html>