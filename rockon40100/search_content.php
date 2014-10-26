<html lang="zh-tw">
<!DOCTYPE html>
<meta charset="utf-8" />
<?php 
	@$Account=$_SESSION['Account'];
	@$facebookID=$_SESSION['id'];
	require_once("/var/www/db/dblogin.php");
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	$searchitem=$_GET['item'];
	$sql = "SELECT Account,pPath,Nickname,memberNo FROM member WHERE Nickname LIKE '%$searchitem%'  or Account LIKE '%$searchitem%' ";
	$result = $db->query($link,$sql);//搜尋人
	$sql2 = "SELECT categoryNo FROM image_category WHERE imageCategory LIKE '%$searchitem%'";
	$result2 = $db->query($link,$sql2);//搜尋圖分類
	$row2 = mysqli_fetch_assoc($result2);
	$sql3 = "SELECT pictureNo,pictureName,2dimageLink,categoryNo FROM platform WHERE pictureName LIKE '%$searchitem%' or categoryNo LIKE '$row2[categoryNo]'";
	$result3 = $db->query($link,$sql3);//搜尋圖
	$row3 = mysqli_fetch_assoc($result3);
	$a = 0;
	$b = 0;
	echo "<span class='search_title'>搜尋結果</span>";

	if($result && $searchitem!=''){
		echo "<div class='search_div'>";
		while($row = mysqli_fetch_assoc($result)){	
			echo "<div class='search_member'>";
			echo "<a href='personal.php?memberNo=".$row[memberNo]."'><img src='".$row['pPath']."' ></a>";
			echo "<a href='personal.php?memberNo=".$row[memberNo]."'><div class='search_name'>".$row['Nickname']."</div></a>";
			echo "</div>";
			$a++;
		}
		if($a != 0){	
			echo "<div class='search_result'>有 ".$a." 位會員符合</div>";
		}
		echo "</div>"; 
	}
	if($result3 && $searchitem!=''){
		echo "<div class='search_div'>";
		while($row3 = mysqli_fetch_assoc($result3)){
			echo "<div class='search_img'>";
			echo "<a href='../showMode/index.php?pictureNo=".$row3[pictureNo]."&categoryNo=".$row3[categoryNo]."&searche=-1'><img src='../showMode/".$row3['2dimageLink']."' ></a>";
			echo "<a href='../showMode/index.php?pictureNo=".$row3[pictureNo]."&categoryNo=".$row3[categoryNo]."'><div class='search_name'>".$row3['pictureName']."</div></a>";
			echo "</div>";
			$b++;			
		}
		if($b != 0){	

			echo "<div class='search_result'>有 ".$b." 項作品符合</div>";
		}

		echo "</div>"; 
	}
	if($a==0 && $b==0 || $searchitem==''){
		echo "<div class='search_result'>有 ".$a." 個項目符合</div>";
		
	}
	
	

	
	
?>
	<script type='text/javascript'>
		function result(){
			location.href='personal.php';
		}
	</script>
</html>