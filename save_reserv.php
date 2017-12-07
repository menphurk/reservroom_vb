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
            ";
            $result_checkRoom = mysql_query($check_room);
            $num_checkRoom = mysql_num_rows($result_checkRoom);
            if($num_checkRoom >= 1)
            {
                echo "<script>alert('ไม่สามารถจองห้องได้ เนื่องจากห้องถูกจองใช้งานไปแล้ว กรุณาเลือกเวลาจองอื่นๆ')</script>";
                echo "<meta http-equiv='refresh' content='0;url=create_reserv.php';>";
            }else
            {
                $str_insertevent = "INSERT INTO `reserv`(`id_reserv`, `startday`, `endday`, `starttime`, `endtime`, `id_room`, `id_type`, `topic`, `desc`, `num`, `namejoin`, `tel`, `check_catering`, `txt_catering2`, `txt_cateringother`, `check_projector`, `check_screen`, `check_dvd`, `check_tv`, `check_record`, `check_amp`, `check_control`, `txt_control`, `check_wireless_mic`, `txt_wireless_mic`, `check_mic`, `txt_mic`, `check_other`, `txt_other`,`status_reserv`, `create_date`, `update_id`)";
                $str_insertevent .= "VALUES ('".$nextId."','".$start_event."','".$end_event."','".$str_starttime."','".$str_endtime."','".$str_room."','".$str_typereserv."','".$str_topic."','".$str_desc."','".$str_num."','".$str_namejoin."','".$str_tel."','".$str_check_catering."','".$str_txt_catering2."','".$str_txt_cateringother."','".$str_check_projector."','".$str_check_screen."','".$str_check_dvd."','".$str_check_tv."','".$str_check_record."','".$str_check_amp."','".$str_check_control."','".$str_txt_control."','".$str_check_wireless_mic."','".$str_txt_wireless_mic."','".$str_check_mic."','".$str_txt_mic."','".$str_check_other."','".$str_txt_other."','no',NOW(),'".$str_update_id."')";
                $result_insertevent = mysql_query($str_insertevent);
                if($result_insertevent)
                {
                    echo "<script>alert('จองห้องเรียบร้อยแล้ว')</script>";
                    $showdata_event = "SELECT * FROM reserv WHERE id_reserv='".$nextId."'";
                    $resultdata_event = mysql_query($showdata_event);
                    $rowdata_event = mysql_fetch_array($resultdata_event);
                    echo "<meta http-equiv='refresh' content='0;url=show_reserv.php?id_reserv=$rowdata_event[id_reserv]';>";
                }else
                {
                    echo "<script>alert('เกิดข้อผิดพลาดในการจองห้อง กรุณาลองใหม่อีกครั้ง!')</script>";
                    echo "<script>window.history.back();</script>";                    
                }
            }
}
//----------------------------------//
// if(isset($_POST['btn_reserv']))
// {
//         //RUNRESERV//
//         $CodeReserv = "VBR";
        
//             $sql = "SELECT MAX(id_reserv) AS lastid FROM reserv";
//             $q = mysql_query($sql);
//             $row = mysql_fetch_array($q);
//             $maxId = substr($row['lastid'],-5);
//             $maxId = ($maxId + 1);
//             $maxId = substr("00000".$maxId,-5);
//             $nextId = $CodeReserv.$maxId;
//             //--RUNRESERV--//
        
//             $str_startday = mysql_real_escape_string($_POST['startday']);
//             $str_startmonth = mysql_real_escape_string($_POST['startmonth']);
//             $str_startyear = mysql_real_escape_string($_POST['startyear']);
        
//             $start_event = ($str_startyear-543)."-".$str_startmonth."-".$str_startday;
        
//             $str_starttime = mysql_real_escape_string($_POST['starttime']);
        
//             $str_endday = mysql_real_escape_string($_POST['endday']);
//             $str_endmonth = mysql_real_escape_string($_POST['endmonth']);
//             $str_endyear = mysql_real_escape_string($_POST['endyear']);
//             $end_event = ($str_endyear-543)."-".$str_endmonth."-".$str_endday;
        
//             $str_endtime = mysql_real_escape_string($_POST['endtime']);
        
