<?php
session_start();
$uploaddir="upload";  
require_once("../db/dblogin.php");
require_once("../db/dbconnect.php");
$memberNo=$_SESSION["No"];
//echo "<script>alert('請上傳正確附檔名');</script>";
if (isset($_POST["name"]) && isset($_POST["introduction"] )){
	$arr=array();
	$file=array();
	$flag=array(0,0,0);
	$arr[0] = $_POST["name"];
	$arr[1] = $_POST["category"];
	$arr[2] = $_POST["folder"];
	$arr[3] = $_POST["introduction"];
	//圖片授權
	$arr[4]=$_POST["authorization"];
	$arr[5]=$_POST["auzPrice"];
	//創建資料夾
	//$arr[6]=$_POST["create"]; 
	$arr[6]=$_POST["folderName"];
	
/*	
	for ($key=0 ; $key<2 ; $key++){   // change to 3 when physical is added
	
		if (!empty($_FILES["normData"]["name"][$key])){
			
			$file[$key] = $uploaddir."/".$_FILES["normData"]["name"][$key];
			//$flag[$key]=1;
		}else{
			$file[$key] = $uploaddir."/".$_POST['dragData'][$key];
			
		}
		
		if ($flag[$key]){
				$tmp_name = $_FILES["normData"]["tmp_name"][$key];
				move_uploaded_file($tmp_name, $file[$key]);
		}
}*/
	//$imagename=$_POST['dragData'][0];
	$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $_FILES['normData2D']['name']);//正規化附檔名
	$ext = strtolower ($ext);
	//echo "<script>alert('".$ext."');</script>";
	if($ext!="jpg" && $ext!="png" && $ext!="jpeg"){
		echo "<script>";
		echo "alert('請上傳正確附檔名');";
		echo "document.location.href='file_upload.php';</script>";
		exit;
	}
	else{
		$file[0] = $uploaddir."/".$_POST['dragData'][0];
		$file[1]=$uploaddir."/".$_FILES['normData2D']['name'];
		move_uploaded_file($_FILES["normData2D"]["tmp_name"], $file[1]);
		
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		
		$imageSize=$_POST["dragSize"];
		$imageSize=(int)$imageSize;

		if($_POST["create"]==1){	//是否創資料夾
			$addsql="INSERT INTO personal_folder(`folderName`) VALUE ('$arr[6]')";
			$result = $db->query($link,$addsql);	
			$search= "SELECT folderNo FROM personal_folder WHERE folderName='$arr[6]' ORDER BY folderNo DESC LIMIT 1";
			$result2 = $db->query($link,$search);	
			$row= mysqli_fetch_row($result2);
			//作者是否授權
			if($arr[4]==1){
				$sql= "INSERT INTO platform(  `pictureNo` , `pictureName` ,  `3dimageLink` , `3dimageSize(kb)`,`2dimageLink`  ,  `productInfo` ,  `Score` ,  ` Hitrate`  , `authorizePrice` ,`memberNo` , `categoryNo`, `personalFolderNo`)  VALUES ('','$arr[0]',  '$file[0]', '$imageSize', '$file[1]',  '$arr[3]',  '0',  '0' ,'$arr[5]', '$memberNo' , '$arr[1]','$row[0]')";// modify when physical is added  //
				$result = $db->query($link,$sql);
			}
			else if($arr[4]==0){
				$sql= "INSERT INTO platform(  `pictureNo` , `pictureName` ,  `3dimageLink` , `3dimageSize(kb)`,`2dimageLink`  ,  `productInfo` ,  `Score` ,  ` Hitrate`  ,`memberNo` , `categoryNo`, `personalFolderNo`)  VALUES ('','$arr[0]',  '$file[0]', '$imageSize', '$file[1]',  '$arr[3]',  '0',  '0' , '$memberNo' , '$arr[1]','$row[0]')";// modify when physical is added
				$result = $db->query($link,$sql);
				
			}		
		}
		else if($_POST["create"]==0){
			//作者是否授權
			if($arr[4]==1){
				$sql= "INSERT INTO platform(  `pictureNo` , `pictureName` ,  `3dimageLink` , `3dimageSize(kb)`,`2dimageLink`  ,  `productInfo` ,  `Score` ,  ` Hitrate`  , `authorizePrice` ,`memberNo` , `categoryNo`, `personalFolderNo`)  VALUES ('','$arr[0]',  '$file[0]', '$imageSize', '$file[1]',  '$arr[3]',  '0',  '0' ,'$arr[5]', '$memberNo' , '$arr[1]','$arr[2]')";// modify when physical is added  //
				$result = $db->query($link,$sql);
			}
			else if($arr[4]==0){
				$sql= "INSERT INTO platform(  `pictureNo` , `pictureName` ,  `3dimageLink` , `3dimageSize(kb)`,`2dimageLink`  ,  `productInfo` ,  `Score` ,  ` Hitrate`  ,`memberNo` , `categoryNo`, `personalFolderNo`)  VALUES ('','$arr[0]',  '$file[0]', '$imageSize', '$file[1]',  '$arr[3]',  '0',  '0' , '$memberNo' , '$arr[1]','$arr[2]')";// modify when physical is added
				$result = $db->query($link,$sql);
			}		
		}
	}
	

}
else{
//	foreach ($_FILES["ff"]["error"] as $key => $error) {
//		if ($error == UPLOAD_ERR_OK) {
	/*
			if (!empty($_FILES["ff"]["tmp_name"][0])){
				$tmp_name = $_FILES["ff"]["tmp_name"][0];
				$name = $_FILES["ff"]["name"][0];
				echo $_FILES["ff"]["name"][0];
				@move_uploaded_file($tmp_name, "$uploaddir/$name");
			}else if (!empty($_FILES["ff"]["tmp_name"][1])){
				$tmp_name = $_FILES["ff"]["tmp_name"][1];
				$name = $_FILES["ff"]["name"][1];
				@move_uploaded_file($tmp_name, "$uploaddir/$name");
			}*/
			$tmp_name = $_FILES["ff"]["tmp_name"][0];
			$name = $_FILES["ff"]["name"][0];
			@move_uploaded_file($tmp_name, "$uploaddir/$name");
	
	}


header("Location:index.php");

?>


