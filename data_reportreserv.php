<?php 
include_once('include/Conn.php');
$thai_month_arr=array(
    "00"=>"",
    "01"=>"มกราคม",
    "02"=>"กุมภาพันธ์",
    "03"=>"มีนาคม",
    "04"=>"เมษายน",
    "05"=>"พฤษภาคม",
    "06"=>"มิถุนายน", 
    "07"=>"กรกฎาคม",
    "08"=>"สิงหาคม",
    "09"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
$str_data_month = mysql_real_escape_string($_GET['data_month']);
$sql_reportReserv = "SELECT * FROM reserv as rs";
$sql_reportReserv .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
$sql_reportReserv .= " JOIN users as u on(u.id_user = rs.update_id)";
$sql_reportReserv .= " JOIN title as t on(t.title_id = u.title_id)";
$sql_reportReserv .= " WHERE id_status_reserv != '3'";
$sql_reportReserv .= " AND MONTH(startday) = '".$str_data_month."' AND MONTH(endday) ='".$str_data_month."'";
$sql_reportReserv .= " ORDER by MONTH(startday) DESC";
$query_reportReserv = mysql_query($sql_reportReserv);
    echo "<table class='table table-bordered table-condensed'>";

    $date_month = $thai_month_arr[$str_data_month];
    echo "<tr>";
    echo "<td align='center'><h2>".$date_month."</h2></td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>".$date_month."</td>";
    echo "</tr>";
while($row_reportReserv = mysql_fetch_array($query_reportReserv))
{
    echo "<tr>";
    echo "<td>&nbsp;<strong>เรื่อง :</strong> ".$row_reportReserv['topic']."&nbsp;<strong>เวลา</strong>&nbsp;".$row_reportReserv['starttime']."&nbsp;ถึง&nbsp;".$row_reportReserv['endtime']."</td>";
    echo "</tr>";
}
    echo "</table>";


$month = $str_data_month;
$year = date("Y");
// วันต้นเดือน (วันที่ 1)
$first_day = mktime(0, 0, 0, $month, 1, $year);
// วันสิ้นเดือน คำนวณจากวันต้นเดือน
$last_day = mktime(23, 59, 59, $month, date('t', $first_day), date('Y', $first_day));
// แสดงผล
echo 'ต้นเดือน '.date('d', $first_day);
echo '<br>สิ้นเดือน '.date('d', $last_day);

?>
