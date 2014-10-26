//檢查字串長度
function checkLength( o, min, max ) {
	if ( o.length > max || o.length < min ) {
		return false;
	} else {
		return true;
	}
}
//檢查正規化		
function checkRegexp( o, regexp ) {
	if ( !( regexp.test( o) ) ) {
		return false;
	} else {
		return true;
	}
}		
function checkFields() {


	//檢查作品名稱
	var name = document.getElementById('name').value;
	if(name==''){
		alert('尚未輸入作品名稱');
		return false;
	}
	else if(!(checkLength( name, 1, 20 ))){
		alert('作品名稱應少於20字');
		return false;
	}
	//檢查資料夾
	var createnum=document.getElementById('uploadform').create; //建資料夾
	//var create0=document.getElementById('create0'); //不建資料夾
	var folderName=document.getElementById('folderName').value; //資料夾名稱
	var folder = document.getElementById('folder').value; //選擇資料夾
	
	for(var i=0;i<createnum.length;i++){
		 if(createnum[i].checked){	 
			create = createnum[i].value ;
			//console.log(create);
		 }
	}
	if( create=='0' && folder == '0')
	{
		alert("尚未選擇資料夾");
		return false;	
	}　　
	else if( create=='1' &&  folderName=='')
	{
		alert('請輸入資料夾名稱');
		return false;
	}
	else if(create=='1' &&  !(checkLength( folderName, 1, 30 ))){
		alert('資料夾名稱應少於30字');
		return false;
	}
	
	//檢查授權金額
	var radionum=document.getElementById('uploadform').authorization;//是授權
	var auzPrice=document.getElementById('auzPrice').value;//授權金額
	for(var i=0;i<radionum.length;i++){
		 if(radionum[i].checked){	 
			authorization = radionum[i].value ;
			//console.log(create);
		 }
	}
	if(authorization==1 && authorization==''){
		alert('請輸入授權金額');
		return false;
	}
	else if(authorization==1 && !(checkRegexp(auzPrice , /^[\-\+]?\d+$/ )) &&!(checkLength( auzPrice, 1, 6 ))){
		alert('請輸入正確金額');
		return false;
	}
	
	//檢查簡介
	var introduction=document.getElementById('introduction').value;
	
	if(introduction==''){
		alert('請輸入簡介');
		return false;
	}
	else if( !( checkLength(introduction, 1, 100 ))){
		alert('簡介應少於100字');
		return false;
	}
	
	return true;
}
	