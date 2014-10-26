<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
        ini_set('display_errors', 'On');
        //尚未連接會員
<<<<<<< HEAD
        require_once("dblogin.php");
        require_once("dbconnect.php");
=======
        require_once("db/dblogin.php");
        require_once("db/dbconnect.php");
>>>>>>> dd15561fa97ccc9e697410770e74215f970e39f8
        $db=new DB();
        $link=$db->connect_db($_DB['host'],$_DB['username'],$_DB['password'],$_DB['dbname']);//??
        $receiverName= @$_POST['receiverName'];
        $receiverAddress= $_POST['receiverAddress'];
        $receiverZip= $_POST['receiverZip'];
        $receiverTelephone= $_POST['receiverTelephone'];
        $sql="INSERT INTO receiver_info (receiverName, receiverAddress,receiverZip,receiverTelephone) VALUES ('$receiverName', '$receiverAddress','$receiverZip','$receiverTelephone') ";
        $result = $db->query($link,$sql);
        if($result)
                {
                        echo '新增成功';
                        header("Location:print_finish.html" );
                }

		
?>
