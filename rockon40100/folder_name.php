
<?php 
	@$Account=$_SESSION['Account'];
	@$facebookID=$_SESSION['id'];
	
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$memberNo=$_GET['memberNo'];//作者編號
	$sql2="SELECT distinct personalfolderNo FROM platform WHERE memberNo = ".$memberNo." order by personalfolderNo";
	$result2 = $db->query($link,$sql2);//folderNo
	//$row2 = mysqli_fetch_row($result2);
	if($result2){
		while($row2=mysqli_fetch_row($result2)){
				$sql3="SELECT  folderName FROM personal_folder WHERE folderNo = ".$row2['0']." ";
				$result3 = $db->query($link,$sql3);//分類(資料夾)名稱
				@$row3 = mysqli_fetch_row($result3);
				echo "<div  class='folder_namediv' >";
				echo "<a href='/rockon40100/personal_folder.php?folderNo=".$row2['0']."&memberNo=".$memberNo."&folderName=".$row3['0']."' id=".$row2['0']." >".$row3[0]."</a>";
				echo "</div>";
		}
	}
	
?>
