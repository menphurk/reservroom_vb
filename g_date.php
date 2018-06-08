<?php   
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);
date_default_timezone_set('Asia/Bangkok');
if($_GET['rev']==1){
    echo date("H:i:s");
    echo "&nbsp;น.";
    exit;
}
?>