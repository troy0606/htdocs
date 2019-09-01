<?php

require __DIR__ . '/__connect_db.php';

$page_name = 'appliance_list_insert';
$page_title = '新增商品資料';

$sql = "SELECT * FROM `appliance_list` WHERE 1";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

//item_status start

$status_sql = "SELECT * FROM `item_status` ";
$status_stmt = $pdo->query($status_sql);
$status_row = $status_stmt->fetchAll();

//item_status end

//item_place start

$place_sql = "SELECT * FROM `item_place` ";
$place_stmt = $pdo->query($place_sql);
$place_row = $place_stmt->fetchAll();

//item_place end

//item_brand start

$brand_sql = "SELECT * FROM `item_brand` ";
$brand_stmt = $pdo->query($brand_sql);
$brand_row = $brand_stmt->fetchAll();

//item_brand end

// item_sort start

$sort_sql = "SELECT * FROM `item_sort` ";

$sort_stmt = $pdo->query($sort_sql);
$sort_row = $sort_stmt->fetchAll();

$level1 = [];

// 拿第一層
foreach ($sort_row as $r) {
    if ($r['sort_parent_sid'] == 0) {
        $level1[] = $r;
    }
}

// 拿第二層
foreach ($level1 as $k => $v) {
    foreach ($sort_row as $r) {
        if ($r['sort_parent_sid'] == $v['sort_sid']) {
            $level1[$k]['nodes'][] = $r;
        }
    }
}

//item_sort end


?>



<?php include __DIR__ . '/__appliance_head.php' ?>

<?php include __DIR__ . '/__appliance_sidebar.php' ?>

<nav class="navbar navbar-expand-lg">
    <h3 style="color:#FFC107; padding: 0 50px 0 0;">新增商品頁面</h3>
    <ul class="navbar-nav">
        <li class="nav-item <?= $page_name == 'appliance_list_page' ? 'active' : '' ?> ">
            <a class="nav-link" href="appliance_list_page.php"><button type="button" class="btn btn-outline-warning" style="width:200px;">返回商品列表</button></a>
        </li>
    </ul>
</nav>

