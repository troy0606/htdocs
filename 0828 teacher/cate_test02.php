<?php

require __DIR__ . '/__connect_db.php';

$sql = "SELECT * FROM `categories` ";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

$level1 = [];

// 拿第一層
foreach ($rows as $r) {
    if ($r['parent_sid'] == 0) {
        $level1[] = $r;
    }
}

// 拿第二層
foreach ($level1 as $k => $v) {
    foreach ($rows as $r) {
        if ($r['parent_sid'] == $v['sid']) {
            $level1[$k]['nodes'][] = $r;
        }
    }
}



// echo json_encode($level1, JSON_UNESCAPED_UNICODE);
?>
<?php include __DIR__ . '/__html_head.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form>
                    <div class="form-group">
                        <label for="cate1">cate1</label>
                        <select class="form-control" id="cate1" name="cate1">
                            <?php foreach($level1 as $a1): ?>
                            <option value="<?= $a1['sid'] ?>"><?= $a1['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cate2">cate2</label>
                        <select class="form-control" id="cate2" name="cate2">
                        </select>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        let cate_data = <?= json_encode($level1, JSON_UNESCAPED_UNICODE) ?>;
        let cate1 = document.querySelector('#cate1');
        let cate2 = document.querySelector('#cate2');

        let whenCate1Change = function(){
            let cate1_id = cate1.value;
            let i, item, c2='';

            for(i=0; i<cate_data.length; i++){
                item = cate_data[i];
                if(item.sid==cate1_id){
                    item.nodes.forEach(function(i2){
                        c2 += `<option value="${i2.sid}">${i2.name}</option>`;
                    });
                    break;
                }
            }
            cate2.innerHTML = c2;
        };
        cate1.addEventListener('change', whenCate1Change);
        whenCate1Change();






    </script>
<?php include __DIR__ . '/__html_foot.php' ?>






