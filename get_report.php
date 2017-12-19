<?php session_start();
include_once("include/Conn.php");
// include_once("Function.php");
//THAIDATE
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
//SQL_GETROOM//
$sql_room = "SELECT * FROM room";
$result_room = mysql_query($sql_room);

//--------///
    if(isset($_REQUEST['startday']) && isset($_REQUEST['endday']))
    {
        $startday = mysql_real_escape_string($_POST['startday']);
        $endday = mysql_real_escape_string($_POST['endday']);
        //--SaveSES--//
        $_SESSION['str_startday'] = $startday;
        $_SESSION['str_endday'] = $endday;

        //----SQL_GETREPORT-----//
        $sql_report = "SELECT ISNULL(r.name_room) AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $sql_report .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $sql_report .= " SUM(TIMEDIFF(MINUTE(endtime),MINUTE(starttime))) AS summinute";
        $sql_report .= " FROM reserv AS rs";
        $sql_report .= " LEFT JOIN room as r ON(r.id_room = rs.id_room)";
        $sql_report .= " WHERE startday >= '".$startday."' ";
        $sql_report .= " AND endday <= '".$endday."'  ";
        $sql_report .= " AND id_status_reserv='2' ";
        $sql_report .= " GROUP BY r.name_room";
        $result_report = mysql_query($sql_report);
        $num_report = mysql_num_rows($result_report);

        if($num_report == 0)
        {
            echo "No Data Report";
        }else
        {

            $ex_startday = explode("-",$startday);
            $convert_startmonth = $ex_startday[1];
            $convert_startmonth = $thai_month_arr[$convert_startmonth];
            $ex_startday[0] = $ex_startday[0]+543;
            $new_convertstartevent = $ex_startday[2]."&nbsp;".$convert_startmonth."&nbsp;".$ex_startday[0];
            
            $ex_endday = explode("-",$endday);
            $convert_endmonth = $ex_endday[1];
            $ex_endday[0] = $ex_endday[0]+543;
            $convert_endmonth = $thai_month_arr[$convert_endmonth];
            $new_convertendevent = $ex_endday[2]."&nbsp;".$convert_endmonth."&nbsp;".$ex_endday[0];
            
            echo "<hr>";
            echo "<div class='col-md-10 col-md-offset-1'>";
            echo "<center>";
            echo "<h2><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
            echo "<br>";
            echo "<font size='4.5em'>ระหว่างวันที่&nbsp;".$new_convertstartevent."&nbsp;ถึงวันที่&nbsp;".$new_convertendevent."</font>";
            echo "</center>";
            echo "<br>";
            echo "<table class='table table-bordered'>";
            echo "<tr class='active'>";
            echo "<td align='center' valign='middle' width='40%' rowspan='2'>ห้องประชุม</td>";
            echo "<td align='center' colspan='3'>การใช้งานห้องประชุม</td>";
            echo "</tr>";
            echo "<tr class='active' align='center'>";
            echo "<td width='10%'>ครั้ง</td>";
            echo "<td width='10%'>ชั่วโมง</td>";
            echo "<td width='10%'>นาที</td>";
            echo "</tr>";
            while($row_report = mysql_fetch_array($result_report))
            {   
                $sumhours = $row_report['sumhours'];
                $summinute = $row_report['summinute'];
                echo "<tr'>";
                echo "<td>".$row_report['nameroom']."</td>";
                echo "<td align='center'>".number_format($row_report['sumtotal'],0)."</td>";
                echo "<td align='center'>".number_format($sumhours,0)."</td>";
                echo "<td align='center'>".number_format($summinute,0)."</td>";
                echo "</tr>";
                //Sum//
                $sum_total = @$sum_total+$row_report['sumtotal'];
                $sum_hours = @$sum_hours+$row_report['sumhours'];
                $sum_minute = @$sum_minute+$row_report['summinute'];
                //Sum//
            }

            echo "<tr class='active' align='center'>";
            echo "<td>รวม</td>";
            echo "<td>".number_format($sum_total,0)."</td>";
            echo "<td>".number_format($sum_hours,0)."</td>";
            echo chkTime(number_format($sum_minute,0));
            echo "<td>".number_format($sum_minute,0)."</td>";
            echo "</tr>";
            echo "</table>";
            $token = md5(uniqid(rand(), true));
            echo "<center><button class=\"btn btn-app btn-pink btn-xs\" onclick=\"window.location.href='export_pdfreport.php?st_day=$_SESSION[str_startday]&en_day=$_SESSION[str_endday]&key=$token'\"><i class=\"ace-icon fa fa-file-pdf-o bigger-160\"></i>Export</button></center>";
            echo "</div>";
        }
    }
    //////report_year/////
    if(isset($_REQUEST['report_txt_year']))
    {
        $txt_year = mysql_real_escape_string($_POST['report_txt_year']);

        //SES_YEAR//
        $_SESSION['str_year'] = $txt_year;
        //---------//
        $str_startday = ($txt_year-1)."-10-01";
        $str_endday = $txt_year."-09-30";
        //SQL_REPORT//
        $sql_year = "SELECT r.name_room AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $sql_year .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $sql_year .= " SUM(TIMEDIFF(MINUTE(starttime),MINUTE(endtime))) AS summinute";
        $sql_year .= " FROM reserv AS rs";
        $sql_year .= " LEFT JOIN room as r ON(r.id_room = rs.id_room)";
        $sql_year .= " WHERE id_status_reserv='2' ";
        $sql_year .= " AND startday >= '$str_startday' AND startday <= '$str_endday' ";
        $sql_year .= " AND endday >= '$str_startday' AND endday <='$str_endday' ";
        $sql_year .= " GROUP BY r.name_room";
        $result_reportYear = mysql_query($sql_year);
        echo $sql_year;
        $num_reportYear = mysql_num_rows($result_reportYear);

        if($num_reportYear == 0)
        {
            echo "No Data Report";
        }else
        {
                echo "<hr>";
                echo "<h2><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
                echo "<br>";
                echo "<font size='4.5em'>ประจำปี&nbsp;".($txt_year+543)."</font>";
                echo "<br><br>";
                echo "<div class='row'>";
                echo "<div class='col-md-8 col-md-offset-2'>";
                echo "<table class='table table-bordered'>";
                echo "<tr class='active'>";
                echo "<td align='center' valign='middle' width='40%' rowspan='2'>ห้องประชุม</td>";
                echo "<td align='center' colspan='3'>การใช้งานห้องประชุม</td>";
                echo "</tr>";
                echo "<tr class='active' align='center'>";
                echo "<td width='10%'>ครั้ง</td>";
                echo "<td width='10%'>ชั่วโมง</td>";
                echo "<td width='10%'>นาที</td>";
                echo "</tr>";
                while($row_reportYear = mysql_fetch_array($result_reportYear)){             
                    echo "<tr>";
                    echo "<td>".$row_reportYear['nameroom']."</td>";
                    echo "<td align='center'>".number_format($row_reportYear['sumtotal'],0)."</td>";
                    echo "<td align='center'>".number_format($row_reportYear['sumhours'],0)."</td>";
                    echo "<td align='center'>".number_format($row_reportYear['summinute'],0)."</td>";
                    echo "</tr>";
                    //Sum//
                    $sum_total = @$sum_total+$row_reportYear['sumtotal'];
                    $sum_hours = @$sum_hours+$row_reportYear['sumhours'];
                    $sum_minute = @$sum_minute+$row_reportYear['summinute'];
                    //Sum//
                }
                echo "<tr class='active' align='center'>";
                echo "<td>รวม</td>";
                echo "<td>".number_format($sum_total,0)."</td>";
                echo "<td>".number_format($sum_hours,0)."</td>"; 
                echo "<td>".number_format($sum_minute,0)."</td>";
                echo "</tr>";
                echo "</table>";
                $token = md5(uniqid(rand(), true));
                echo "<center><button class=\"btn btn-app btn-pink btn-xs\" onclick=\"window.location.href='export_pdfreport.php?st_year=$_SESSION[str_year]&key_year=$token'\"><i class=\"ace-icon fa fa-file-pdf-o bigger-160\"></i>Export</button></center>";
                echo "</div>";
                echo "</div>";
        }
    }
    //////report_month/////
    if(isset($_POST['str_year']) && isset($_POST['str_month']))
    {
        //GET_DATA//
        $str_year = mysql_real_escape_string($_POST['str_year']);
        $str_month = mysql_real_escape_string($_POST['str_month']);

        //SES_YEARANDMONTH//
        $_SESSION['str_year'] = $str_year;
        $_SESSION['str_month'] = $str_month;

        //SQL_REPORT//
        $Sql_report_Month = "SELECT r.name_room AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $Sql_report_Month .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $Sql_report_Month .= " SUM(TIMEDIFF(MINUTE(endtime),MINUTE(starttime))) AS summinute";
        $Sql_report_Month .= " FROM reserv AS rs";
        $Sql_report_Month .= " INNER JOIN room as r ON(r.id_room = rs.id_room)";
        $Sql_report_Month .= " WHERE YEAR(startday) ='".$str_year."' AND MONTH(startday) ='".$str_month."'";
        $Sql_report_Month .= " AND YEAR(endday) = '".$str_year."' AND MONTH(endday) ='".$str_month."'";
        $Sql_report_Month .= " AND id_status_reserv='2' ";
        $Sql_report_Month .= " GROUP BY r.name_room";
        $result_report_Month = mysql_query($Sql_report_Month);
        $num_report_Month = mysql_num_rows($result_report_Month);

        if($num_report_Month == 0)
        {
            echo "No Data Report";
        }else
        {
            echo "<hr>";
            echo "<h2><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
            echo "<br>";
            echo "<font size='4.5em'>ประจำเดือน&nbsp;".$thai_month_arr[$str_month]."&nbsp;".($str_year+543)."</font>";
            echo "<br><br>";
            echo "<div class='row'>";
            echo "<div class='col-md-8 col-md-offset-2'>";
            echo "<table class='table table-bordered'>";
            echo "<tr class='active'>";
            echo "<td align='center' valign='middle' width='40%' rowspan='2'>ห้องประชุม</td>";
            echo "<td align='center' colspan='3'>การใช้งานห้องประชุม</td>";
            echo "</tr>";
            echo "<tr class='active' align='center'>";
            echo "<td width='10%'>ครั้ง</td>";
            echo "<td width='10%'>ชั่วโมง</td>";
            echo "<td width='10%'>นาที</td>";
            echo "</tr>";
            while ($row_report_Month = mysql_fetch_array($result_report_Month)) {
            echo "<tr>";
            echo "<td>".$row_report_Month['nameroom']."</td>";
            echo "<td align='center'>".number_format($row_report_Month['sumtotal'],0)."</td>";
            echo "<td align='center'>".number_format($row_report_Month['sumhours'],0)."</td>";
            echo "<td align='center'>".number_format($row_report_Month['summinute'],0)."</td>";
            echo "</tr>";
                //Sum//
                $sum_total = @$sum_total+$row_report_Month['sumtotal'];
                $sum_hours = @$sum_hours+$row_report_Month['sumhours'];
                $sum_minute = @$sum_minute+$row_report_Month['summinute'];
                //Sum//
            }
            echo "<tr class='active' align='center'>";
            echo "<td>รวม</td>";
            echo "<td>".number_format($sum_total,0)."</td>";
            echo "<td>".number_format($sum_hours,0)."</td>";
            echo "<td>".number_format($sum_minute,0)."</td>";
            echo "</tr>";
            echo "</table>";
            $token = md5(uniqid(rand(), true));
            echo "<center><button class=\"btn btn-app btn-pink btn-xs\" onclick=\"window.location.href='export_pdfreport.php?st_year1=$_SESSION[str_year]&st_month=$_SESSION[str_month]&key_ym=$token'\"><i class=\"ace-icon fa fa-file-pdf-o bigger-160\"></i>Export</button></center>";         
            echo "</div>";
            echo "</div>";
        }
    }
?>