<div class="container">
    <div style="margin-top:2rem;">
        <div class="alert alert-primary" role="alert" id="info_bar" style="display: none; text-align:center;"></div>
        <div class="card  text-white bg-dark" style="box-shadow: 0px 0px 80px #000000;">
            <div class="card-body">
                <form name="form1" onsubmit="return checkForm()" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- <label for="my_file">選擇上傳的圖檔</label> -->
                        <input type="file" class="form-control-file" id="item_image" name="item_image" style="display:none;" onchange="previewFile()">
                        <img id="item_image_preview" src="" height="200" alt="Image preview...">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-warning" onclick="selUpload()">選擇上傳的圖檔</button>
                    </div>
                    <small id="item_imageHelp" class="form-text" style="color:red;"></small>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_name" style="width:100px; margin:0 20px 0 0;">商品名稱</label>
                        <input type="text" class="form-control" style="width:300px; margin:0 20px 0 0;" id="item_name" name="item_name">
                        <small id="item_nameHelp" class="form-text" style="color:red;"></small>
                        <label for="item_number" style="width:100px; margin:0 20px 0 0;">商品品號</label>
                        <input type="text" class="form-control" style="width:300px; margin:0 20px 0 0;" id="item_number" name="item_number">
                        <small id="item_numberHelp" class="form-text" style="color:red;"></small>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_sort_parents_sid" style="width:100px; margin:0 20px 0 0;">商品大分類</label>
                        <select class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_sort_parents_sid" name="item_sort_parents_sid">
                            <?php foreach ($level1 as $a1) : ?>
                                <option value="<?= $a1['sort_sid'] ?>"><?= $a1['sort_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="item_sort_sid" style="width:100px; margin:0 20px 0 0;">商品小分類</label>
                        <select class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_sort_sid" name="item_sort_sid">
                        </select>
                        <small id="item_sort_sidHelp" class="form-text" style="color:red;"></small>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_price" style="width:100px; margin:0 20px 0 0;">商品價格</label>
                        <input type="text" class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_price" name="item_price">
                        <small id="item_priceHelp" class="form-text"></small>
                        <label for="item_quantity" style="width:100px; margin:0 20px 0 0;">商品數量</label>
                        <input type="text" class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_quantity" name="item_quantity">
                        <small id="item_quantityHelp" class="form-text"></small>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_status_sid" style="width:100px; margin:0 20px 0 0;">商品狀態</label>
                        <select class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_status_sid" name="item_status_sid">
                            <?php foreach ($status_row as $v) : ?>
                                <option value="<?= $v['status_sid'] ?>"><?= $v['status_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="item_status_sidHelp" class="form-text"></small>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="item_hot_sell" name="item_hot_sell" value="1">
                            <label for="item_hot_sell" style="width:80px; margin:0;">熱銷</label>
                            <small id="item_hot_sellHelp" class="form-text"></small>

                            <input type="checkbox" class="form-check-input" id="item_new_listing" name="item_new_listing" value="1">
                            <label for="item_new_listing" style="width:80px; margin:0;">新上市</label>
                            <small id="item_new_listingHelp" class="form-text"></small>

                            <input type="checkbox" class="form-check-input" id="item_hit_month" name="item_hit_month" value="1">
                            <label for="item_hit_month" style="width:80px; margin:0;">本月主打</label>
                            <small id="item_hit_monthHelp" class="form-text"></small>

                            <input type="checkbox" class="form-check-input" id="item_recommend" name="item_recommend" value="1">
                            <label for="item_recommend" style="width:80px; margin:0;">平台推薦</label>
                            <small id="item_recommendHelp" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_place_sid" style="width:100px; margin:0 20px 0 0;">製造商地點</label>
                        <select class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_place_sid" name="item_place_sid">
                            <?php foreach ($place_row as $v) : ?>
                                <option value="<?= $v['place_sid'] ?>"><?= $v['place_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="item_place_sidHelp" class="form-text"></small>
                        <label for="item_brand_sid" style="width:100px; margin:0 20px 0 0;">品牌</label>
                        <select class="form-control" style="width: 300px; margin:0 20px 0 0;" id="item_brand_sid" name="item_brand_sid">
                            <?php foreach ($brand_row as $v) : ?>
                                <option value="<?= $v['brand_sid'] ?>"><?= $v['brand_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small id="item_brand_sidHelp" class="form-text"></small>
                    </div>
                    <div class="form-group d-flex align-items-center">
                        <label for="item_feature_1" style="width:100px; margin:0 20px 0 0;">商品特點(一)</label>
                        <input type="text" class="form-control"style="width: 200px; margin:0 20px 0 0;" id="item_feature_1" name="item_feature_1">
                        <small id="item_feature_1Help" class="form-text"></small>
                        <label for="item_feature_2" style="width:100px; margin:0 20px 0 0;">商品特點(二)</label>
                        <input type="text" class="form-control"style="width: 200px; margin:0 20px 0 0;" id="item_feature_2" name="item_feature_2">
                        <small id="item_feature_2Help" class="form-text"></small>
                        <label for="item_feature_3" style="width:100px; margin:0 20px 0 0;">商品特點(三)</label>
                        <input type="text" class="form-control"style="width: 200px; margin:0 20px 0 0;" id="item_feature_3" name="item_feature_3">
                        <small id="item_feature_3Help" class="form-text"></small>
                    </div>
                    <div class="form-group">
                        <label for="item_format">規格</label>
                        <input type="text" class="form-control" id="item_format" name="item_format">
                        <small id="item_formatHelp" class="form-text"></small>
                    </div>
                    <div class="form-group">
                        <label for="item_detail">商品說明/介紹</label>
                        <input type="text" class="form-control" id="item_detail" name="item_detail">
                        <small id="item_detailHelp" class="form-text"></small>
                    </div>

                    <button type="submit" class="btn btn-outline-warning" id="submit_btn">新增</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function checkForm() {

            let fd = new FormData(document.form1);
            fetch('appliance_list_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(response => {
                    return response.json();
                })
                .then(json => {
                    // alert(txt);                    
                    console.log(json);
                    submit_btn.style.display = 'block';
                    info_bar.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if (json.success) {
                        info_bar.className = 'alert alert-dark';
                    } else {
                        info_bar.className = 'alert alert-light';
                    }
                });
            return false;

        }
    </script>

    <!-- image start -->
    <script>
        function selUpload() {
            document.querySelector('#item_image').click();
        }

        function previewFile() {
            var preview = document.querySelector('#item_image_preview');
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
    <!-- image end -->

    <!-- item_sort start  -->

    <script>
        let sort_data = <?= json_encode($level1, JSON_UNESCAPED_UNICODE) ?>;
        let sort_parents_sid = document.querySelector('#item_sort_parents_sid');
        let sort_sid = document.querySelector('#item_sort_sid');

        let whenSortSidChange = function() {
            let sort_parents_sid_id = sort_parents_sid.value;
            let i, item, c2 = '';

            for (i = 0; i < sort_data.length; i++) {
                item = sort_data[i];
                if (item.sort_sid == sort_parents_sid_id) {
                    item.nodes.forEach(function(i2) {
                        c2 += `<option value="${i2.sort_sid}">${i2.sort_name}</option>`;
                    });
                    break;
                }
            }
            sort_sid.innerHTML = c2;
        };
        sort_parents_sid.addEventListener('change', whenSortSidChange);
        whenSortSidChange();
    </script>

    <!-- item_sort end -->

</div>

<?php include __DIR__ . '/__appliance_foot.php' ?>