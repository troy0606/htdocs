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

<table border="1">
    <?php for($i=1; $i<10; $i++){ ?>
    <tr>
        <?php /*
        <td><?php echo $i ?></td>
        */ ?>
        <td><?= $i ?></td>
    </tr>
    <?php } ?>
</table>

<table border="1">
    <?php for($i=1; $i<10; $i++){
        echo "<tr>
                <td>$i</td>
            </tr>";
    } ?>
</table>
</body>
</html>
