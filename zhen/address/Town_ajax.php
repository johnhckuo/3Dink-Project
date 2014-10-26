<?php
include 'Include/open.php';
$Town = "select * from Town where CNo='" . $_POST["CNo"] . "'";
$Town_rs = mysql_query($Town);
$Town_num = mysql_num_rows($Town_rs);
if ($Town_num > 0) {//縣市編號帶入後如果有資料存在顯示底下區域內容回傳
    echo "<option value=''>選擇鄉鎮</option>";
    while ($Town_rows = mysql_fetch_array($Town_rs)) {
        echo "<option value='" . $Town_rows["AutoNo"] . "'>" . $Town_rows["Name"] . "</option>";
    }
} else {//縣市編號帶入後如果有資料存在顯示底下內容回傳
    echo "<option value=''>選擇鄉鎮</option>";
}
?>
