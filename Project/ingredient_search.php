<?php
session_start();
$page_name = 'datalist';
$page_title = '全部商品列表';
require __DIR__ . "/ingredient_connect.php";

// if(empty($_GET['inputPassword2'])){
//     header("Location:".$_SERVER['HTTP_REFERER']);
// }


$search_result = $_SESSION['search'];
$sql = "SELECT * FROM `ingredient` WHERE `ingredient`.`sid`= $search_result";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

$sql =
    "SELECT `ingredient`.* ,`on-sale`.* 
FROM `ingredient` 
JOIN `on-sale` 
ON `ingredient`.`sale` = `on-sale`.`sale_sid`";
$stmt = $pdo->query($sql);
$row2 = $stmt->fetch();

if(!empty ($_GET['inputPassword2'])){
    $search = $_GET['inputPassword2'];
    $tst = $pdo->query("SELECT COUNT(*) FROM `ingredient` WHERE `ingredient`.`sid`= $search");

    if($tst->rowCount()>0){
        session_start();
        $_SESSION['search'] = $search;
        header('Location: ingredient_search.php');
    }else{
        exit;
    }
}

?>
<?php
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/navbar_in.php";
require __DIR__ . "/ingredient_navbar.php";
?>
<style>
    .main-section {
        width: 90%;
        margin: auto;
    }

    .form-group small {
        color: red;
    }
</style>
<div style="margin-top:2rem;">
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarSupportedContent">
            <nav style="width: 250px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button id="allDelete" type="submit" class="btn btn-outline-warning" style="width:100px;  margin-right:20px;" onclick="return confirm('確定刪除嗎？')">批量刪除</button>
                    </li>
                </ul>
            </nav>
            <form class="form-inline" name="form_search" action="" method="get">
                <div class="form-group mx-sm-3 mb-2" style="margin:8px;">
                    <label for="inputPassword2" class="sr-only"></label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="請輸入商品編號" name="inputPassword2">

                </div>
                <button type="submit" class="btn btn-outline-warning mb-2" style="margin:8px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </nav>
</div>

<div style="margin-top:2rem;"></div>

<form method="post" id="all_form" enctype="application/x-www-form-urlencoded">
    <table class="table table-hover table-dark" style="box-shadow: 0px 0px 80px #000000;">
        <thead>
            <tr>
                <th scope="col"><input type="checkbox" onclick="checkAll()" id="check_all"><label for="check_all" style="margin:0;"><span></span></label>全選</th>
                <th scope="col">商品圖片</th>
                <th scope="col">品號</th>
                <th scope="col">名稱</th>
                <th scope="col">數量
                    <a href="?ingredient_column=quantity&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=quantity&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">價格
                    <a href="?ingredient_column=price&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=price&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">狀態</th>
                <th scope="col">新增時間
                    <a href="?ingredient_column=create_at&ingredient_up_down=ASC"><i class="fas fa-long-arrow-alt-up"></i></a>
                    <a href="?ingredient_column=create_at&ingredient_up_down=DESC"><i class="fas fa-long-arrow-alt-down"></i></a>
                </th>
                <th scope="col">功能列表</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><input type="checkbox" id="check<?= $i ?>" class="checkbox" name="checkOne[]" value="<?= htmlentities("{$row['sid']}") ?>"><label for="check<?= $i ?>"><span></span></label></td>
                    <td><img src="<?= 'uploads/' . json_decode($row['pic_name'])[0] ?>" class="d-block w-100" style="max-width:100px; overflow:hidden;" alt=""></td>
                    <td><?= htmlentities("{$row['sid']}") ?></td>
                    <td><?= htmlentities("{$row['product_name']}") ?></td>
                    <td><?= htmlentities("{$row['quantity']}") ?></td>
                    <td><?= htmlentities("{$row['price']}") ?></td>
                    <td><?= htmlentities("{$row['on_sale_status']}") ?></td>
                    <td><?= htmlentities("{$row['create_at']}") ?></td>
                    <td scope="col"><a href="javascript:delete_one(<?= $row['sid'] ?>)"><i class="fas fa-trash-alt" style="color:#fff; margin-right:20px;"></i></a>
                        <a href="appliance_list_edit.php?item_sid=<?= $row['sid'] ?>"><i class="fas fa-edit" style="color:#fff;"></i></a></td>
                </tr>
        </tbody>
    </table>
</form>
<script>
    function delete_one(item_sid) {
        if (confirm(`確定要刪除編號為 ${item_sid} 的資料嗎?`)) {
            location.href = 'appliance_list_delete.php?item_sid=' + item_sid;
        }
    }
</script>

<!-- 全選 checkbox start -->

<script>
    function checkAll() {
        var checkAllEl = document.getElementById("check_all");
        if (checkAllEl.checked == true) {
            var checkOnes = document.getElementsByName("checkOne[]");
            for (var i = 0; i < checkOnes.length; i++) {
                checkOnes[i].checked = true;
            }
        } else {
            var checkOnes = document.getElementsByName("checkOne[]");
            for (var i = 0; i < checkOnes.length; i++) {
                checkOnes[i].checked = false;
            }
        }
    }
</script>

<!-- 全選 checkbox end -->

<!-- 批量操作 start -->
<script>
    var form_submit = document.getElementById('all_form');
    var go = document.getElementById('allDelete');
    go.addEventListener('click', () => {
        form_submit.action = 'ingredient_allDelete_api.php';
        form_submit.submit();
    });
</script>

<?php
require __DIR__ . "/footer_in.php";
?>