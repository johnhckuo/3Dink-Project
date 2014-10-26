<?php
$i = 0;
//$Account=$_SESSION['Account'];
//$data = array(); 
require_once("/var/www/db/dblogin.php");
require_once("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$sql="SELECT pictureName,2dimageLink,productInfo FROM platform WHERE updateTime IN (SELECT MAX(updateTime) FROM platform GROUP BY categoryNo)";
$result = $db->query($link,$sql);
while ($row = mysqli_fetch_row($result)){


//echo "＜pre＞" . print_r( $data , true ) . "＜/pre＞";
//foreach ($row as $value){
echo "<figure id='figure".$i."' ><img src='".$row[1]."'  width='180' height='240' alt=''><span id='imageInfo".$i."' >".$row[0]."</span></figure>";
//}

$i++;
}

//$image3D = $row[$i]['3dimageLink'];
//$image2D = $row[$i]['2dimageLink'];
//$imagePhysical = $row[$i]['physicalImage'];

/*echo "<figure id=\"figure0\" >
		<img src=\"".$image2D."\"  width=\"180\" height=\"240\" alt=\"\">
		<span id=\"imageInfo0\" ></span>
	</figure>";*/


?>