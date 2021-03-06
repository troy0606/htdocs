<?php

use PhpMyAdmin\Console;


$page_name = 'datalist';
$page_title = '全部商品列表';
require __DIR__ . "/ingredient_connect.php";
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// $totalPage = $totalRows / $perPage;
$tst = $pdo->query('SELECT COUNT(*) FROM `ingredient`');
$perPage = 10;
$totalRows = $tst->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page < 1) {
    header("Location:ingredient_datalist.php?page=1");
    $page = 1;
}
if ($page > $totalPages) {
    header("Location:ingredient_datalist.php?page={$totalPages}");
    $page = $totalPages;
}

$params = [];

$ingredient_column = isset($_GET['ingredient_column']) ? $_GET['ingredient_column'] : "sid";
$ingredient_up_down = isset($_GET['ingredient_up_down']) ? $_GET['ingredient_up_down'] : "ASC";
$params['ingredient_column'] = $ingredient_column;
$params['ingredient_up_down'] = $ingredient_up_down;


$sql = sprintf(
    "SELECT `ingredient`.* ,`on-sale`.* 
FROM `ingredient` 
JOIN `on-sale` 
ON `ingredient`.`sale` = `on-sale`.`sale_sid` 
ORDER BY `%s` %s",
    $ingredient_column,
    $ingredient_up_down
);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();


if (!empty($_GET['inputPassword2'])) {
    $search = $_GET['inputPassword2'];
    $tst = $pdo->query("SELECT COUNT(*) FROM `ingredient` WHERE `ingredient`.`sid`= $search");
    $tst = $tst->fetch();
    $tst = (intval($tst['COUNT(*)']));
    if ($tst > 0) {
        session_start();
        $_SESSION['search'] = $search;
        header('Location: ingredient_search.php');
    } else {
        header('Location: ingredient_datalist.php');
    }
}

$sql = "SELECT `ingredient`.`sid` FROM `ingredient`";


?>
<?php
require __DIR__ . "/html_head_in.php";
require __DIR__ . "/ingredient_navbar_in.php";
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

    #all_form {
        height: 770px;
        max-width: 900px;
        background-color: #000;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
    }

    .formContainer {
        display: flex;
        position: absolute;
        left: 0px;
        flex-shrink: 0;
        transition: .8s;
        height: 770px;
        max-width: 4500px;
    }

    .formContainer table {
        height: 100%;
        width: 900px;
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
            <nav aria-label="Page navigation example" style="color: #15141A;" id="pageLine">
                <ul class="pagination" style="margin:0;">
                    <li class="page-item">
                        <a class=" page-link">
                            <i class="fas fa-angle-double-left" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" id="prevP">
                            <i class="fas fa-angle-left" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <?php
                    if ($totalPages < 10) {
                        $p_start = 1;
                        $p_end = $totalPages;
                    } else if ($page - 4 < 1) {
                        $p_start = 1;
                        $p_end = 9;
                    } else if ($page + 4 > $totalPages) {
                        $p_start = $totalPages - 8;
                        $p_end = $totalPages;
                    } else {
                        $p_start = $page - 4;
                        $p_end = $page + 4;
                    }
                    for ($i = $p_start; $i < $p_end + 1; $i++) :
                        $params['page'] = $i;
                        ?>
                        <li class="page-item  <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link d-flex justify-content-center" style="width:55px; margin:0 auto; color: #15141A;" data-page="<?= ${i} ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" id="nextP">
                            <i class="fas fa-angle-right" style="color: #15141A;"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <i class="fas fa-angle-double-right" style="color: #15141A;"></i>
                        </a>
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

<h6 style="color: #fff;">資料總筆數：<?= $totalRows ?></h6>

<form method="post" id="all_form" enctype="application/x-www-form-urlencoded">
    <div class="formContainer">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
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
                <?php if ($i < $totalPages) : ?>
                    <tbody class="py-2">
                        <?php for ($j = $perPage * ($i - 1); $j < $perPage * $i; $j++) : ?>
                            <tr>
                                <td><input type="checkbox" id="" class="checkbox" name="checkOne[]" value="<?= $rows[$j]['sid'] ?>"><label for=""><span></span></label></td>
                                <td>
                                    <img src="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" data-lightbox="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" class="d-block w-100" style="max-width:100px; overflow:hidden;" alt="">
                                    <a href="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" data-lightbox="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>"></a>
                                </td>
                                <td><?= htmlentities("{$rows[$j]['sid']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['product_name']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['quantity']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['price']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['on_sale_status']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['create_at']}") ?></td>
                                <td scope="col"><a href="javascript:delete_one(<?= $rows[$j]['sid'] ?>)"><i class="fas fa-trash-alt" style="color:#fff; margin-right:20px;"></i></a>
                                    <a href="ingredient_edit.php?sid=<?= $rows[$j]['sid'] ?>"><i class="fas fa-edit" style="color:#fff;"></i></a></td>
                            </tr>
                        <?php endfor; ?>
                    <?php else : ?>
                        <?php for ($j = $perPage * ($i - 1); $j < $totalRows; $j++) : ?>
                            <tr>
                                <td><input type="checkbox" id="" class="checkbox" name="checkOne[]" value="<?= $rows[$j]['sid'] ?>"><label for=""><span></span></label></td>
                                <td>
                                    <img src="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" data-lightbox="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" class="d-block w-100" style="max-width:100px; overflow:hidden;" alt="">
                                    <a href="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>" data-lightbox="<?= 'uploads/' . json_decode($rows[$j]['pic_name'])[0] ?>"></a>
                                </td>
                                <td><?= htmlentities("{$rows[$j]['sid']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['product_name']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['quantity']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['price']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['on_sale_status']}") ?></td>
                                <td><?= htmlentities("{$rows[$j]['create_at']}") ?></td>
                                <td scope="col"><a href="javascript:delete_one(<?= $rows[$j]['sid'] ?>)"><i class="fas fa-trash-alt" style="color:#fff; margin-right:20px;"></i></a>
                                    <a href="ingredient_edit.php?sid=<?= $rows[$j]['sid'] ?>"><i class="fas fa-edit" style="color:#fff;"></i></a></td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    </tbody>
            </table>
        <?php endfor; ?>
    </div>

</form>
<script>
    function delete_one(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = 'ingredient_delete.php?sid=' + sid;
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
<script>
    let page = 0;
    let option = {
        prevP: page - 1,
        nextP: page + 1
    }
    let pageLength = $("#pageLine a[data-page]").length;
    $("#pageLine a").click(function() {
        let select = $(this).attr("id");
        if (option[select]) {
            console.log(11);
            option = {
                prevP: page - 1,
                nextP: page + 1
            }
            page = option[select];
            if (page < 0){
                page = 0;
            }
            else if(page > pageLength){
                page = pageLength-1;
            }
        } else {
            page = $(this).text() - 1;
        }
        console.log(page);
        $(".formContainer").css("left", page * -900);
        console.log(page);
    })
</script>
<?php
require __DIR__ . "/footer_in.php";
?>