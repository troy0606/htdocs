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
            for($i = 1;$i <=9;$i ++){
                echo "<tr>"; 
                for($j = 1;$j <=9;$j ++){ 
                    echo "<td>". "${i}*${j} = ". $i*$j. "</td>"; 

            }
            echo "</tr>";
        }

        ?>
    </table>
</body>
</html>