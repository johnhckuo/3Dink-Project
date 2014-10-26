<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css" >
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link rel="stylesheet" href="jquery-ui.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!--自動refresh-->
	<script>
		//自動refresh
		$(window).resize(function(){
			window.location.reload();
		  });
	</script>
	<style type="text/css">
		body{
			background-image:url(../img/loginbg.jpg);
			background-size:100%;
			background-repeat:no-repeat;
			overflow:hidden;
		}
	</style>
	
<?php
session_start();
require("../db/dblogin.php");
require("../db/dbconnect.php");
require("fb_connect.php");
$db=new DB();
$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
$facebook = new Facebook($config);
?>
<title>會員登入</title>
</head>

<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<div class='frame' id='frame'>
		<div class="navbar navbar-fixed-top" id="headerlink">
			<div class="navbar-inner" id="navbar-inner">
				<div class="navcontainer" >
					<?php include('../zhen/login_success.php')  ?>
					<ul class="nav searchbox">
						<li><input type="text" id='searchbox'  placeholder="搜尋" style="font-color:#a1a1a1" onkeydown="search()"></li>
					</ul> 
					<ul class="nav button">
						<li><a href="../three"><img src="img/forum.png"></a></li>
						<li><a href="../jsstl-master/index.php"><img src="img/print.png"></a></li>
						<li><a href="../newShowmode/index.php"><img src="img/platform.png"></a></li>
						<li><a href=""><img src="img/forum.png"></a></li>	
					</ul>
					<span class="logo"><a href="../index.php"><img src="../img/print_img/choose.png"></a></span>
					<span class="nav uploadbutton" ><a href="/showMode/file_upload.php"><img src="../img/upload.png"></a></span>
				</div>
			</div>
		</div>
		<div class="middle">
			<div class="login" id="login">
				<div class="login_content">
					<form  method="POST" action="login_chk.php" id='user_login'>
						<ul class="login_insert">
							<li>帳號：<input type="text"  id='user_name' name="user_name"  ></li>
							<li>密碼：<input type="password"  id='user_password' name="user_password" ></li>
						</ul>
						<ul class="login_sent">	
							<!--<li><input type="submit" name="Login" value="登入" class="a_demo_four" onclick="return check()"></li>-->
							<li><input type="button" id='submit' name="Login" value="登入" class="a_demo_four" onclick='userlogin();'></li>
							<li><input type="button" id='register' value="註冊" onclick="location.href='register.php'" class="a_demo_four"></li>
							<div id="error_msg"></div>
							<span id="login_showname">
								<!--放登入狀態-->
							</span>
							<div id="loading_div" style="display:none">
								<img src="test/ajax_loader.gif"><br/>Login...please wait
							</div>
							<div id="loadingout_div" style="display:none">
								<img src="test/ajax_loader.gif"><br/>Logout...please wait
							</div>
							<div id="login_success" style="display:none;">
								<!--放you are successfully login-->
							</div>
						</ul>
<?php
					$params = array(
						'scope' => 'email',					
						);
					//$login_url = $facebook->getLoginUrl($params);						
					$user_id = $facebook->getUser();	
					if($user_id) {						
							$user_profile = $facebook->api('/me','GET');															 
							//$user_id=$user_profile['id'];
							$user_name=$user_profile['name'];
							$user_email=$user_profile['email'];	
							//echo $user_id.$user_name.$user_email;
							$sql="SELECT * FROM member WHERE  facebookID='$user_id'";
							$result = $db->query($link,$sql);
							$row = mysqli_fetch_assoc($result);	
							if($result)
							{			
								$_SESSION['id'] = $user_id;
								$_SESSION['No'] = $row["memberNo"];
								echo '登入成功';
								//header("Location:../index.php" );
								//exit();
								echo"<meta http-equiv='refresh' content='0;url=../index.php' />";
							}else{								
								
								$sql2 = "INSERT INTO member (facebookID,Email,pPath,Nickname) values ('$user_id','$user_email','http://graph.facebook.com/$user_id/picture','$user_name')";
								//$sql2 = "INSERT INTO member (facebookID,Email,Nickname) values ('$user_id','$user_email','$user_name')";
								$result2 = $db->query($link,$sql2);
								if($result2)
								{
									$_SESSION['id'] = $user_id;
									$_SESSION['No'] = $row["memberNo"];
									//header("Location:../index.php" );
									//exit();
									echo"<meta http-equiv='refresh' content='0;url=../index.php' />";
								}
							}					 		
					} 
					else {    														
							//echo 'Please <a href="' . $login_url . '">login.</a>';
							$login_url = $facebook->getLoginUrl($params);	
							echo "<a href=".$login_url."><img id='fb_connect' class='fb' src='../img/facebook_login.png'></a>";										
							
					}
				
				?>
					</form>
				</div>
			</div>
		</div>	
	</div>