//             $str_room = mysql_real_escape_string($_POST['room']);
//             $str_typereserv = mysql_real_escape_string($_POST['typereserv']);
//             $str_topic = mysql_real_escape_string($_POST['topic']);
//             $str_desc = mysql_real_escape_string($_POST['desc']);
//             $str_num = mysql_real_escape_string($_POST['num']);
//             $str_namejoin = mysql_real_escape_string($_POST['namejoin']);
//             $str_tel = mysql_real_escape_string($_POST['tel']);
//             $str_check_catering = mysql_real_escape_string($_POST['check_catering']);
//             $str_txt_catering2 = mysql_real_escape_string($_POST['txt_catering2']);
//             $str_txt_cateringother = mysql_real_escape_string($_POST['txt_cateringother']);
//             $str_check_projector = mysql_real_escape_string($_POST['check_projector']);
//             $str_check_screen = mysql_real_escape_string($_POST['check_screen']);
//             $str_check_dvd = mysql_real_escape_string($_POST['check_dvd']);
//             $str_check_tv = mysql_real_escape_string($_POST['check_tv']);
//             $str_check_record = mysql_real_escape_string($_POST['check_record']);
//             $str_check_amp = mysql_real_escape_string($_POST['check_amp']);
//             $str_check_control = mysql_real_escape_string($_POST['check_control']);
//             $str_txt_control = mysql_real_escape_string($_POST['txt_control']);
//             $str_check_wireless_mic = mysql_real_escape_string($_POST['check_wireless_mic']);
//             $str_txt_wireless_mic = mysql_real_escape_string($_POST['txt_wireless_mic']);
//             $str_check_mic = mysql_real_escape_string($_POST['check_mic']);
//             $str_txt_mic = mysql_real_escape_string($_POST['txt_mic']);
//             $str_check_other = mysql_real_escape_string($_POST['check_other']);
//             $str_txt_other = mysql_real_escape_string($_POST['txt_other']);
//             $str_name = mysql_real_escape_string($_POST['name_create']);
//             $str_group_name = mysql_real_escape_string($_POST['group_name']);
//             //------CheckRoom---//
//                 $check_room = " SELECT * FROM reserv WHERE id_room ='".$str_room."' 
//                 AND startday BETWEEN '".$start_event."' AND '".$end_event."'
//                 AND endday BETWEEN '".$start_event."' AND '".$end_event."' 
//                 AND (
//                     (starttime BETWEEN '".$str_starttime."' AND '".$str_endtime."')
//                     OR 
//                     (endtime BETWEEN '".$str_starttime."' AND '".$str_endtime."')
//                     OR
//                     ('".$str_starttime."' BETWEEN starttime AND endtime)
//                     OR
//                     ('".$str_endtime."' BETWEEN starttime AND endtime) 
//                 )";
//                 $result_checkRoom = mysql_query($check_room);
//                 $row_checkRoom = mysql_fetch_array($result_checkRoom);
//                 if($row_checkRoom)
//                 {
//                     echo "<script>alert('ไม่สามารถจองห้องได้ เนื่องจากห้องถูกจองใช้งานไปแล้ว กรุณาเลือกเวลาจองอื่นๆ')</script>";
//                     echo "<meta http-equiv='refresh' content='0;url=create_reserv.php';>";
//                 }else
//                 {
//                         $str_insertevent = "INSERT INTO `reserv`(`id_reserv`, `startday`, `endday`, `starttime`, `endtime`, `id_room`, `id_type`, `topic`, `desc`, `num`, `namejoin`, `tel`, `check_catering`, `txt_catering2`, `txt_cateringother`, `check_projector`, `check_screen`, `check_dvd`, `check_tv`, `check_record`, `check_amp`, `check_control`, `txt_control`, `check_wireless_mic`, `txt_wireless_mic`, `check_mic`, `txt_mic`, `check_other`, `txt_other`,`status_reserv`, `create_date`, `name_create`,`group_name`, `update_id`)";
//                         $str_insertevent .= "VALUES ('".$nextId."','".$start_event."','".$end_event."','".$str_starttime."','".$str_endtime."','".$str_room."','".$str_typereserv."','".$str_topic."','".$str_desc."','".$str_num."','".$str_namejoin."','".$str_tel."','".$str_check_catering."','".$str_txt_catering2."','".$str_txt_cateringother."','".$str_check_projector."','".$str_check_screen."','".$str_check_dvd."','".$str_check_tv."','".$str_check_record."','".$str_check_amp."','".$str_check_control."','".$str_txt_control."','".$str_check_wireless_mic."','".$str_txt_wireless_mic."','".$str_check_mic."','".$str_txt_mic."','".$str_check_other."','".$str_txt_other."','0',NOW(),'".$str_name."','".$str_group_name."','0')";
//                         $result_insertevent = mysql_query($str_insertevent);
//                         if($result_insertevent)
//                         {
//                             echo "<script>alert('จองห้องเรียบร้อยแล้ว')</script>";
//                             echo "<meta http-equiv='refresh' content='0;url=add_reserv.php';>";
//                         }
//                 }    
// }
//----------------------------------//
?>
<?php
include_once('layout/footer.php');
?>