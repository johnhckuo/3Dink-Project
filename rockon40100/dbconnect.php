<?php

class DB {
    function connect_db($host, $user, $pwd, $dbname)
    {
       
     $link = @mysqli_connect( 
	 
            "$host",  // MySQL�D���W�� 
            "$user",       // �ϥΪ̦W�� 
            "$pwd",           // �K�X 
            "$dbname");  // �w�]�ϥΪ���Ʈw�W��

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



            

