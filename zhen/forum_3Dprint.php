<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type="text/css" href="../css/fixbar.css">
<?php
session_start();
require("../db/dblogin.php");
require("../db/dbconnect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
?>
<title>3D列印討論區</title>
</head>

<body>
<div class="navbar navbar-fixed-top" >
      <div class="navbar-inner" >
	  <span class="brand" href="#" ><img src="../img/3D-ink_transparent.png"></img></span>
        <div class="navcontainer" >
			<?php include('login_success.php')?>
			<ul class="nav searchbox">
				<li><input type="text"  placeholder="搜尋"></li>
			</ul>  
		</div>
    </div>
</div>
<div style=margin-top:300px>
<input type="button" value="發表新主題" onclick="location.href='forum_3dprintnew.php'">
</div>
</body>
</html>
