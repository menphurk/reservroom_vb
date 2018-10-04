<?php session_start();
    include_once('include/Conn.php');
    $date = date('d-m-Y H:i:s');
    if(isset($_POST['btn_login']))
    {
        $username_log = mysql_real_escape_string($_POST['username_log']);
        $password_log = mysql_real_escape_string(md5($_POST['password_log']));
        $ch_log = "select * from users as u";
        $ch_log .= " join title as t on(t.title_id = u.title_id)";
        $ch_log .= " where username_log='".$username_log."' AND password_log='".$password_log."'";
        $result_log = mysql_query($ch_log);
        $num_log = mysql_num_rows($result_log);
        if($num_log == 1)
        {
            $row_log = mysql_fetch_array($result_log);
            $ses_data = array(
                $_SESSION['ses_id'] = $row_log['id_user'],
                $_SESSION['ses_user'] = $row_log['username_log'],
                $_SESSION['ses_name'] = $row_log['title_name']." ".$row_log['name_log'],
                $_SESSION['ses_role'] = $row_log['id_role'],
            );
                $_SESSION['login'] = $ses_data;
                $strSessionID = session_id();
                    // //LineNotify//
                    // $message = "\nSSID: ".$strSessionID."\n".'IP: '.$_SERVER['REMOTE_ADDR']."\n".'Name: '.$_SESSION['ses_name']."\n".'Date: '.$date;
                    
                    // sendlinemesg();
                    // header('Content-Type: text/html; charset=utf-8');
                    // $res = notify_message($message);
           echo "<script>window.location.href='reserv.php'</script>";
        }else
        {
            echo "<script>alert('ไม่สามารถเข้าสู่ระบบได้ กรุณาลองใหม่อีกครั้ง!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    }else
    {
        echo "";
    }
                    // // //LineNotify//
                    //  function sendlinemesg() {
	
                    //      define('LINE_API',"https://notify-api.line.me/api/notify");
                    //      define('LINE_TOKEN','FQrUgIoZqSgWruTPCrI9iJVM72IchWPoiolt5kyZjqN');
                    
                    //      function notify_message($message){
                    
                    //          $queryData = array('message' => $message);
                    //          $queryData = http_build_query($queryData,'','&');
                    //          $headerOptions = array(
                    //              'http'=>array(
                    //                  'method'=>'POST',
                    //                  'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    //                          ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                    //                          ."Content-Length: ".strlen($queryData)."\r\n",
                    //                  'content' => $queryData
                    //              )
                    //          );
                    //         $context = stream_context_create($headerOptions);
                    //          $result = file_get_contents(LINE_API,FALSE,$context);
                    //          $res = json_decode($result);
                    //          return $res;
                    
                    //      }
                    
                    // }
?>