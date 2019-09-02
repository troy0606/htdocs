<?php
$page_name = 'ingredient_insertData';
$page_title = 'ingredient_insertData';
require __DIR__ . "/ingredient_connect.php";
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/navbar_in.php";
$sql = "SELECT * FROM `ingredient` WHERE 1";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();
// $columName = [];
// foreach ($rows[0] as $k => $v) {
//     $columName[] = $k;
// }

// print_r($columName);
// echo $columName[0];
// print_r($rows[]['pic_name']);

$sql = "SELECT * FROM `categories` ";

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

$tag = empty($_POST['tag']) ? [] : $_POST['tag'];
$tag = [
    '1' => $rows3[0]['tag_name'],
    '2' => $rows3[1]['tag_name'],
    '3' => $rows3[2]['tag_name'],
    '4' => $rows3[3]['tag_name'],
    '5' => $rows3[4]['tag_name']
];



?>

<style>
    .form-group small {
        color: red;
    }
</style>

<nav class="navbar navbar-expand-lg">
    <h3 style="color:#FFC107; padding: 0 50px 0 0;">新增商品頁面</h3>
    <ul class="navbar-nav">
        <li class="nav-item <?= $page_name == 'ingredient_datalist' ? 'active' : '' ?> ">
            <a class="nav-link" href="ingredient_datalist.php"><button type="button" class="btn btn-outline-warning" style="width:200px;">返回商品列表</button></a>
        </li>
    </ul>
</nav>
<div class="container">
    <div style="margin-top:2rem;">
        <div class="alert alert-primary" role="alert" id="info_bar" style="display: none; text-align:center;"></div>
        <div class="card  text-white bg-dark" style="box-shadow: 0px 0px 80px #000000;">
            <div class="card-body">
                <form name="form1" onsubmit="return check()" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- <img src="" height="200" id="preview"> -->
                        <input type="file" class="form-control-file" id="pic_name" name="pic_name[]" onchange="previewFiles()" style="display:none" multiple><br>
                    </div>
                    <div class="form-group">
                        <div id="preview"></div>
                        <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                        <small id="pic-nameHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="product_name" style="width:100px; margin:0 20px 0 0;">食材名稱</label>
                        <input type="text" class="form-control" id="product_name" style="width:300px; margin:0 20px 0 0;" name="product_name" placeholder="Enter product_name">
                        <small id="product_nameHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="primary_category" style="width:100px; margin:0 20px 0 0;">大分類</label>
                        <select class="form-control" id="primary_category" name="primary_category">
                            <?php foreach ($level1 as $a1) : ?>
                                <option value="<?= $a1['cate_sid'] ?>" style="width:300px; margin:0 20px 0 0;"><?= $a1['cate_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="minor_category">小分類</label>
                        <select class="form-control" id="minor_category" name="minor_category">
                        </select>
                    </div>
                    <div class="form-group">
                        <?php foreach ($tag as $k => $v) : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" id="tag<?= $k ?>" value="<?= $k ?>" <?= in_array($k, $tag) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="tag<?= $k ?>"><?= $v ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="price">價格</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="price">
                        <small id="priceHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="quantity">數量</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity">
                        <small id="quantityHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="made_in">產地</label>
                        <input type="text" class="form-control" id="made_in" name="made_in" placeholder="made_in">
                        <small id="made_inHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="weight">重量</label>
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="weight">
                        <small id="weightHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="ingredient">成分</label>
                        <input type="text" class="form-control" id="ingredient" name="ingredient" placeholder="ingredient">
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
                fetch("ingredient_insertData-api.php", {
                        method: 'POST',
                        body: fd
                    })
                    .then(response => {
                        return response.json();
                        console.log(response);
                    })
                    .then(jsonObj => {
                        console.log(jsonObj);
                        bar_info.style.display = "block";
                        bar_info.innerHTML = jsonObj.info;
                        if (jsonObj.success) {
                            bar_info.className = "alert alert-success";
                        } else {
                            bar_info.className = "alert alert-danger";
                        }
                    })
            }
            return false;
        }
    </script>
    <script>
        function previewFiles() {
            var preview = document.querySelector('#preview');
            var files = document.querySelector('input[type=file]').files;

            function readAndPreview(file) {
                // Make sure `file.name` matches our extensions criteria
                if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    var reader = new FileReader();
                    reader.addEventListener("load", function() {
                        var image = new Image();
                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        preview.appendChild(image);
                    }, false);
                    reader.readAsDataURL(file);
                }
            }
            if (files) {
                [].forEach.call(files, readAndPreview);
            }
        }

        function selUpload() {
            document.querySelector('#pic_name').click();
        }
    </script>
    <script>
        let cate_data = <?= json_encode($level1, JSON_UNESCAPED_UNICODE) ?>;
        let cate1 = document.querySelector('#primary_category');
        let cate2 = document.querySelector('#minor_category');

        let whenCate1Change = function() {
            let cate1_id = cate1.value;
            console.log(cate1_id);
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