<?php	//ini_set('display_errors', 'On');	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	if($_GET['category']!=0){		$category=$_GET['category'];//目錄編號		$sql = "SELECT 2dimageLink, pictureName, productInfo, pictureNo FROM platform WHERE categoryNo = ".$category." ";
		$result = $db->query($link,$sql);//圖	}	else if($_GET['category']== ''){		$category=0;		$sql = "SELECT 2dimageLink, pictureName, productInfo, pictureNo FROM platform WHERE Score ORDER by Score/rateNumber DESC ";		$result = $db->query($link,$sql);//圖		echo $category;	}	else if($_GET['category']==0){		$category=$_GET['category'];		$sql = "SELECT 2dimageLink, pictureName, productInfo, pictureNo FROM platform WHERE Score ORDER by Score/rateNumber DESC ";		$result = $db->query($link,$sql);//圖	}	$length = mysqli_num_rows($result);	//$length = mysqli_num_rows($result);	echo $length;
	$figureID = 0;
	for($i=0; $i<$length; $i++){
		$row = mysqli_fetch_row($result);	/*	if ($i == 0){
			echo "<figure id=".$figureID.">";
			$figureID++;
		}	
		else if ($i%3 == 0){
			echo "</figure><figure id=".$figureID.">";			$figureID++;
		}
		else if ($i == $length){
			echo "</figure>";
		}
		echo "<div><a href='../showMode/index.php?categoryNo=".$category."&pictureNo=".$row['3']."'>";		echo "<span>".$row['1']."<p>說明：".$row['2']."</p></span>";
		echo "<img src='../showMode/".$row['0']."' />";
		echo "</a></div>";  */      		if ($i%3 == 0){				$figureID++;		}		echo $figureID.'+'.$category.'+'.$row[3].'+'.$row[1].'+'.$row[2].'+'.$row[0].'+';
	}
	?>