<?php
require_once("/var/www/db/dblogin.php");
require_once("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$sql="SELECT COUNT(personalFolderNo) FROM  platform WHERE memberNo =6";
$result = $db->query($link,$sql);
$row=mysqli_fetch_row($result);
echo $row[0];

?>