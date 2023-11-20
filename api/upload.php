<?php

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