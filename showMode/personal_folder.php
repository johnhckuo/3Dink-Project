<?php
session_start();
if(isset($_SESSION['No'])){
	//require("/var/www/db/dblogin.php");
	//require("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$sql = "SELECT DISTINCT personal_folder.folderNo, personal_folder.folderName FROM platform,personal_folder WHERE platform.personalFolderNo =personal_folder.folderNo AND platform.memberNo='$memberNo'";
	$result = $db->query($link,$sql);
	//$count=1;
	$num_row=mysqli_num_rows($result);
	if($num_row<1)
	{
		echo "<option value=0>請先建立資料夾</option>";
	}

	while($row = mysqli_fetch_row($result))
	{
		echo "<option value=".$row[0].">".$row[1]."</option>";
	}
}	

?>