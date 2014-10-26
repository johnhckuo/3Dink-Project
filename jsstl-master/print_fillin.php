<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<html>

<head>
	<title>填寫表單</title>
	<script type="text/javascript" src="js/check_insert.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<link rel=stylesheet type="text/css" href="css/print_fillin.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/city.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_add").citySelect({cityTraget:"receiverAddress"});
		})
	</script>
	<?php
		require_once("../db/dblogin.php");
		require_once("../db/dbconnect.php");
		$db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		if(isset($_POST['productName'])){
			$productName=$_POST['productName'];
			$addsql="INSERT INTO product(productName)  VALUES ('$productName')";//少影片路徑
			$result = $db->query($link,$addsql);
			$sql="SELECT productNo FROM product WHERE productName='$productName' ORDER BY productNo DESC limit  1";
			$result2 = $db->query($link,$sql);
			$row_productNo = mysqli_fetch_row($result2);

		}

	?>

</head>	

<body style="overflow-x: hidden;background-image:url(../img/bgcolor.png); ">

		<div class="navbar navbar-fixed-top" id='headerlink'>
			<div class="navbar-inner" >
				<div class='fixbarleft' id='fixbarleft'><img src='../img/fixbar_left.png'></div>
				<div class="navcontainer" >
					<?php include('../zhen/login_success.php');?>
					<ul class="nav searchbox">
						<li><input type="text"  placeholder="搜尋" style="font-color:#a1a1a1"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../jsstl-master/index.html"><img src="../img/print.png"></a></li>
						<li><a href="../displayPlatform/index.html"><img src="../img/platform.png"></a></li>
						<li><a href="../zhen/forum/forum_index.php"><img src="../img/forum.png"></a></li>
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="../showMode/file_upload.html"><img src="../img/upload.png"></a></span>
				</div>
				<div class='fixbarright' id='fixbarright'><img src='../img/fixbar_right.png'></div>
			</div>
		</div>
	
	<div class="formarea">
		<span class="toptext">請填寫以下資料</span>
		 <form name="fillin" method="POST" action="print_fillin_finish.php">
            <ul class='printinfo'><!--均先給固定值-->
                <li>預估塑料量：</li>
				<li>價錢：<span><input type="hidden" name="printCost" value="1000" />$1000</span></li> 
				<li>運費：<span><input type="hidden" name="freight" value="60" />$60</span></li>
				<li>尺寸：</li>
			</ul>
			<ul class="filltextbar">
				<li>收件人：<input type="text" name="receiverName" id="receiverName"></li>
				<li>收件地址：<span id="select_add"></span><input type="text" name="receiverAddress" id="receiverAddress" size="40"></li>
				<li>電話：<input type='text' name="receiverTelephone" id='receiverTelephone'></li>
            </ul>
            <ul class="filltextbutton">
            	<input type="hidden" name="productNo" value="<?php echo $row_productNo[0];?>" /><!--產品編號-->
                <li><a href="index.php"><input type="button" value=""></a></li>
				<li><input type='submit' id='sent' value='' onClick="return check_insert();"></li>
            </ul>
        
		</div>
	</div>
	
</body>

</html>


   
