<?php
$data = [
    0 => '蘋果',
    1 => '西瓜',
    5 => '草莓',
    7 => '芒果',
    10 => '芭樂'
];

$fruita = empty($_POST['fruita'])? []: $_POST['fruita'];
// 建一個變數 = 如果 fruita 陣列裡沒值，還傳空陣列，否則回傳取得的陣列
$fruitb = empty($_POST['fruitb'])? 0: intval($_POST['fruitb']);
// 建一個變數 = 如果 fruitb 陣列裡沒值，還傳0，否則回傳取得的值(取整數)
$fruitc = empty($_POST['fruitc'])? 0: intval($_POST['fruitc']);


require __DIR__ . "/__html_head.php";
?>
<div class="container">
    <form method="post" name="form1">
        <pre>
            <?php
            if (!empty($_POST))
                print_r($_POST);
            ?>
        </pre>
        <?php foreach ($data as $k => $v) : ?>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="fruit-a-<?= $v ?>" name="fruita[]" value="<?= $k ?>" <?=in_array($k, $fruita)?"checked":""?>>
            <label class="form-check-label" for="fruit-a-<?= $v ?>" name="<?= $v ?>"><?= $v ?></label>
        </div>
        <?php endforeach; ?>

        <?php foreach ($data as $k => $v) : ?>
        <?php $i = 0 ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fruitb" id="fruit-b-<?= $v ?>" value="<?= $k ?>" <?=$k==$fruitb?"checked":""?>>
            <label class="form-check-label" for="fruit-b-<?= $v ?>"><?= $v ?></label>
        </div>
        <?php $i++;
        endforeach; ?>

        <div class="form-group form-check">
            <select class="custom-select" name="fruitc">
                <?php foreach ($data as $k => $v) : ?>
                <option value="<?= $k ?>" <?=$k==$fruitc?"selected":""?>><?= $v ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php require __DIR__ . "/__html_foot.php"; ?>