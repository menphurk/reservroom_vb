<?php session_start();
    include_once('include/Conn.php');
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
                $sql_UserOnline = "INSERT INTO `users_online`(`sid`, `time`, `ip`, `UserID`) VALUES ('".$strSessionID."',NOW(),'".$_SERVER['REMOTE_ADDR']."','".$_SESSION['login'][0]."')";
                mysql_query($sql_UserOnline);
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
?>