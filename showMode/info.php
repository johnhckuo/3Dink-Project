<?php
//$Account=$_SESSION['Account'];
//$data = array(); 


require_once("/var/www/db/dblogin.php");
require_once("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
if(isset($_GET['pictureNo']) && isset($_GET['folderNo']) && $_GET['categoryNo']==-1){ //從個人頁面連結
	$pictureNo=$_GET['pictureNo'];
	$folderNo=$_GET['folderNo'];
	$sql=" SELECT pictureNo, pictureName,3dimageLink,2dimageLink,productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE pictureNo = $pictureNo UNION (SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE personalFolderNo='$folderNo' AND pictureNo != $pictureNo ORDER BY RAND() LIMIT 9) ";	
}
else if(isset($_GET['pictureNo']) && $_GET['categoryNo']!=0 && $_GET['folderNo']==-1){ //從展覽頁面連結
	$pictureNo=$_GET['pictureNo'];
	$categoryNo=$_GET['categoryNo'];
	$sql="SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE pictureNo = $pictureNo UNION (SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE categoryNo='$categoryNo' AND pictureNo != $pictureNo ORDER BY RAND() LIMIT 9)";
	
	
}

else if(isset($_GET['pictureNo']) && $_GET['categoryNo']!=0 && $_GET['folderNo']==-3){ //從搜尋頁面連結
	$pictureNo=$_GET['pictureNo'];
	$categoryNo=$_GET['categoryNo'];
	$sql="SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE pictureNo = $pictureNo UNION (SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE categoryNo='$categoryNo' AND pictureNo != $pictureNo ORDER BY RAND() LIMIT 9)";
	
	
}

else if($_GET['folderNo']==-1 && $_GET['categoryNo']==0 ){ //從展覽頁面連結(熱門)
	$pictureNo=$_GET['pictureNo'];
	$categoryNo=$_GET['categoryNo'];
	$sql="SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE pictureNo = $pictureNo UNION (SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform WHERE pictureNo != $pictureNo AND Score ORDER by Score/rateNumber DESC LIMIT 9)";
	
}
else{ //一進到展覽模式
	$sql="SELECT pictureNo, pictureName, 3dimageLink,2dimageLink, productInfo,Score,rateNumber,memberNo,authorizePrice FROM platform ORDER BY pictureNo DESC LIMIT 10";	
}
$keys = array();
$keys2 = array();
$result = $db->query($link,$sql);
while ($row = mysqli_fetch_row($result) )
{
	$keys[]= $row;
	$sql2="SELECT Nickname FROM member WHERE memberNo ='$row[7]'";
	$result2= $db->query($link,$sql2);//Nickname
	while ($row2 = mysqli_fetch_row($result2)){
		$keys2[]=$row2;
		
	}	
	
	
}	

//變換位置圖片位置使得第一張出現所點擊圖片
for($i=0;$i<4;$i++){
		for($j=1;$j<4;$j++){
			if($i<$j){
				$temp=$keys[$j];
				$keys[$j]=$keys[$i];
				$keys[$i]=$temp;
				$temp2=$keys2[$j];
				$keys2[$j]=$keys2[$i];
				$keys2[$i]=$temp2;
			}
		}
}


	

for($i=0;$i<10;$i++){
	echo $keys[$i][0].'+'.$keys[$i][1].'+'.$keys[$i][2].'+'.$keys[$i][3].'+'.$keys[$i][4].'+'.$keys[$i][5].'+'.$keys[$i][6].'+'.$keys[$i][7].'+'.$keys2[$i][0].'+'.$keys[$i][8]."+";
}




//$image3D = $row[$i]['3dimageLink'];
//$image2D = $row[$i]['2dimageLink'];
//$imagePhysical = $row[$i]['physicalImage'];

/*echo "<figure id=\"figure0\" >
		<img src=\"".$image2D."\"  width=\"180\" height=\"240\" alt=\"\">
		<span id=\"imageInfo0\" ></span>
	</figure>";*/


?>