<?php require('include/Conn.php');
error_reporting( error_reporting() & ~E_NOTICE );
if($_POST['btn_create_reserv'])
{
        //RUNRESERV//
        $CodeReserv = "VBR";

        $sql = "SELECT MAX(id_reserv) AS lastid FROM reserv";
        $q = mysql_query($sql);
        $row = mysql_fetch_array($q);
        $maxId = substr($row['lastid'],-5);
        $maxId = ($maxId + 1);
        $maxId = substr("00000".$maxId,-5);
        $nextId = $CodeReserv.$maxId;
        //--RUNRESERV--//

    $str_startday = mysql_real_escape_string($_POST['startday']);
    $str_startmonth = mysql_real_escape_string($_POST['startmonth']);
    $str_startyear = mysql_real_escape_string($_POST['startyear']);

    $start_event = ($str_startyear-543)."-".$str_startmonth."-".$str_startday;

    $str_starttime = mysql_real_escape_string($_POST['starttime']);

    $str_endday = mysql_real_escape_string($_POST['endday']);
    $str_endmonth = mysql_real_escape_string($_POST['endmonth']);
    $str_endyear = mysql_real_escape_string($_POST['endyear']);
    $end_event = ($str_endyear-543)."-".$str_endmonth."-".$str_endday;

    $str_endtime = mysql_real_escape_string($_POST['endtime']);

    $str_room = mysql_real_escape_string($_POST['room']);
    $str_typereserv = mysql_real_escape_string($_POST['typereserv']);
    $str_topic = mysql_real_escape_string($_POST['topic']);
    $str_desc = mysql_real_escape_string($_POST['desc']);
    $str_num = mysql_real_escape_string($_POST['num']);
    $str_namejoin = mysql_real_escape_string($_POST['namejoin']);
    $str_tel = mysql_real_escape_string($_POST['tel']);
    $str_check_catering = mysql_real_escape_string($_POST['check_catering']);
    $str_txt_catering2 = mysql_real_escape_string($_POST['txt_catering2']);
    $str_txt_cateringother = mysql_real_escape_string($_POST['txt_cateringother']);
    $str_check_projector = mysql_real_escape_string($_POST['check_projector']);
    $str_check_screen = mysql_real_escape_string($_POST['check_screen']);
    $str_check_dvd = mysql_real_escape_string($_POST['check_dvd']);
    $str_check_tv = mysql_real_escape_string($_POST['check_tv']);
    $str_check_record = mysql_real_escape_string($_POST['check_record']);
    $str_check_amp = mysql_real_escape_string($_POST['check_amp']);
    $str_check_control = mysql_real_escape_string($_POST['check_control']);
    $str_txt_control = mysql_real_escape_string($_POST['txt_control']);
    $str_check_wireless_mic = mysql_real_escape_string($_POST['check_wireless_mic']);
    $str_txt_wireless_mic = mysql_real_escape_string($_POST['txt_wireless_mic']);
    $str_check_mic = mysql_real_escape_string($_POST['check_mic']);
    $str_txt_mic = mysql_real_escape_string($_POST['txt_mic']);
    $str_check_other = mysql_real_escape_string($_POST['check_other']);
    $str_txt_other = mysql_real_escape_string($_POST['txt_other']);
    $str_table_reserv = mysql_real_escape_string($_POST['table_reserv']);
    $str_update_id = mysql_real_escape_string($_POST['update_id']);

    //------CheckRoom---//
            $check_room = "SELECT * FROM reserv WHERE id_room ='".$str_room."'
            AND 
            (
                (startday BETWEEN '".$start_event."' AND '".$end_event."')
                OR 
                (endday BETWEEN '".$start_event."' AND '".$end_event."')
                OR 
                ('".$start_event."' BETWEEN startday AND endday)
                OR
                ('".$end_event."' BETWEEN startday AND endday)
            )
            AND
            (
                (starttime BETWEEN '".$str_starttime."' AND '".$str_endtime."')
                OR 
                (endtime BETWEEN '".$str_starttime."' AND '".$str_endtime."')
                OR
                ('".$str_starttime."' BETWEEN starttime AND endtime)
                OR
                ('".$str_endtime."' BETWEEN starttime AND endtime)
            )
            AND id_status_reserv != '3'
            ";
            $result_checkRoom = mysql_query($check_room);
            $num_checkRoom = mysql_num_rows($result_checkRoom);
            if($num_checkRoom >= 1)
            {
                echo "<script>alert('ไม่สามารถจองห้องได้ เนื่องจากห้องถูกจองใช้งานไปแล้ว กรุณาเลือกเวลาจองอื่นๆ')</script>";
                echo "<script>window.history.back();</script>";
            }else
            {
                $str_insertevent = "INSERT INTO `reserv`(`id_reserv`, `startday`, `endday`, `starttime`, `endtime`, `id_room`, `id_type`, `topic`, `desc`, `num`, `namejoin`, `tel`, `check_catering`, `txt_catering2`, `txt_cateringother`, `check_projector`, `check_screen`, `check_dvd`, `check_tv`, `check_record`, `check_amp`, `check_control`, `txt_control`, `check_wireless_mic`, `txt_wireless_mic`, `check_mic`, `txt_mic`, `check_other`, `txt_other`,`id_status_reserv`, `create_date`, `id_table_reserv` , `update_id`)";
                $str_insertevent .= "VALUES ('".$nextId."','".$start_event."','".$end_event."','".$str_starttime."','".$str_endtime."','".$str_room."','".$str_typereserv."','".$str_topic."','".$str_desc."','".$str_num."','".$str_namejoin."','".$str_tel."','".$str_check_catering."','".$str_txt_catering2."','".$str_txt_cateringother."','".$str_check_projector."','".$str_check_screen."','".$str_check_dvd."','".$str_check_tv."','".$str_check_record."','".$str_check_amp."','".$str_check_control."','".$str_txt_control."','".$str_check_wireless_mic."','".$str_txt_wireless_mic."','".$str_check_mic."','".$str_txt_mic."','".$str_check_other."','".$str_txt_other."','1',NOW(),'".$str_table_reserv."','".$str_update_id."')";
                $result_insertevent = mysql_query($str_insertevent);
                if($result_insertevent)
                {

                    echo "<script>alert('จองห้องเรียบร้อยแล้ว')</script>";
                    $showdata_event = "SELECT * FROM reserv WHERE id_reserv='".$nextId."'";
                    $resultdata_event = mysql_query($showdata_event);
                    $rowdata_event = mysql_fetch_array($resultdata_event);
                    echo "<meta http-equiv='refresh' content='0;url=show_reserv.php?id_reserv=$rowdata_event[id_reserv]';>";

                    if($rowdata_event['id_status_reserv'] == 1)
                    {
                        $str_status = "ไม่อนุมัติ";
                    }elseif($rowdata_event['id_status_reserv'] == 2)
                    {
                        $str_status = "อนุมัติ";
                    }elseif($rowdata_event['id_status_reserv'] == 3)
                    {
                        $str_status = "ยกเลิก (หมายเหตุ:)".$rowdata_event['comment_reserv'];
                    }
                    //LineNotify//
                    $message = "\nเลขที่จอง:".$nextId."\n".'เรื่อง: '.$str_topic."\n".'เบอร์ติดต่อ: '.$str_tel."\n".'สถานะ: '.$str_status."\n".'URL: '.$_SERVER['HTTP_HOST'].'/reservroom/show_reserv.php?id='.$nextId;
                    
                    sendlinemesg();
                    header('Content-Type: text/html; charset=utf-8');
                    $res = notify_message($message);

                }else
                {
                    echo "<script>alert('เกิดข้อผิดพลาดในการจองห้อง กรุณาลองใหม่อีกครั้ง!')</script>";
                    echo "<script>window.history.back();</script>";                    
                }
            }
}

                    // //LineNotify//
                    function sendlinemesg() {
	
                        define('LINE_API',"https://notify-api.line.me/api/notify");
                        define('LINE_TOKEN','FQrUgIoZqSgWruTPCrI9iJVM72IchWPoiolt5kyZjqN');
                    
                        function notify_message($message){
                    
                            $queryData = array('message' => $message);
                            $queryData = http_build_query($queryData,'','&');
                            $headerOptions = array(
                                'http'=>array(
                                    'method'=>'POST',
                                    'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                                            ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                            ."Content-Length: ".strlen($queryData)."\r\n",
                                    'content' => $queryData
                                )
                            );
                            $context = stream_context_create($headerOptions);
                            $result = file_get_contents(LINE_API,FALSE,$context);
                            $res = json_decode($result);
                            return $res;
                    
                        }
                    
                    }
?>