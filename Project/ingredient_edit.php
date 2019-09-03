<?php
$page_name = 'insertData';
$page_title = '新增資料';
require __DIR__ . "/ingredient_connect.php";
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/navbar_in.php";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($_GET['sid'])) {
    header('Location:datalist.php');
    exit;
}

$sql = "SELECT * FROM `ingredient` WHERE `sid`=$sid";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();


$sql = "SELECT * FROM `categories`";
$stmt = $pdo->query($sql);
$rows2 = $stmt->fetchAll();

$level1 = [];

// 拿第一層
foreach ($rows2 as $r) {
    if ($r['parent_sid'] == 0) {
        $level1[] = $r;
    }
}

// 拿第二層
foreach ($level1 as $k => $v) {
    foreach ($rows2 as $r) {
        if ($r['parent_sid'] == $v['cate_sid']) {
            $level1[$k]['nodes'][] = $r;
        }
    }
}

$sql = "SELECT * FROM `tags` ";

$stmt = $pdo->query($sql);
$rows3 = $stmt->fetchAll();

// $tag = empty($_POST['tag']) ? [] : $_POST['tag'];
// $tag = [];
// $k = 1;

// print_r($rows3.LengthException);


$tag = [
    '1' => $rows3[0]['tag_name'],
    '2' => $rows3[1]['tag_name'],
    '3' => $rows3[2]['tag_name'],
    '4' => $rows3[3]['tag_name'],
    '5' => $rows3[4]['tag_name']
];

$sql = "SELECT * FROM `on-sale` ";
$stmt = $pdo->query($sql);
$sale_row = $stmt->fetchAll();


// print_r($rows2[$row['minor_category'] - 1]['cate_name']);
// print_r($rows2[$row['primary_category'] - 1]['cate_name']);

$checkedTag = json_decode($row['tag'], true);

?>

<style>
    .form-group small {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="alert alert-primary" role="alert" style="display:none" id="bar_info"></div>
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <div class="d-flex"><h5 class=" card-title">修改資料</h5>
                    <a href="ingredient_datalist.php"><button class="btn btn-outline-warning">返回</button></a></div>
                    <form name="form1" onsubmit="return check()" enctype="multipart/form-data">
                        <input type="hidden" name="sid" value="<?= htmlentities($row['sid']) ?>">
                        <!-- 資料送出時返回函式check的值 -->
                        <div class="form-group">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $v = json_decode($row['pic_name']) ?>
                                    <?php $i = 0; ?>
                                    <?php foreach ($v as $a) : ?>
                                        <div class="carousel-item <?= $i == 0 ? "active" : " "; ?>  " data-interval="1000">
                                            <img src="uploads/<?= $a; ?>" class="d-block w-100" alt="...">
                                        </div>
                                        <?php $i = $i + 1; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="form-group">商品圖片
                                <img src="<?= 'uploads/' . $row['pic_name'] ?>" height="200" id="preview">
                                <input type="file" class="form-control-file" id="pic_name" name="pic_name[]" onchange="previewFile()" style="display:none" multiple><br>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                            </div>
                            <small id="pic-nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="product_name">商品名稱</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product_name" value="<?= htmlentities($row['product_name']) ?>">
                            <small id="product_nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="primary_category">大分類</label>
                            <select class="form-control" id="primary_category" name="primary_category">
                                <?php foreach ($level1 as $a1) : ?>
                                    <option value="<?= $a1['cate_sid'] ?>" <?= $a1['cate_sid'] == $row['primary_category'] ? "selected" : "" ?>><?= $a1['cate_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="minor_category">小分類</label>
                            <select class="form-control" id="minor_category" name="minor_category">
                            </select>
                        </div>
                        <div class="form-group">標籤<br>
                            <?php foreach ($tag as $k => $v) : ?>
                                <?php $tag = empty($_POST['tag']) ? '[]' : $_POST['tag']; ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input checkbox" type="checkbox" name="tag[]" id="tag<?= $k ?>" value="<?= $k ?>" <?= htmlentities(in_array($k, $checkedTag)) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="tag<?= $k ?>"><span></span><?= $v ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">價格</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="price" value="<?= htmlentities($row['price']) ?>">
                            <small id="priceHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="quantity">數量</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity" value="<?= htmlentities($row['quantity']) ?>">
                            <small id="quantityHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="sale">商品狀態</label>
                            <select class="form-control" id="sale" name="sale">
                                <?php foreach ($sale_row as $v) : ?>
                                    <option value="<?= $v['sale_sid'] ?>" <?= $v['sale_sid'] == $row['sale'] ? "selected" : "" ?>><?= $v['on_sale_status'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="made_in">產地</label>
                            <input type="text" class="form-control" id="made_in" name="made_in" placeholder="made_in" value="<?= htmlentities($row['made_in']) ?>">
                            <small id="made_inHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="weight">重量</label>
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="weight" value="<?= htmlentities($row['weight']) ?>">
                            <small id="weightHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="ingredient">成分</label>
                            <input type="text" class="form-control" id="ingredient" name="ingredient" placeholder="ingredient" value="<?= htmlentities($row['ingredient']) ?>">
                            <small id="ingredientHelp" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let bar_info = document.querySelector("#bar_info");

            function check() {

                let fd = new FormData(document.form1);

                if (true) {
                    fetch("ingredient_edit-api.php", {
                            method: 'POST',
                            body: fd
                        })
                        .then(response => {
                            return response.json();
                        })
                        .then(json => {
                            bar_info.style.display = "block";
                            bar_info.innerHTML = json.info;
                            if (json.success) {
                                bar_info.className = "alert alert-success";
                                setTimeout(function() {
                                    location.href = 'ingredient_datalist.php';
                                }, 1000);
                            } else {
                                bar_info.className = "alert alert-danger";
                            }
                        })
                }
                return false;
            }
        </script>
        <script>
            function selUpload() {
                document.querySelector('#pic_name').click();
            }
        </script>
        <script>
            function previewFile() {
                var preview = document.querySelector('#preview');
                var file = document.querySelector('input[type=file]').files[0];
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    preview.src = reader.result;
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        </script>
        <script>
            let cate_data = <?= json_encode($level1, JSON_UNESCAPED_UNICODE) ?>;
            let cate1 = document.querySelector('#primary_category');
            let cate2 = document.querySelector('#minor_category');

            let whenCate1Change = function() {
                let cate1_id = cate1.value;

                let i, item, c2 = '';

                for (i = 0; i < cate_data.length; i++) {
                    item = cate_data[i];
                    if (item.cate_sid == cate1_id) {
                        item.nodes.forEach(function(i2) {
                            c2 += `<option value="${i2.cate_sid}">${i2.cate_name}</option>`;
                        });
                        break;
                    }
                }
                cate2.innerHTML = c2;
            };
            cate1.addEventListener('change', whenCate1Change);
            whenCate1Change();
        </script>
    </div>
</div>
<?php require __DIR__ . "/footer_in.php"; ?>