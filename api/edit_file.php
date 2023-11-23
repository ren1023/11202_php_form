<?php
include_once "../db.php";
if (isset($_POST['id'])) {
    // 先把檔案拿到
    $file = find('files', $_POST['id']);
} else {
    exit();
}
if (!empty($_FILES['img']['tmp_name'])) {
    if ($_POST['name'] !== $file['name']) {
        $file ['name'] = $_POST ['name']; // 表單收到的資料，再存到資料表中
    }
    move_uploaded_file($_FILES['img']['tmp_name'], "../imgs/" . $_POST['name']);
    switch ($_FILES['img']['type']) {
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            $type = "msword";
            break;
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            $type = 'msexcel';
            break;
        case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            $type = 'msppt';
            break;
        case "application/pdf":
            $type = 'pdf';
            break;
        case "image/webp":
        case "image/jpeg":
        case "image/png":
        case "image/gif":
        case "image/bmp":
            $type = $_FILES['img']['type'];
            break;
        default:
            $type = 'other';
    }
    if ($type != $file ['type']) { // 判斷檔案類型是否相同，若不相同則處理副檔名
        $file['type'] = $type;
        $tmp = explode (".", $_FILES ['img']['name']); // 拆開原檔名
        $subname = end ($tmp); // 將副檔名存起來
        $tmp = explode (".", $file ['name']); // 檔名
        $tmp [count ($tmp) - 1] = $subname; // 副檔名
        $file ['name'] = join (".", $tmp); // 完整的檔案名稱
    }
    $file['type'] = $type;
    $file['size'] = $_FILES['img']['size'];
} else {
    // 如果在新增檔案時→送出→沒有選檔案時，會發生什麼問題？更改檔案名稱和敘述 
    if ($_POST ['name'] !== $file ['name']) { // 如果表單內的檔名與資料表的不同，就 rename
        rename ('../imgs/' . $file ['name'], '../imgs/' . $_POST ['name']); // 先改檔案名稱
        $file ['name'] = $_POST ['name']; // 再改資料表裡的檔案名稱
    }
}
// 描述欄位，確認表單收到的資料與資料表內的資料是否相同，若不相同則不用更新
if ($_POST['desc'] !== $file['desc']) {
    $file['desc'] = $_POST['desc'];
}
// 沒上傳檔案時，檔名是否有要改，
// 有上傳檔案時，才確認 檔名是否相同，是否更名。
update('files', $_POST['id'], $file);
//header("location:../upload.php?img=".$filename);
header("location:../manage.php");
//header ("location:../edit_file.php?err = 上傳失敗");
