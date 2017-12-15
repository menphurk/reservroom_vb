<?php 
include_once('include/Conn.php');
error_reporting( error_reporting() & ~E_NOTICE );
if(isset($_GET['id_reserv']))
{
    $id_reserv = mysql_real_escape_string($_GET['id_reserv']);

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

    $str_status_reserv = mysql_real_escape_string($_POST['status_reserv']);
    $str_comment_reserv = mysql_real_escape_string($_POST['comment_reserv']);
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

    $check_reserv = "UPDATE `reserv` SET";
    $check_reserv .= " `startday`='".$start_event."' ";
    $check_reserv .= ",`endday`='".$end_event."' ";
    $check_reserv .= ",`starttime`='".$str_starttime."' ";
    $check_reserv .= ",`endtime`='".$str_endtime."'";
    $check_reserv .= ",`id_room`='".$str_room."' ";
    $check_reserv .= ",`id_type`='".$str_typereserv."' ";
    $check_reserv .= ",`topic`='".$str_topic."' ";
    $check_reserv .= ",`desc`='".$str_desc."' ";
    $check_reserv .= ",`num`='".$str_num."' ";
    $check_reserv .= ",`namejoin`='".$str_namejoin."' ";
    $check_reserv .= ",`tel`='".$str_tel."' ";
    $check_reserv .= ",`check_catering`='".$str_check_catering."' ";
    $check_reserv .= ",`txt_catering2`='".$str_txt_catering2."' ";
    $check_reserv .= ",`txt_cateringother`='".$str_txt_cateringother."' ";
    $check_reserv .= ",`check_projector`='".$str_check_projector."' ";
    $check_reserv .= ",`check_screen`='".$str_check_screen."' ";
    $check_reserv .= ",`check_dvd`='".$str_check_dvd."' ";
    $check_reserv .= ",`check_tv`='".$str_check_tv."' ";
    $check_reserv .= ",`check_record`='".$str_check_record."' ";
    $check_reserv .= ",`check_amp`='".$str_check_amp."' ";
    $check_reserv .= ",`check_control`='".$str_check_control."' ";
    $check_reserv .= ",`txt_control`='".$str_txt_control."' ";
    $check_reserv .= ",`check_wireless_mic`='".$str_check_wireless_mic."' ";
    $check_reserv .= ",`txt_wireless_mic`='".$str_txt_wireless_mic."' ";
    $check_reserv .= ",`check_mic`='".$str_check_mic."' ";
    $check_reserv .= ",`txt_mic`='".$str_txt_mic."' ";
    $check_reserv .= ",`check_other`='".$str_check_other."' ";
    $check_reserv .= ",`txt_other`='".$str_txt_other."' ";
    $check_reserv .= ",`update_id`='".$str_update_id."' ";
    $check_reserv .= " WHERE id_reserv='".$id_reserv."'";
    $result_reserv = mysql_query($check_reserv);
    if($result_reserv)
    {
        echo "<script>alert('บันทึกการเปลี่ยนแปลงข้อมูลการจองเรียบร้อยแล้ว');</script>";
        echo "<script>window.location.href='reserv.php'</script>";
    }else
    {
        echo "<script>alert('ไม่สามารถบันทึกการเปลี่ยนแปลงได้ กรุณาลองใหม่อีกครั้ง!');</script>";
        echo "<script>window.history.back();</script>";
    }
}else
{
    echo "test";
}
?>