<?php //header('Refresh:3');  //for zhen debug usage?>      
<script type="text/javascript">
		
		document.getElementById("login").style.height =  window.innerHeight -150 +'px';
		console.log( window.innerHeight);
		
		function check(){
			var account=document.getElementById('account').value;
			if(transactionType==0 )
			{
				alert('尚未選擇類型');
				return false;
			}
			else{
				return true;
			}
			alert(account);
		}
		
	

function userlogin(){
	<!--先取得欄位值-->
	var user_name = $('#user_name').val();
	var user_password = $('#user_password').val();
	var data=$('#user_login').serialize();
	//var type="POST";
	var url = $('#user_login').attr("action");
	//alert(user_name);
	//alert(user_password);
	//alert($('#dialog-form').serialize());
	//alert( $('#user_login').attr("action"));
	<!--判斷有無正確填寫-->
	if(user_name=="" && user_password==""){
		$('#error_msg').text('Please enter your ID & password');
		return false;
	}
	if(user_name==""){
		$('#error_msg').text('Please enter your ID');
		$('#user_name').focus();
		return false;
	}else if(user_password==""){
		$('#error_msg').text('Please enter your password');
		$('#user_password').focus();
		return false;
	};
	//真正的ajax動作從這裡開始
	$.ajax({
		url:url,
		//data:"user_name="+user_name+"&user_password="+user_password,
		//data: {user_name:user_name,user_password:user_password},
		//data: {user_name: $('#user_name').val(),  user_password: $('#user_password').val()},
		data:data,
		type : 'post',
		beforeSend:function(){
			$('#loading_div').show(); 
			$('#submit').hide(); 	
			$('#register').hide(); 	
			$('#fb_connect').hide();
			$('#error_msg').hide();
			//beforeSend 發送請求之前會執行的函式
		},
		//success: function(response){alert(response);},
		
		success:function(msg){
			//alert(msg);
			//alert(msg.trim());
			msg=msg.trim() ;
			if(msg =="success"){
				//$('#login_showname').text('Welcome!'+user_name);
				//$('#login_success').text('You have successfully login!');
				//$('#login_success').fadeIn();
				//$('#error_msg').hide();
				//$('#user_login').hide(); 	
			//	$('#fb_connect').hide();
				window.location = '../index.php';
				//如果成功登入，就不需要再出現登入表單，而出現登出表單	
			}else
			{	
				$('#error_msg').show();
				$('#error_msg').html('Please Login again,<br/>沒有此用戶或密碼不正確');
				setTimeout("$('#error_msg').hide()",2000);		
				setTimeout("$('#submit').show() ",2000);		
				setTimeout("$('#register').show() ",2000);		
				setTimeout("$('#fb_connect').show()",2000);		
					
					
				
			}
		},
		error:function(xhr){
			alert('Ajax request 發生錯誤');
		},
		complete:function(){
			$('#loading_div').hide();
			
			//$('#user_login').hide(); 		
			//complete請求完成實執行的函式，不管是success或是error
		}
	});	
}
</script>
	
</body>

</html>

