<?php
session_start();
if( !isset($_POST['Password']) || !isset($_POST['Email']) || !isset($_POST['Nickname']))
{
	echo "<script language='javascript'>";
	echo "alert('尚未登入，請重新登入');";	
	echo "window.location.assign('../index.php');";
	echo "</script>";
	exit;
	//header('../index.php');
	//exit;
}
sleep(2);
require_once("../db/dblogin.php");
require_once("../db/dbconnect.php");
$Password = $_POST['Password'];
$Password2 = $_POST['Password2'];
$Email = $_POST['Email'];
$Nickname = $_POST['Nickname'];
$memberNo = $_SESSION['No'];
//$Account = $_SESSION['Account'];
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$sql = "UPDATE member SET Password='$Password', Email='$Email', Nickname='$Nickname' WHERE memberNo='$memberNo'";
//$sql = "UPDATE member SET Password='$Password', Email='$Email', Nickname='$Nickname' WHERE Account='$Account'";
$result = $db->query($link,$sql);        
if($result){	
	echo 'success';
}
else{
	echo 'no data';
}	
/*
if($Nickname!=null &&$Password != null && $Password2 != null && $Password == $Password2)
{
    $Account = $_SESSION['Account'];
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$sql = "UPDATE member SET Password='$Password', Email='$Email', Nickname='$Nickname' WHERE Account='$Account'";
	$result = $db->query($link,$sql);        
    if($result)
		{
            echo '修改成功!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=manage.php>';
        }   
	else
        {
            echo '修改失敗!請重新填寫';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=member_edit.php>';
        }
}
if($Nickname == null || $Password == $Password2 || $Password == null)
{
        echo '不可以留白，請重新填寫';
       echo '<meta http-equiv=REFRESH CONTENT=2;url=member_edit.php>';
}
*/
?>