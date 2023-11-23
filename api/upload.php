<?php
include_once "../db.php";
/* echo $_POST['name'];
echo "<br>"; */
if(!empty($_FILES['img']['tmp_name'])){
/*     echo $_FILES['img']['tmp_name'];
    echo "<br>";
    echo $_FILES['img']['name'];
    echo "<br>";
    echo $_FILES['img']['type'];
    echo "<br>";
    echo $_FILES['img']['size']; */
    $tmp=explode(".",$_FILES['img']['name']);
    $subname=".".end($tmp);
    $filename=date("YmdHis").rand(10000,99999).$subname;
    move_uploaded_file($_FILES['img']['tmp_name'],"../imgs/".$filename);

// 錯誤訊息

/**
     * application/vnd.openxmlformats-officedocument.wordprocessingml.document - word
     * application/vnd.openxmlformats-officedocument.spreadsheetml.sheet-excel
     * application/vnd.openxmlformats-officedocument.presentationml.presentation-ppt
     * application/pdf - pdf
     */
// 錯誤訊息
     switch($_FILES['img']['type']){
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            $type="msword";
        break;
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            $type='msexcel';
        break;
        case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            $type='msppt';
        break;
        case "application/pdf":
            $type='pdf';
        break;
        case "image/webp":
        case "image/jpeg":
        case "image/png":
        case "image/gif":
        case "image/bmp":
            $type=$_FILES['img']['type'];
        break;
        default:
            $type='other';

     }




    

    $file=['name'=>$filename,
            'type'=>$type,
            'size'=>$_FILES['img']['size'],
            'desc'=>$_POST['desc']];

    insert('files',$file);
    //header("location:../upload.php?img=".$filename);
    header("location:../manage.php");
}else{
    header ("location:../upload.php?err = 上傳失敗");
}

?><?php

echo $_POST['name'];
echo "<br>";
// 檢查是否有上傳的檔案
if (!empty($_FILES['img']['tmp_name'])) {
    // 輸出暫存檔案的路徑
    echo $_FILES['img']['tmp_name'];
    echo "<br>";
    // 輸出上傳的檔案名稱
    echo $_FILES['img']['name'];
    echo "<br>";
    // 輸出上傳的檔案類型
    echo $_FILES['img']['type'];
    echo "<br>";
    // 輸出上傳的檔案大小
    echo $_FILES['img']['size'];
    // 從上傳的檔案名稱中取得檔案副檔名
    $tmp = explode(".", $_FILES['img']['name']);
    $subname = "." . end($tmp);

    // 生成新的檔案名稱，包含日期、時間和隨機數字
    $filename = date("YmdHis") . rand(10000, 99999) . $subname;

    // 將上傳的檔案移動到目標資料夾
    move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $filename);

    // 重新導向到上傳頁面並將新的檔案名稱作為參數傳遞
    header("location:../upload.php?img=" . $filename);
} else {
    // 如果沒有上傳檔案，重新導向到上傳頁面並傳遞錯誤訊息
    header ("location:../upload.php?err = 上傳失敗");
}

?>