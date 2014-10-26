<?php

class DB {
    function connect_db($host, $user, $pwd, $dbname)
    {
       
     $link = @mysqli_connect( 
	 
            "$host",  // MySQL主機名稱 
            "$user",       // 使用者名稱 
            "$pwd",           // 密碼 
            "$dbname");  // 預設使用的資料庫名稱

    return $link;
		}
    
    function query($link,$sql)
    {
        mysqli_query($link, 'SET CHARACTER SET utf8');
        mysqli_query($link,  "SET collation_connection = 'utf8'");
        $result = mysqli_query($link,$sql);
		return $result;
    }
    

    
}
?>



            

