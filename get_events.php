<?php


/*
$array = array(
            array('title'=> 'Long Event',
                    'start'=> '2015-02-07',
                    'end'=> '2015-02-10'),
            array('id'=> 999,
                    'title'=> 'Repeating Event',
                    'start'=> '2015-02-16T16:00:00')
         );
         */
include_once('include/Conn.php');

$get_calendar = "SELECT * FROM reserv ORDER BY id";
if ($result_calendar = mysql_query($get_calendar)) {
    while ($obj_calendar = mysql_fetch_array($result_calendar)) {

        if($obj_calendar['id_room'] == "RVB00001")
        {
            $color = "#5cb85c";
        }
        if($obj_calendar['id_room'] == "RVB00002")
        {
            $color = "#5bc0de";
        }
        if($obj_calendar['id_room'] == "RVB00003")
        {
            $color = "#f0ad4e";
        }
        if($obj_calendar['id_room'] == "RVB00004")
        {
            $color = "#d9534f";
        }
        if($obj_calendar['id_room'] == "RVB00005")
        {
            $color = "#428bca";
        }

       $data_event[] = array(
            'id' => $obj_calendar['id'],
            'title' => $obj_calendar['title'],
            'start' => $obj_calendar['start']."T".$obj_calendar['starttime'],
            'end' => $obj_calendar['end']."T".$obj_calendar['endtime'],
            // 'url' => "javascript:get_model('$obj_calendar[id]');",
            // 'color' => $color,
     );
    }
    echo json_encode($data_event);
}
?>