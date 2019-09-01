<?php
require __DIR__ . '/__connect.php';
?>
<?php
$page_name = 'dataEdit';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($_GET['sid'])) {
    header('Location:datalist.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM `ingredient` WHERE `sid`=$sid");
$row = $stmt->fetch();

if (empty($stmt)) {
    header('Location:datalist.php');
    exit;
}

require __DIR__ . "/PG-up.php";

?>
<style>
    .form-group small {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="alert alert-primary" role="alert" id="info_bar" style="display:none"></div>
                <div class="card-body">
                    <h5 class=" card-title">修改</h5>
                    <form name="insertData-api" onsubmit="return checkForm()">
                    <input type="hidden" name="sid" value="<?= htmlentities($row['sid']) ?>">
                        <div class="form-group">
                            <label for="name">食材名稱</label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Enter name" value="<?= htmlentities($row['name']) ?>">
                            <small id="nameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="primary_category">大類別</label><br>
                            <select name="primary_category" id="primary_category" value="<?= htmlentities($row['primary_category']) ?>">
                                <option value="粉類">粉類</option>
                                <option value="乳製產品">乳製品</option>
                                <option value="乾果雜糧/粉">乾果雜糧/粉</option>
                                <option value="調色/裝飾">調色/裝飾</option>
                                <option value="巧克力">巧克力</option>
                                <option value="膠凍材料">膠凍材料</option>
                                <option value="調味">調味</option>
                                <option value="油脂類">油脂類</option>
                                <option value="膨大劑">膨大劑</option>
                            </select>
                            <small id="primary_categoryHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="minor_category">小類別</label>
                            <input type="text" class="form-control" id="minor_category" name="minor_category" placeholder="Enter minor_category" value="<?= htmlentities($row['minor_category']) ?>">
                            <small id="minor_categoryHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="tag">標籤</label>
                            <input type="text" class="form-control" id="tag" name="tag" placeholder="tag" value="<?= htmlentities($row['tag']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">價格</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="price" value="<?= htmlentities($row['price']) ?>">
                            <small id="priceHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="quantity">庫存</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="quantity" value="<?= htmlentities($row['quantity']) ?>">
                            <small id="quantityHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="status">商品狀態</label><br>
                            <select name="status" id="status" value="<?= htmlentities($row['status']) ?>">
                                <option selected value="優惠">優惠</option>
                                <option value="搶購">搶購</option>
                                <option value="缺貨">缺貨</option>
                            </select>
                            <small id="statusHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="made_in">產地</label>
                            <input type="text" class="form-control" id="made_in" name="made_in" placeholder="made_in" value="<?= htmlentities($row['made_in']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="weight">重量</label>
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="weight" value="<?= htmlentities($row['weight']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="ingredient">成分</label>
                            <input type="text" class="form-control" id="ingredient" name="ingredient" placeholder="ingredient" value="<?= htmlentities($row['ingredient']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="sale">sale</label>
                            <select name="sale" id="sale"></select>
                            <option value="1">上架</option>
                            <option value="0">上架</option>
                            <small id="saleHelp" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
            // let bar_info = document.querySelector("#bar_info");

            // let i, s, item;

            // const require_field = [{
            //         id: "name",
            //         pattern: /^\S{2,}/,
            //         info: "請輸入正確名稱"
            //     },
            //     {
            //         id: "mobile",
            //         pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
            //         info: "請輸入正確手機格式"
            //     },
            //     {
            //         id: "email",
            //         pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
            //         info: "請輸入正確信箱格式"
            //     }
            // ]

            // for (s in require_field) {
            //     item = require_field[s]
            //     item.el = document.querySelector("#" + item.id);
            //     item.info = document.querySelector("#" + item.id + "Help");
            // }

            // function check() {

            //     for (s in require_field) {
            //         item = require_field[s];
            //         item.el.style.border = "1px solid #CCCCCC";
            //         item.info.innerHTML = "";
            //     }
            //     let isPass = true;
            //     for (s in require_field) {
            //         item = require_field[s];
            //         if (!item.pattern.test(item.el.value)) {
            //             item.el.style.border = "1 px solid red";
            //             item.info.innerHTML = item.info;
            //             isPass = false;
            //         }
            //     }


                let fd = new FormData(document.form1);
                if (isPass) {
                    fetch("dataedit-api.php", {
                            method: 'POST',
                            body: fd
                        })
                        .then(response => {
                            return response.json();
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
    </div>
</div>
<?php include __DIR__ . '/PG-down.php' ?>