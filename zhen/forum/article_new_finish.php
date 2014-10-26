<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<?php ?>
</head>
<body>
<?php
    require_once("../login_success.php")
	require_once("../../db/dblogin.php");
	require_once("../../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	if(isset($_SESSION['Account']))
	{
		$Typeid=$_POST['Typeid'];
		$Subject=$_POST['Subject'];
		$Content=$_POST['Content'];
		
		$sql1="SELECT * FROM member where Account = '$Account' ";
		$result = $db->query($link,$sql1);
		$row = mysqli_fetch_row($result);
		
		$sql2 = "INSERT INTO forum_content (Subject,Content,articlecategoryNo,memberNo) values ('$Subject','$Content', '$Typeid','$row[0]')";
		$result2 = $db->query($link,$sql2);	
		
		if($result2)
        {
			echo '新增成功';
			header("Location:3Dprint.php" );
        }
		else
        {
			echo '新增失敗，請重新填寫';
			header("Location:article_new.php" );
        }
	}
	else
	{
		echo "你沒有權限新增";
	}
?>
</body>
</html>


