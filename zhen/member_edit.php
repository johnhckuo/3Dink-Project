<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>會員資料編輯</title>
<link rel="stylesheet" href="jQuery-Validation/css/validationEngine.jquery.css" type="text/css">
<link rel="stylesheet" href="jQuery-Validation/css/template.css" type="text/css">
<script src="jQuery-Validation/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="jQuery-Validation/js/languages/jquery.validationEngine-zh_TW.js" type="text/javascript" charset="utf-8"></script>
<script src="jQuery-Validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<style type='text/css'>
#edit{
	position:relative;
	background-position:center;
	margin-top:150px;
	margin-left:auto;
	margin-right:auto;
	padding: 20px;
	width: 400px;
	height:400px;
	background:#000000;
	color:#999999;
	font-family:Microsoft JhengHei;
	font-size:24px;
	border-style:solid;
	border-width : 0px;
	-webkit-border-radius: 5px;
        opacity:0.65;
	}
.edit_sent{
	margin-top: 30px;
}
.button2 {
	position:relative;
	opacity:0.7;
	background-color:#000000;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #858a88;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:7px 12px;
	text-decoration:none;
	float:right;
	
}

.button2:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0d1515), color-stop(1 , #4d4c4c));
	background:-moz-linear-gradient(top, #0d1515 10%, #4d4c4c 100%);
	background:-webkit-linear-gradient(top, #0d1515 10%, #4d4c4c 100%);
	background:-o-linear-gradient(top, #0d1515 10%, #4d4c4c 100%);
	background:-ms-linear-gradient(top, #0d1515 10%, #4d4c4c 100%);
	background:linear-gradient(to bottom, #0d1515 10%, #4d4c4c 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0d1515', endColorstr='#4d4c4c',GradientType=0);
	background-color:#000000;
}
.button2:active {
	position:relative;
	top:1px;
}	
</style>
<script type="text/javascript">	
		function beforeCall(form,options){
			if(window.console){
				console.log("Right before the AJAX form validation call");
			};
			return true;
		};
			
		// Called once the server replies to the ajax form validation request
		function ajaxValidationCallback(status,form,json,options){
			if(window.console){
				console.log(status);
			};
				
			if(status === true){
				alert("the form is valid!");
				// uncomment these lines to submit the form to form.action
				// form.validationEngine('detach');
				// form.submit();
				// or you may use AJAX again to submit the data
			}
		};
		$().ready(function(){
			// binds form submission and fields to the validation engine
			
			$("#editform").validationEngine({
				promptPosition : "centerRight", 
				scroll: true,
				autoHidePrompt:true, //訊息隱藏 預設10秒後
				ajaxFormValidation: true,
				ajaxFormValidationMethod: 'post',
				onAjaxFormComplete: ajaxValidationCallback,
				onBeforeAjaxFormValidation: beforeCall
			
			});
			
		});
	</script>
</head>

<body style="overflow-x: hidden; background-image: url(http://140.127.233.248/img/bgcolor.png);">
 <div id="edit">
<?php
	if( !isset($_SESSION['No']))
			{
				echo "<script language='javascript'>";
				echo "alert('尚未登入，請重新登入');";	
				echo "window.location.assign('../index.php');";
				echo "</script>";
				exit;
				//header('../index.php');
				//exit;
			}
	require_once("../db/dblogin.php");
	require_once("../db/dbconnect.php");
	


if($_SESSION['No'] != null)
{
        $memberNo = $_SESSION['No'];
        $db=new DB();
		$link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);
		$sql="SELECT * FROM member where memberNo = '$memberNo' ";

		$result = $db->query($link,$sql);
		$row = mysqli_fetch_row($result);
    
        echo "<form id='editform' name='form' method='post' action='mem_edit_finish.php'>";
		echo "暱稱：<input id=\"Nickname\" class=\"validate[required,minSize[1],maxSize[15]]\" type=\"text\" name=\"Nickname\" value=\"$row[10]\" /><br>";
        echo "密碼：<input id=\"Password\" class=\"validate[required,minSize[3],maxSize[16]]\"  type=\"password\" name=\"Password\" value=\"$row[4]\" /> <br>";
        echo "再一次輸入密碼：<input id=\"Password2\" class=\"validate[required,equals[Password]]\" type=\"password\" name=\"Password2\" value=\"$row[4]\" /> <br>";
        echo "電子信箱：<input id=\"Email\" class=\"validate[required,custom[email],minSize[3],maxSize[50]]\" type=\"text\" name=\"Email\" value=\"$row[5]\" /> <br>";
        
?>      
	<div class='edit_sent'>
		<input type="button" name="submit\" value="編輯完成" class="button2" id='submit' onclick='member_edit();'>
		<input type="button" name="cancel\" value="取消編輯"  class="button2" id='cancel' onclick="location.href='manage.php'">
	</div>	
		<div id="error_msg"></div>
			<span id="login_showname">
			<!--放登入狀態-->
			</span>
			<div id="loading_div" style="display:none">
				<img src="test/ajax_loader.gif"><br/>Edit...please wait
			</div>
			<div id="login_success" style="display:none;">
			<!--放you are successfully login-->
		</div>
        </form>
</div>
<?php }?>
<script type="text/javascript">
	
function checkLength( o, min, max ) {
			//if ( o.val().length > max || o.val().length < min ) {
			if ( o.vlength > max || o.length < min ) {
				return false;
			} else {
				return true;
			}
		}
		
function checkRegexp( o, regexp ) {
		if ( !( regexp.test( o) ) ) {
			return false;
		} else {
			return true;
		}
	}
	

function member_edit(){
	<!--先取得欄位值-->
	
	var Password = $('#Password').val();
	var Password2 = $('#Password2').val();
	var Nickname=$('#Nickname').val();
	var Email=$('#Email').val();
	var data=$('#editform').serialize();
	var url = $('#editform').attr("action");
	//alert(Password);
	//alert(Nickname);
	//alert(Email);
	//alert($('#editform').serialize());
	//alert( $('#editform').attr("action"));  //use for debug
	
	if(Password=="" ||  !(checkLength( Password, 3, 16 ))){
		$('#error_msg').text('Please enter your password again');
		$('#Account').focus();
		return false;
	}else if(Password!=Password2){
		$('#error_msg').text('Please enter your password again');
		$('#Password').focus();
		return false;
	}else if(Nickname==""|| !(checkLength( Password, 1, 15 ))){
		$('#error_msg').text('Please enter your nickname again');
		$('#Nickname').focus();
		return false;
	}else if(Email=="" ||  !(checkLength( Email, 3, 50 )) || !(checkRegexp(Email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i))){
		$('#error_msg').text('Please enter your email again');
		$('#Email').focus();
		return false;
	};
	$.ajax({
		url:url,
		//data:"user_name="+user_name+"&user_password="+user_password,
		//data: {user_name:user_name,user_password:user_password},
		//data: {user_name: $('#user_name').val(),  user_password: $('#user_password').val()},
		data:data,
		type : 'post',
		beforeSend:function(){
			$('#loading_div').show(); 
			//$('#register_sent').hide(); 	
			$('#error_msg').hide();
			//beforeSend 發送請求之前會執行的函式
		},
		//success: function(response){alert(response);},
		
		success:function(msg){
			//alert(msg);
			msg=msg.trim() ;
			if(msg =="success"){
				//$('#login_showname').text('Welcome!'+user_name);
				//$('#login_success').text('You have successfully login!');
				//$('#login_success').fadeIn();
				//$('#error_msg').hide();
				//$('#user_login').hide(); 	
			//	$('#fb_connect').hide();
				alert('修改成功');
				window.location = 'manage.php';
				
			}else
			{	
				$('#error_msg').show();
				$('#error_msg').html('請重新填寫');
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



