<?php
session_start();
/* -------------------------- */
/* Check username & password  */
/* -------------------------- */
if( !isset($_POST['user_name']) || !isset($_POST['user_password']))
	{
		echo "<script language='javascript'>";
		echo "alert('請重新登入');";	
		echo "window.location.assign('login.php');";
		echo "</script>";
		exit;
		//header('../index.php');
		//exit;
	}
require("/var/www/db/dblogin.php");
require("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);

sleep(2); 
$userid = isset($_POST["user_name"]) ? $_POST["user_name"] : $_GET["user_name"]; 
$password = isset($_POST["user_password"]) ? $_POST["user_password"] : $_GET["user_password"]; 

//$userid=$_REQUEST['user_name'];
//$password =$_REQUEST['user_password'];



//$userid='123';
//$password ='123';

$sql = "SELECT Account,Password,memberNo FROM member WHERE Account = '$userid' and Password='$password'";
$result=$db->query($link,$sql);
$row = mysqli_fetch_row($result);	
$record_count = mysqli_num_rows($result); 
if($record_count<1){
//無資料回傳no data
	echo 'no data';
}
else{
//若有這筆資料則回傳success
	$_SESSION['Account'] = $row[0];
	$_SESSION['No']=$row[2];
	echo 'success';
	//header('../index.php');
	//exit;
	//echo $row[0];   // for debug use
} 
?>
