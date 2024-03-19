<?php
$databass_username = "root" ; 
$databass_password = ""  ; 
$host = "localhost"  ; 
$db_name = "heaxashop" ; 

try{
$connection = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4" , $databass_username , $databass_password ) ; 
}catch( Exception $e  )
{
    //echo $e->getMessage() ; 
    echo "<h2>" .  "  site is updating pleas try another time....  " . "</h2>" ; 
}

$eror = "" ; 
