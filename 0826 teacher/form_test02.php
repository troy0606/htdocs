<?php

$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid(). $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']];


        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir. $new_filename. $new_ext);
    }
}



?>
<?php include __DIR__ . '/__html_head.php' ?>

<div class="container">
    <div>
        <pre><?php
            if(! empty($_FILES))
                var_dump($_FILES);
            ?>
        </pre>
    </div>
    <form name="form1" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <!-- <label for="my_file">選擇上傳的圖檔</label> -->
            <input type="file" class="form-control-file" id="my_file" name="my_file" style="display: none">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>
<script>
    function selUpload(){
        document.querySelector('#my_file').click();
    }
</script>


<?php include __DIR__ . '/__html_foot.php' ?>






