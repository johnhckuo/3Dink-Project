<?php
//	for ($i=0;$i<count($_FILES['upload']['name'])
    if ($_FILES["fileToUpload"]["error"]>0){
    	echo "Error".$_FILES["fileToUpload"]["error"]."<br />";
    }else{
    echo "檔案名稱：" . $_FILES["fileToUpload"]["name"]."<br/>";
    echo "檔案類型：" . $_FILES["fileToUpload"]["type"]."<br/>";
    echo "檔案大小：" . ($_FILES["fileToUpload"]["size"]/1024)."Kb<br/>";
    echo "暫存名稱：" . $_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"upload/".$_FILES["fileToUpload"]["name"]);
	
     }
?>
