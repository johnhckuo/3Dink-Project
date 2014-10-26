
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="../css/fixbar.css">
	<link rel="stylesheet" type="text/css" href="../css/register.css">
	
	<link rel="stylesheet" href="jQuery-Validation/css/validationEngine.jquery.css" type="text/css">
	<link rel="stylesheet" href="jQuery-Validation/css/template.css" type="text/css">
	<script src="jQuery-Validation/js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="jQuery-Validation/js/languages/jquery.validationEngine-zh_TW.js" type="text/javascript" charset="utf-8"></script>
	<script src="jQuery-Validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">	
				// This method is called right before the ajax form validation request
		// it is typically used to setup some visuals ("Please wait...");
		// you may return a false to stop the request 
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
			
			$("#registerform").validationEngine({
				promptPosition : "centerRight", 
				scroll: true,
				autoHidePrompt:true, //訊息隱藏 預設10秒後
				ajaxFormValidation: true,
				ajaxFormValidationMethod: 'post',
				onAjaxFormComplete: ajaxValidationCallback,
				onBeforeAjaxFormValidation: beforeCall
			
			});
			
		});
		
		/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				// this allows to use i18 for the error msgs
				return options.allrules.validate2fields.alertText;
			}
		}
	</script>
<title>註冊</title>

</head>
<body style="overflow-x: hidden;margin:0 0 0 0 ;background-color:#333333;">
	<?php $memberNo=0;?>
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
		<div class="register">
			<form id="registerform" name="registerform" class="registerform" method="post" action="register_finish.php">
				帳號：<input class="validate[required,custom[onlyLetterNumber],minSize[3],maxSize[20],ajax[ajaxUserCallPhp]]" type="text" name="Account" id='Account' /> <br />
				密碼：<input  class="validate[required,minSize[3],maxSize[16]]" type="password" name="Password" id='Password'/> <br />
				再次輸入密碼：<input class='validate[required,equals[Password]]'type="password" name="Password2" /> <br />
				暱稱：<input class="validate[required]" type="text" name="Nickname" id="Nickname"/><br />
				電子信箱：<input type="text" class="validate[required,custom[email]]" name="Email" id="Email"/> <br />
				<ul id="register_sent" class="register_sent">
				
					<!--<li><input type="submit" name="Button" value="確認註冊" class="a_demo_four"></li>-->
					<li><input type="button"  name="submit" value="確認註冊" class="a_demo_four" onclick='user_register()'></li>
					<li><input type="reset" value="重新填寫" class="a_demo_four"></li>
				</ul>
			</form>
			<div id="error_msg"></div>
			<span id="login_showname">
			<!--放登入狀態-->
			</span>
			<div id="loading_div" style="display:none">
				<img src="test/ajax_loader.gif"><br/>Login...please wait
			</div>
			<div id="login_success" style="display:none;">
			<!--放you are successfully login-->
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/search.js"></script>
	<script type="text/javascript">

		function checkLength( o, min, max ) {
					//if ( o.val().length > max || o.val().length < min ) {
					if ( o.length > max || o.length < min ) {
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
			

		function user_register(){
			<!--先取得欄位值-->
			
			var Account = $('#Account').val();
			var Password = $('#Password').val();
			var Nickname=$('#Nickname').val();
			var Email=$('#Email').val();
			var data=$('#registerform').serialize();
			//var type="POST";
			var url = $('#registerform').attr("action");
			//alert(user_name);
			//alert(user_password);
			//alert($('#registerform').serialize());
			//alert( $('#registerform').attr("action"));
			
			if(Account=="" ||  !(checkLength( Account, 3, 20 )) || !(checkRegexp(Account, /^[0-9a-zA-Z]+$/))){
				$('#error_msg').text('Please enter your account again');
				$('#Account').focus();
				return false;
			}else if(Password=="" || !(checkLength( Password, 3, 16 ))){
				$('#error_msg').text('Please enter your password again');
				$('#Password').focus();
				return false;
			}else if(Nickname==""|| !(checkLength( Nickname, 1, 15 ))){
				$('#error_msg').text('Please enter your nickname again');
				$('#Nickname').focus();
				return false;
			}else if(Email=="" || !(checkRegexp(Email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i))){
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
					$('#register_sent').hide(); 	
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
						window.location = '../index.php';
							
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
				
				}
			});	
		}
	</script>
</body>
</html>



