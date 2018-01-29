
<?php
if(isset($_POST['data']) == 1)
{
 include_once("include/Conn.php");
    $today = DATE('Y-m-d');
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
    $ex_today = explode('-',$today);
    $show_year = $ex_today[0]+543;
    $show_month = $thai_month_arr[$ex_today[1]];
    $show_day = $ex_today[2];
    $show_date = $show_day."/".$show_month."/".$show_year;
    echo "<h2><p class='text-right'>วันนี้ :  $show_date <br>";
    echo "เวลา : <span id='showData'></span>";
    echo "</p>";
    echo "</h2>";

        $sql_room = "SELECT * FROM room";
        $query_room = mysql_query($sql_room);
        while($row_room = mysql_fetch_array($query_room))
        {
            echo "<h1>";
            echo "<i class='fa fa-star' aria-hidden='true'></i>&nbsp;".$row_room['name_room'];
            echo "</h1>";
            echo "<table class='table table-striped table-bordered' cellspacing='0'>";
            echo "<tr>
                <th width='2%'>เลขที่จอง</th>
                <th width='5%'>สถานะ</th>
                <th width='15%'>หัวข้อประชุม</th>
                <th width='10%'>วันที่-เวลาเริ่มต้น</th>
                <th width='10%'>วันที่-เวลาสิ้นสุด</th>
                <th width='10%'>ชื่อผู้จอง</th>
                <th width='10%'>วันที่จอง</th>
                <th width='8%' align='center'>&nbsp;</th>
            </tr>";
            $sql_today = "SELECT * FROM reserv AS rs ";
            $sql_today .= " JOIN users as u on(u.id_user = rs.update_id)";
            $sql_today .= " JOIN title as t on(t.title_id = u.title_id)";
            $sql_today .= " WHERE rs.startday='".$today."' AND rs.id_room='".$row_room['id_room']."' ";
            $query_today = mysql_query($sql_today);
            $num_today = mysql_num_rows($query_today);
            if($num_today == 0)
            {
                echo "<tr>";
                echo "<td colspan='8'><center><font color='red'><h1>ไม่มีรายการจองในวันนี้!</h1></font></td>";
                echo "</tr>";
            }
                while($row_today = mysql_fetch_array($query_today))
                {
                    echo "<tr id='pagination_reserv'>";
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

                    $startday = $row_today['startday'];
                    $ex_startday = explode("-",$startday);
                    $convert_startmonth = $ex_startday[1];
                    $convert_startmonth = $thai_month_arr[$convert_startmonth];
                    $ex_startday[0] = $ex_startday[0]+543;
                    $new_convertstartevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];

                    $endday = $row_today['endday'];
                    $ex_endday = explode("-",$endday);
                    $convert_endmonth = $ex_endday[1];
                    $ex_endday[0] = $ex_endday[0]+543;
                    $convert_endmonth = $thai_month_arr[$convert_endmonth];
                    $new_convertendevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];

                    //ConvertDate&Time Fidle//
                    $createDate = $row_today['create_date'];
                    $ex_createDate = explode(" ",$createDate);
                    //Date//
                    $exp_createDate = explode("-",$ex_createDate[0]);
                    $convert_Datemonth = $thai_month_arr[$exp_createDate[1]];
                    $convert_DateDay = $exp_createDate[2];
                    $convert_DateYear = $exp_createDate[0]+543;
                    $str_connvertDate = $convert_DateDay."-".$convert_Datemonth."-".$convert_DateYear;
                    //Time//
                    $convert_Time = $ex_createDate[1];

                    echo "<td>".$new_convertstartevent."<br>".substr($row_today['starttime'],0,-3)."&nbsp;น.</td>";
                    echo "<td>".$new_convertendevent."<br>".substr($row_today['endtime'],0,-3)."&nbsp;น.</td>";
                    echo "<td>".$row_today['title_name']."&nbsp;".$row_today['name_log']."</td>";
                    echo "<td>".$str_connvertDate."</td>";
                    echo "<td>";
                    echo "<center><button class=\"btn btn-app btn-info btn-xs\" onclick=\"javascript:window.location.href='show_reserv.php?id_reserv=$row_today[id_reserv]'\">
                    <i class=\"ace-icon fa fa-info bigger-120\"></i>ดูข้อมูล</button></center>";
                    echo "</tr>";            
                }
                echo "</table>";
    }

}
?>
