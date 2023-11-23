<?php

include_once "../db.php";

$id=$_GET['id'];

$file=find ('files',$id)['name']; // 輸出檔名

del('files',$id);

unlink('../imgs/'.$file);

header("location:../manage.php");

?>