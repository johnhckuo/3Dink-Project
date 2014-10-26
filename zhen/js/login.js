$(function() {
//開啟對話匡
$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			//modal: true,
	});		
$( "#login_dialog" ).button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});		
});		
 
//連結資料庫login
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
	alert( $('#user_login').attr("action"));
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
			//beforeSend 發送請求之前會執行的函式
		},
		//success: function(response){alert(response);},
		
		success:function(msg){
			//alert(msg.trim());
			msg=msg.trim() ;
			if(msg =="success"){
				$('#login_showname').text('Welcome!'+user_name);
				$('#login_success').text('You have successfully login!');
				$('#login_success').fadeIn();
				$('#error_msg').hide();
				$('#user_login').hide(); 	
				$('#user_logout').fadeIn();
				//如果成功登入，就不需要再出現登入表單，而出現登出表單	
			}else
			{	
				$('#error_msg').show();
				$('#error_msg').html('Please Login again,<br/>沒有此用戶或密碼不正確');
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