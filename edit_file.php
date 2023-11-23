<?php
include_once "db.php";
if (isset ($_GET ['id'])) { // 若檔案什麼都沒有時，什麼事都不執行
    // 讀取檔案
    $file = find('files', $_GET['id']);
} else {
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> 編輯檔案 </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1 class="header"> 編輯檔案 </h1>
    
    <!---- 建立你的表單及設定編碼 ----->
    <?php
    if (isset($_GET['err'])) {
        echo $_GET['err'];
    }
    ?>
    <!-- 當有取得 id 時，則要顯示資料在我的欄位中 -->
    <div class="text-center">
        <a href="manage.php"> 回列表 </a>
    </div>
    <form action="./api/edit_file.php" method="post" enctype="multipart/form-data">
        <div class="col-6 mx-auto">
            <table class="table">
                <tr>
                    <td> 媒體 </td>
                    <td>
                        <?php
                        switch ($file['type']) {
                            case "image/webp":
                            case "image/jpeg":
                            case "image/png":
                            case "image/gif":
                            case "image/bmp":
                                $imgname = "./imgs/" . $file['name'];
                                break;
                            case 'msword':
                                $imgname = "./icon/wordicon.png";
                                break;
                            case 'msexcel':
                                $imgname = "./icon/msexcel.png";
                                break;
                            case 'msppt':
                                $imgname = "./icon/msppt.png";
                                break;
                            case 'pdf':
                                $imgname = "./icon/pdf.png";
                                break;
                            default:
                                $imgname = "./icon/other.png";
                        }
                        ?>
                        <img src="<?= $imgname; ?>" style="width:300px;height:200px;" >
                        <input type="file" name="img" >
                    </td>
                </tr>
                <tr>
                    <td> 檔名 </td>
                    <td><input type="text" name="name" value="<?= $file['name']; ?>"></td>
                </tr>
                <tr>
                    <td> 說明 </td>
                    <td><textarea name="desc" id="" style="width:300px;height:200px;"><?= $file['desc']; ?></textarea></td>
                </tr>
            </table>
            <div class="text-center m-3">
            <input type="hidden" name="id" value="<?=$file['id'];?>">
            <input type="submit" value="更新">
            </div>
        </div>
    </form>
    <!---- 建立一個連結來查看上傳後的圖檔 ---->
    <?php
    if (isset($_GET['img'])) {
        echo "<img src='./imgs/{$_GET['img']}' style='width:250px;height:150px'>";
    }
    ?>
</body>
</html>