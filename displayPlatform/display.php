<?php
//$Account=$_SESSION['Account'];
//$data = array(); 

require_once("/var/www/db/dblogin.php");
require_once("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$sql="SELECT pictureName, 2dimageLink FROM platform WHERE updateTime IN (SELECT MAX(updateTime) FROM platform GROUP BY categoryNo)";
$result = $db->query($link,$sql);

while ($row = mysqli_fetch_row($result)){
	echo $row[0].'+'.$row[1].'+';
}

?>