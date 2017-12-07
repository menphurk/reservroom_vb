<?php
$timeout = 1800; 
if(isset($_SESSION['timeout'])) {
   $duration = time() - (int)$_SESSION['timeout'];
   if($duration > $timeout) {
       session_destroy();
       session_start();
   }
}
$_SESSION['timeout'] = time();

?>