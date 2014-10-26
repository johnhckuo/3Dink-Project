<?php
	@$Account=$_SESSION['Account'];
	@$facebookID=$_SESSION['id'];
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$memberNo=$_GET['memberNo'];//作者編號
	$sql2="SELECT distinct personalFolderNo  FROM platform WHERE memberNo = ".$memberNo." order by personalFolderNo ";
	$sql3="SELECT Nickname FROM member WHERE memberNo = ".$memberNo." ";
	$result2 = $db->query($link,$sql2);//資料夾
	$result3 = $db->query($link,$sql3);//作者名稱
	@$row3 = mysqli_fetch_row($result3);
	$checkpic = mysqli_num_rows($result2);
	//有照片
	if($checkpic>0){
		while($row2 = mysqli_fetch_row($result2)){
				$sql4="SELECT folderName FROM personal_folder WHERE folderNo = ".$row2['0']." ";
				$result4 = $db->query($link,$sql4);//資料夾名稱
				@$row4 = mysqli_fetch_row($result4);
				$sql5="SELECT 2dimageLink FROM platform WHERE personalFolderNo = ".$row2['0']." ";
				$result5 = $db->query($link,$sql5);//圖片路徑
				@$row5 = mysqli_fetch_row($result5);
				$sql6="SELECT COUNT(personalfolderNo) FROM platform where personalfolderNo= ".$row2['0']." AND memberNo=".$memberNo." ";
				$result6 = $db->query($link,$sql6);//圖片數量
				$row6 = mysqli_fetch_row($result6);
				//echo $row6['0'];
				echo "<div class='personal_folderImg' onclick='CollapseExpand(this)'>";
				echo "<a href='/rockon40100/personal_folder.php?folderNo=".$row2['0']."&memberNo=".$memberNo."&folderName=".$row4['0']."'><img src='../showMode/".@$row5['0']."' ></a>";
				echo "<div class='personal_folderName' onclick='CollapseExpand(this)'>";
				echo $row4['0'];
				echo "</div>";
				echo "<div class='personal_folderNo'>";
				echo " 共";
				echo $row6['0'];
				echo "張相片";
				echo "</div>";
				echo "</div>";
		}


	}
	
	//沒有照片
	else{
		echo "<div style='padding:10 10 10 10;color:#999999;font-size:18px;font-family:Microsoft JhengHei;'>";
		echo "".$row3['0']."沒有上傳任何圖片...";
		echo "</div>";
	}
	
?>
