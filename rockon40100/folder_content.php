<?php 
	//ini_set('display_errors', 'On');
	@$Account=$_SESSION['Account'];
	@$facebookID=$_SESSION['id'];
	$folderNo=$_GET['folderNo'];
	$memberNo=$_GET['memberNo'];//作者編號
	$folderName=$_GET['folderName'];
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$i=0;
	
	if($_POST['limit_value']){
		$i = $_POST['limit_value'];	
	}
	
	$sql2="SELECT 2dimageLink,pictureNo FROM platform WHERE personalfolderNo = ".$folderNo." and memberNo = ".$memberNo." limit ".$i.",12";
	$result2 = $db->query($link,$sql2);//圖片連結,圖片編號

	//印出
	$a = 100;//因為從1開始會重複ID，所以從100開始
	
	echo "<span class='folder_title'>".$folderName."</span>";
	while($row2 = mysqli_fetch_row($result2)){
		$sql3="SELECT pictureName FROM platform WHERE 2dimageLink = '".$row2['0']."'";
		$result3 = $db->query($link,$sql3);//圖片名稱
		$row3 = mysqli_fetch_row($result3);
		$a++;
		echo "<div onclick='CollapseExpand(".$a.")'>";
		echo "<a href='../showMode/index.php?pictureNo=".$row2[1]."&folderNo=".$folderNo."'><img src='../showMode/".$row2[0]."' ></a>";
		echo "<div class='pictureName'>".$row3[0]."</div>";
		
		/*彈出視窗 
		echo "<div id=".$a." class='picinfo_hidden' >";
		echo "<div class='infopic'><img src='../showMode/".$row2[0]."' ></div>";
		echo "<div class='info'>";
		echo "名稱：".$row3[0]."<br><br>";
		echo "簡介：我是葉子我很黑我愛許瑋晉我是葉子我很黑我愛許瑋晉我是葉子我很黑我愛許瑋晉我是葉子我很黑我愛許瑋晉我是葉子我很黑我愛許瑋晉<br><br>";
		echo "授權：否<br><br>";
		echo "</div>";
		echo"</div>";*/
		echo "</div>";

	}
	$sql4="SELECT 2dimageLink FROM platform WHERE personalfolderNo = ".$folderNo." and memberNo = ".$memberNo." ";
	$result4 = $db->query($link,$sql4);//
	$length = mysqli_num_rows($result4);
	echo "<table class='pagenum'><tr>";
		for($j=1;$j<=($length/12)+1; $j++){	
			echo "<td onclick='change_page(".($j-1).")'>";
			echo $j;
			echo "</td>";
		}
	echo "</tr></table>";
	
?>
