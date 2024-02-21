<?php

/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], './imgs/' . $_FILES['img']['tmp_name']); //檔案存在本地
    $source_path = './imgs/' . $_FILES['img']['tmp_name']; //此檔名包含附檔名
    $type = $_FILES['img']['type'];
    switch ($type) {
        case 'images/jpeg':
            $source = imagecreatefromjpeg($source_path);
            list($width, $heigh) = getimagesize($source_path);
            break;
        case 'images/png':
            $source = imagecreatefrompng($source_path);
            list($width, $heigh) = getimagesize($source_path);

            break;
        case 'images/gif':
            $source = imagecreatefromgif($source_path);
            list($width, $heigh) = getimagesize($source_path);
            break;
        case 'images/bmp':
            $source = imagecreatefrombmp($source_path);
            list($width, $heigh) = getimagesize($source_path);
            break;
    }
    $dst_path = './imgs/small_' . $_FILES['img']['tmp_name'];
    $dst_width=150;
    $dst_heigh=200;
    $dst_source=imagecreatetruecolor($dst_width,$dst_heigh);
    imagecopyresampled($dst_source,$source,0,0,0,0,$dst_width,$dst_heigh,$width,$heigh);

    switch ($type) {
        case 'images/jpeg':
            imagejpeg($dst_source,$dst_path);
            break;
        case 'images/png':
            imagepng($dst_source,$dst_path);
            break;
        case 'images/gif':
            imagegif($dst_source,$dst_path);
            break;
        case 'images/bmp':
            imagejpeg($dst_source,$dst_path);
            break;
    }

    imagedestroy($source);
    imagedestroy($dst_source);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形檔案處理</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 class="header">圖形處理練習</h1>
    <!---建立檔案上傳機制--->

    <form action="?" method="post" enctype="multipart/form-data">
        <label for="">選擇檔案：</label>
        <input type="file" name="img" id="">
        <input type="button" value="上傳">
    </form>


    <!----縮放圖形----->
    <img src="<?=$dst_path;?>" alt="">


    <!----圖形加邊框----->


    <!----產生圖形驗證碼----->



</body>

</html>