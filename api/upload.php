<?php

include_once "../db.php";
echo "files";

echo $_POST['desc'];

if(!empty($_FILES['img']['tmp_name'])){
    echo $_FILES['img']['tmp_name'];
    echo "<br>";
    echo $_FILES['img']['name'];
    echo "<br>";
    echo $_FILES['img']['type'];
    echo "<br>";
    echo $_FILES['img']['size'];
    $subname=".".[end (explode (".",$_FILES ['img']['name']))];// 取陣列的最後一個值
    $filename=date("YmdHis").rand(10000,99999).$subname;
    move_uploaded_file($_FILES['img']['tmp_name'],"../imgs/".$filename);

    
    
    // header("location:../upload.php?img=.$filename");
    header("location:../manage.php");
    
}else{

    header ("locatoin:../uploade.php?err = 上傳失敗");
    
}
?>