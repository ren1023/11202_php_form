<?php include "db_export.php";
// if(!empty($_POST)){
//     echo "你希望匯出";
//     print_r($_POST['select']);
//     echo "這些資料";
// }

if(!empty($_POST)){
    $rows=all('animal'," where `統一編號` in ('".join("','",$_POST['select'])."') ");
    // print_r($rows);

    $filename=date("Ymd").rand(100000000,999999999);
    $file=fopen("./doc/{$filename}.csv","w+");
    fwrite($file,"\xEF\xBB\xBF");
    $chk=false;
    foreach($rows as $row){
        if(!$chk){
            $cols=array_keys($row);
            fwrite($file,join(",",$row)."\r\n");
            $chk=true;
        }
    }
    fclose(($file));

echo "<a href='./doc/{$filename}.csv' downded>檔案已匯出，請點此連結下載</a>";
}

 ?>
     <style>
        table{
            margin: auto;
            border-collapse: collapse;
        }
        td{
            border: 1px solid #666;
            padding: 5px 12px;
        }
        th{
            border: 1px solid #666;
            padding: 5px 12px;
            background-color: black;
            color: white;
        }
    </style>
    <form action="?" method="post">
        <input type="submit" value="匯出">
 <table>
    <tr>
        <th>是否匯出</th>
        <th>統一編號</th>
        <th>商業名稱</th>
        <th>商業地址</th>
        <th>登記狀態</th>
    </tr>
<?php
$rows=all('animal');
// print_r($rows);
foreach($rows as $row){
    echo "<tr>";
    echo "<td>";
    echo "<input type='checkbox' name='select[]' value='{$row['統一編號']}'>";
    echo "</td>";
    foreach($row as $value){
        echo "<td>";
        echo $value;
        echo "</td>";
    }
    echo "</tr>";
}
?>
 </table>
 </form>
