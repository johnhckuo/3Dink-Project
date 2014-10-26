<?php
include("Include/open.php");
$Zip = "select * from Town where AutoNo='" . $_POST["TNo"] . "'";
$Zip_rs = mysql_query($Zip);
$Zip_num = mysql_num_rows($Zip_rs);
if ($Zip_num > 0) {//區域(鄉鎮)編號帶入後如果有資料存在顯示底下郵遞區號內容後回傳
    $Town_rows = mysql_fetch_array($Zip_rs);
    echo $Town_rows["Post"];
} else {
    echo "無資料";
}
?>
