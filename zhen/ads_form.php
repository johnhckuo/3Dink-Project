<?php
	session_start();
	if( !isset($_SESSION['No']) )
	{
		echo "<script language='javascript'>";
		echo "alert('尚未登入，請重新登入');";	
		echo "window.location.assign('../index.php');";
		echo "</script>";
		exit;
		//header('../index.php');
		//exit;
	}
	require("../db/dblogin.php");
	require("../db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$memberNo=$_SESSION['No'];
	
	
	
	//$tmp_name = $_FILES["pic"]["tmp_name"];
	//$name=$_FILES["pic"]["name"];
	$uploads_dir = "ads_picture";
	//$upload_file=$uploads_dir."/".$name;
	//move_uploaded_file($tmp_name,$upload_file);
	
	//$sql="SELECT * FROM member WHERE memberNo=$memberNo";
	//$result = $db->query($link,$sql);
	
	if(isset($_POST['weeks'])&&isset($_POST['adsUrl']))
	{
		$weeks=$_POST['weeks'];
		$days=$weeks*7;
		$adsUrl=$_POST['adsUrl'];
		$memberNo=$_SESSION['No'];		
				if (!empty($_FILES["pic"]["name"]))
				{
					$upload_file = $uploads_dir."/".$_FILES["pic"]["name"];
					$flag=1;
				}
				else
				{
					$upload_file  = $uploads_dir."/".$_POST['dragData'];
				
				}
				if ($flag)
				{
						$tmp_name = $_FILES["pic"]["tmp_name"];
						move_uploaded_file($tmp_name,$upload_file);
				}
			$addsql="INSERT INTO ads_purchase (buyerNo,adsSize,adsLink,pictureLink,expirationDate) values ('$memberNo','100', '$adsUrl','$upload_file','$days')";
			$result = $db->query($link,$addsql);
			if($result)
			{
				//$searchsql="SELECT * FROM ads_purchase WHERE buyerNo='$memberNo'";
				$searchsql = "SELECT *\n"
									. "FROM ads_purchase \n"
									. "WHERE buyerNo =6\n"
									. "ORDER BY purchaseNo DESC\n"
									. "LIMIT 1";
				$result2=$db->query($link,$searchsql);
				$adsinfo=mysqli_fetch_assoc($result2);
				$adsprice=$adsinfo['expirationDate']/7*500;
				$addsql2="INSERT INTO income (adsPurchase,ads_purchaseNo) values('$adsprice',$adsinfo[purchaseNo])";
				$result2=$db->query($link,$addsql2);
				if($result2)
				{
					echo "<script language='javascript'>";
					echo "alert('新增成功 付款後方可刊登廣告');";
					echo "window.location.assign('../index.php');";
					echo "</script>";
				}
			}
			
	}
	else
	{
		//$uploads_dir = 'ads_picture';//存放上傳檔案資料夾  $key是上傳一個檔案以上		
		foreach ($_FILES["ff"]["error"] as $key => $error) 
		{
			if ($error == UPLOAD_ERR_OK)
			{
				$tmp_name = $_FILES["ff"]["tmp_name"][$key];
				$name = $_FILES["ff"]["name"][$key];
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}
		}
		/*
		$error=$_FILES["ff"]["error"]  ;
		echo $error;
		if ($error == UPLOAD_ERR_OK) 
		{
				$uploads_dir = 'ads_picture';
				$tmp_name = $_FILES["ff"]["tmp_name"];
				$name = $_FILES["ff"]["name"];
				move_uploaded_file($tmp_name,"$uploads_dir/$name");
				echo $name."------".$tmp_name;
		}*/
	}
//header('Location:../index.php');	
	
	
	 
	/*
	if(move_uploaded_file($_FILES['pic']['tmp_name'],iconv("UTF-8", "big5", $target_path ))) {
		echo "檔案：". $_FILES['pic']['name'] . " 上傳成功!";
	} else{
	echo "檔案上傳失敗，請再試一次!";
	}*/
	
	
	
?>
