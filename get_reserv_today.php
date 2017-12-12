<!--//ห้องประชุมเล็ก//-->
<?php
if(isset($_POST['data']) == 1)
{
?>
<table class="table table-striped table-bordered" cellspacing="0">
        <tr>
            <th width="2%">เลขที่จอง</th>
            <th width="5%">สถานะ</th>
            <th width="15%">หัวข้อประชุม</th>
            <th width="15%">ห้องประชุม</th>
            <th width="10%">วันที่-เวลาจอง</th>
            <th width="10%">วันที่-เวลาสิ้นสุด</th>
            <th width="8%">ชื่อผู้จอง</th>
            <th width="8%" align="center">&nbsp;</th>
        </tr>
<?php include_once("include/Conn.php");
    $today = DATE('Y-m-d');
    $event_today = "SELECT * FROM reserv WHERE id_status_reserv='2' AND startday='".$today."'";
    //echo $event_today;
    $query_today = mysql_query($event_today);
    $num_event = mysql_num_rows($query_today);
    if($num_event == 0)
    {
        echo "<tr><td colspan='8' align='center'><font color='#d9534f' size='5px'>ไม่มีข้อมูลในระบบ!</font></td></tr>";
    }
    while($row_today = mysql_fetch_array($query_today))
    {
        echo "<tr>";
        echo "<td>".$row_today['id_reserv']."</td>";
        echo "<td>";
        if($row_today['id_status_reserv'] == '1'){
            echo "<font color='#A0522D'>ไม่อนุมัติ</font>";
        }else if($row_today['id_status_reserv'] == '2')
        {
            echo "<font color='#5cb85c'>อนุมัติ</font>";
        }else if($row_today['id_status_reserv'] == '3')
        {
            echo "<font color='#d9534f'>ยกเลิก</font>";
        }
        echo "</td>";
        echo "<td>".$row_today['topic']."</td>";
        echo "<td>".$row_today['name_room']."</td>";

        $startday = $row_today['startday'];
        $ex_startday = explode("-",$startday);
        $convert_startmonth = $ex_startday[1];
        $convert_startmonth = $thai_month_arr[$convert_startmonth];
        $ex_startday[0] = $ex_startday[0]+543;
        $new_convertstartevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];

        $endday = $row_event['endday'];
        $ex_endday = explode("-",$endday);
        $convert_endmonth = $ex_endday[1];
        $ex_endday[0] = $ex_endday[0]+543;
        $convert_endmonth = $thai_month_arr[$convert_endmonth];
        $new_convertendevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];


        echo "<td>".$new_convertstartevent."<br>".substr($row_today['starttime'],0,-3)."&nbsp;น.</td>";
        echo "<td>".$new_convertendevent."<br>".substr($row_today['endtime'],0,-3)."&nbsp;น.</td>";
        echo "<td>".$row_today['name_log']."</td>";
        echo "<td>";
        echo "<center><button class=\"btn btn-app btn-info btn-xs\" onclick=\"javascript:window.location.href='show_reserv.php?id_reserv=$row_today[id_reserv]'\">
        <i class=\"ace-icon fa fa-info bigger-120\"></i>ดูข้อมูล</button></center>";
        echo "</tr>";        
    }
}
?>
</table>