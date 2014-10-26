
<?php
	if(!isset($_POST['Account']) || !isset( $_POST['Password']) || !isset($_POST['Nickname']) || !isset($_POST['Email']))
	{
		echo "<script language='javascript'>";
		echo "alert('請重新註冊一次');";	
		echo "window.location.assign('register.php');";
		echo "</script>";
		//header('register.php');
		exit;
	}
    require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	//$sql="SELECT * FROM member where Account = '$Account' ";
	//$result = $db->query($link,$sql);
	
	sleep(3);
	$Account = $_POST['Account'];
	$Password = $_POST['Password'];
	//$Password2 = $_POST['Password2'];
	$Nickname = $_POST['Nickname'];
	$Email = $_POST['Email'];




	$sql = "INSERT INTO member (Account,Password,Email,pPath,Nickname) values ('$Account','$Password', '$Email','/img/default.png','$Nickname')";
	$result = $db->query($link,$sql);
	
	$sql2="SELECT Account FROM member WHERE Account='$Account'";
	$result2 = $db->query($link,$sql2);
	$record_count = mysqli_num_rows($result2); 
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
/*
$sql = "INSERT INTO member (Account,Password,Email,pPath,Nickname) values ('$Account','$Password', '$Email','/img/default.png','$Nickname')";
	$result = $db->query($link,$sql);	
	if($result)
        {
			echo '新增成功';
			header("Location:login.php" );
        }
	else
        {
			echo '新增失敗，請重新填寫';
			header("Location:register.html" );
        }
}
else
{
	echo '欄位不可空白，請重新填寫';
	header("Location:register.html" );
}*/
?>



