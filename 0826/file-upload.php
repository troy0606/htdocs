<?php
require __DIR__ . "/__html_head.php";

$upload_dir = __DIR__ . '/upload/';

$allow = [
    'image/jpeg',
    'image/png'
];


$ext = [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png',
];

if (!empty($_FILES['my-file'])) { // 有沒有上傳
    foreach($_FILES['my-file']['name'] as  $pic){

      $array_pic[]=$pic;
      print_r($array_pic);
    // if (in_array($pic['type'], $allowed_types)) { // 檔案類型是否允許      
    // }
}
}



// $array_pic = json_encode($pic_array, JSON_UNESCAPED_UNICODE);

?>
<div class="card m-auto" style="width: 30rem">
    <pre><?php
            if (!empty($_FILES))
                var_dump($_FILES);
            ?>
        </pre>
    <form name="form1" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <!-- <label for="my-file">選擇上傳圖片</label> -->
            <input type="file" class="form-control" id="my-file" name="my-file[]" style="display:none" multiple>
            <div class="form-group">
                <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
    function selUpload(){
        document.querySelector("#my-file").click();
    }
</script>
<?php require __DIR__ . "/__html_foot.php"; ?>