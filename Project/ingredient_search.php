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
            <form class="form-inline" name="form_search" action="ingredient_search.php" method="get">
                <div class="form-group mx-sm-3 mb-2" style="margin:8px;">
                    <label for="inputPassword2" class="sr-only"></label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="請輸入商品編號" name="inputPassword2">
                </div>
                <button type="submit" class="btn btn-primary mb-2" style="margin:8px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </nav>
</div>
<div style="margin-top:2rem;"></div>
<div class="main-section">
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th>
                    <input type="checkbox">
                </th>
                <th scope="col">商品圖</th>
                <th scope="col"><a href="?sequence=sid">商品品號</a></th>
                <th scope="col">食材名稱</th>
                <th scope="col"><a href="?sequence=price">價格</a></th>
                <th scope="col">數量</th>
                <th scope="col">商品狀態</th>
                <th scope="col"><a href="?sequence=create_at">新增時間</th>
                <th scope="col"><i class="fas fa-trash"></i></th>
                <th scope="col"><i class="fas fa-book"></i></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input name="checkForm[]" type="checkbox" value="<?= htmlentities("{$row['sid']}") ?>">
                </td>
                <td><img src="<?= 'uploads/' . json_decode($row['pic_name'])[0] ?>" height='100px'></td>
                <td><?= htmlentities("{$row['sid']}") ?></td>
                <td><?= htmlentities("{$row['product_name']}") ?></td>
                <td><?= htmlentities("{$row['price']}") ?></td>
                <td><?= htmlentities("{$row['quantity']}") ?></td>
                <td><?= htmlentities("{$row2['on_sale_status']}") ?></td>
                <td><?= htmlentities("{$row['create_at']}") ?></td>
                <td>
                    <a href="javascript:delete2(<?= $row['sid'] ?>)">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                <td><a href="ingredient_edit.php?sid=<?= $row['sid'] ?>"><i class="fas fa-book"></i></a></td>
            </tr>
        </tbody>
    </table>
</div>


<script>
    function delete2(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'ingredient_delete.php?sid=' + sid;
        }
    }
</script>
<script>
</script>


<?php

require __DIR__ . "/footer_in.php";
?>
