
	require_once("/var/www/db/dbconnect.php");
	$db=new DB();
	$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
	if($_GET['category']!=0){
		$result = $db->query($link,$sql);//圖
	$figureID = 0;
	for($i=0; $i<$length; $i++){
		$row = mysqli_fetch_row($result);
			echo "<figure id=".$figureID.">";
			$figureID++;
		}	
		else if ($i%3 == 0){
			echo "</figure><figure id=".$figureID.">";
		}
		else if ($i == $length){
			echo "</figure>";
		}
		echo "<div><a href='../showMode/index.php?categoryNo=".$category."&pictureNo=".$row['3']."'>";
		echo "<img src='../showMode/".$row['0']."' />";
		echo "</a></div>";  */      
	}
	