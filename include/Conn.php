<?php 
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $dbname = "db_reservroom";
    mysql_connect($host,$user,$pass) or die(mysql_error());
    mysql_select_db($dbname) or die(mysql_error());
    mysql_query("SET NAMES UTF8");
?>