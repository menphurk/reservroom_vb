 <?php
header("Content-type:application/json; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);
error_reporting( error_reporting() & ~E_NOTICE );
include_once('include/Conn.php');
$get_calendar = "SELECT * FROM reserv as rs";
$get_calendar .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
$get_calendar .= " JOIN users as u on(u.id_user = rs.update_id)";
$get_calendar .= " JOIN title as t on(t.title_id = u.title_id)";
$get_calendar .= " WHERE id_status_reserv != '3' ";
$get_calendar .= " ORDER by id_reserv DESC";
if ($result_calendar = mysql_query($get_calendar)) {
    while ($obj_calendar = mysql_fetch_array($result_calendar)) {

        if($obj_calendar['id_room'] == "RVB00001")
        {
            $className = "room1";
        }
        if($obj_calendar['id_room'] == "RVB00002")
        {
            $className = "room2";
        }
        if($obj_calendar['id_room'] == "RVB00003")
        {
            $className = "room3";
        }
        if($obj_calendar['id_room'] == "RVB00004")
        {
            $className = "room4";
        }
        if($obj_calendar['id_room'] == "RVB00005")
        {
            $className = "room5";
        }

        $startday = $obj_calendar['startday'];
        $str_exstart = explode("-",$startday);
        $startyear = $str_exstart[0];
        $convert_startday = $startyear."-".$str_exstart[1]."-".$str_exstart[2];

        $endday = $obj_calendar['endday'];
        $str_exend = explode("-",$endday);
        $endyear = $str_exend[0];
        $convert_endday = $endyear."-".$str_exend[1]."-".$str_exend[2];

       $data_event[] = array(
            'id' => $obj_calendar['id_reserv'],
            'title' => $obj_calendar['topic'],
            'desc' => $obj_calendar['desc'],
            'start' => $convert_startday." ".$obj_calendar['starttime'],
            'end' => $convert_endday." ".$obj_calendar['endtime'],
            'className' => $className,
            'url' => 'show_reserv.php?id_reserv='.$obj_calendar['id_reserv'],
            'id_room' => $obj_calendar['id_room'],
            'room' => $obj_calendar['name_room'],
            'name' => $obj_calendar['title_name']." ".$obj_calendar['name_log'],
     );

    }
    echo json_encode($data_event);
}
?> 