<?php
//$Account=$_SESSION['Account'];
//$data = array(); 

require_once("/var/www/db/dblogin.php");
require_once("/var/www/db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$sql="(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 1
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 2
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 3
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 4
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 5
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 6
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 7
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 8
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 9
  order by updateTime desc
  LIMIT 5
)
UNION ALL
(
  select pictureNo, pictureName,2dimageLink
  from platform
  where `categoryNo` = 10
  order by updateTime desc
  LIMIT 5
)";
$result = $db->query($link,$sql);

while ($row = mysqli_fetch_row($result)){
	echo $row[0].'+'.$row[1].'+'.$row[2].'+';
}

?>