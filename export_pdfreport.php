<?php include_once("include/Conn.php");
    require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
    ob_start(); // ทำการเก็บค่า html นะครับ
    $stylesheet = file_get_contents('css/mpdfstyletables.css');
//THAIDATE//
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
//----------//

    if(isset($_REQUEST['key']) && !empty($_REQUEST['key']))
    {

        $startday = mysql_real_escape_string($_REQUEST['st_day']);
        $endday = mysql_real_escape_string($_REQUEST['en_day']);

        //----SQL_GETREPORT-----//
        $sql_report = "SELECT r.name_room AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $sql_report .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $sql_report .= " SUM(TIMEDIFF(MINUTE(endtime),MINUTE(starttime))) AS summinute";
        $sql_report .= " FROM reserv AS rs";
        $sql_report .= " LEFT JOIN room as r ON(r.id_room = rs.id_room)";
        $sql_report .= " WHERE startday >= '".$startday."' ";
        $sql_report .= " AND endday <= '".$endday."'  ";
        $sql_report .= " GROUP BY r.name_room";
        $result_report = mysql_query($sql_report);
        $num_report = mysql_num_rows($result_report);

                $ex_startday = explode("-",$startday);
                $convert_startmonth = $ex_startday[1];
                $convert_startmonth = $thai_month_arr[$convert_startmonth];
                $ex_startday[0] = $ex_startday[0]+543;
                $new_convertstartevent = $ex_startday[2]."&nbsp;".$convert_startmonth."&nbsp;".$ex_startday[0];
                //----//
                $pdf_startevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];
                
                $ex_endday = explode("-",$endday);
                $convert_endmonth = $ex_endday[1];
                $ex_endday[0] = $ex_endday[0]+543;
                $convert_endmonth = $thai_month_arr[$convert_endmonth];
                $new_convertendevent = $ex_endday[2]."&nbsp;".$convert_endmonth."&nbsp;".$ex_endday[0];
                //----//
                $pdf_endevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];            
            echo "<div style=\"text-align: center\"><img style=\"text-align:center;\" src=\"images/logo_vb.png\"></div>";
            echo "<h2 style=\"text-align:center;font-size:15pt;\"><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
            echo "<br>";
            echo "<div style=\"text-align: center\">ระหว่างวันที่&nbsp;<strong><ins>".$new_convertstartevent."</ins></strong>&nbsp;ถึงวันที่&nbsp;<strong><ins>".$new_convertendevent."</ins></strong></div>";
            echo "<br>";
            echo "<table style=\"border:2px solid #000000;font-size:12pt;width: 100%\" cellPadding=\"9\">";
            echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
            echo "<td align=\"center\" valign=\"middle\" style=\"width: 10%;border:1px solid #000000;text-align:center;\" rowspan=\"2\"><strong>ห้องประชุม</strong></td>";
            echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\" colspan=\"3\"><strong>การใช้งานห้องประชุม</strong></td>";
            echo "</tr>";
            echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
            echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ครั้ง</td>";
            echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ชั่วโมง</td>";
            echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">นาที</td>";
            echo "</tr>";
            while($row_report = mysql_fetch_array($result_report))
            {                
                echo "<tr style=\"border:1px solid #000000;font-size:12pt;\">";
                echo "<td style=\"border:1px solid #000000;\">".$row_report['nameroom']."</td>";
                echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_report['sumtotal'],0)."</td>";
                echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_report['sumhours'],0)."</td>";
                echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_report['summinute'],0)."</td>";
                echo "</tr>";
                //Sum//
                $sum_total = $sum_total+$row_report['sumtotal'];
                $sum_hours = $sum_hours+$row_report['sumhours'];
                $sum_minute = $sum_minute+$row_report['summinute'];
                //Sum//
            }
            echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
            echo "<td style=\"border:1px solid #000000;text-align:center;\">รวม</td>";
            echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_total,0)."</td>";
            echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_hours,0)."</td>";
            echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_minute,0)."</td>";
            echo "</tr>";
            echo "</table>";
    $html = ob_get_contents();
    ob_end_clean();
    $pdf = new mPDF('utf-8', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
    $pdf->SetAutoFont();
    $pdf->SetTitle('รายงานจองใช้ห้องประชุม สำนักงานอาสากาชาด');
    $pdf->WriteHTML($stylesheet,1);
    $pdf->WriteHTML($html,2);
    //$pdf->Output();
    $pdf->Output("reportroom_$pdf_startevent-ถึง-$pdf_endevent.pdf",'D');

    }
    //ExportYear//
    if(isset($_GET['st_year']) && !empty($_GET['key_year']))
    {
        $str_year = mysql_real_escape_string($_GET['st_year']);

        $sql_year = "SELECT r.name_room AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $sql_year .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $sql_year .= " SUM(TIMEDIFF(MINUTE(endtime),MINUTE(starttime))) AS summinute";
        $sql_year .= " FROM reserv AS rs";
        $sql_year .= " LEFT JOIN room as r ON(r.id_room = rs.id_room)";
        $sql_year .= " WHERE YEAR(startday) ='".$str_year."' OR YEAR(endday)='".$str_year."'";
        $sql_year .= " GROUP BY r.name_room";
        $result_reportYear = mysql_query($sql_year);

        echo "<div style=\"text-align: center\"><img style=\"text-align:center;\" src=\"images/logo_vb.png\"></div>";
        echo "<h2 style=\"text-align:center;font-size:15pt;\"><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
        echo "<br>";
        echo "<div style=\"text-align: center;font-size:13pt\"><strong><ins>ประจำปี&nbsp;".($str_year+543)."</ins></strong></div>";
        echo "<br><br>";
        echo "<table style=\"border:2px solid #000000;font-size:12pt;width: 100%\" cellPadding=\"9\">";
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td align=\"center\" valign=\"middle\" style=\"width: 10%;border:1px solid #000000;text-align:center;\" rowspan=\"2\"><strong>ห้องประชุม</strong></td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\" colspan=\"3\"><strong>การใช้งานห้องประชุม</strong></td>";
        echo "</tr>";
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ครั้ง</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ชั่วโมง</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">นาที</td>";
        echo "</tr>";
        while($row_reportYear = mysql_fetch_array($result_reportYear)){
        echo "<tr>";
        echo "<td style=\"border:1px solid #000000;\">$row_reportYear[nameroom]</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_reportYear['sumtotal'],0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_reportYear['sumhours'],0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($row_reportYear['summinute'],0)."</td>";
        echo "</tr>";
                //total
                $sum_total = $sum_total+$row_reportYear['sumtotal'];
                $sum_hours = $sum_hours+$row_reportYear['sumhours'];
                $sum_minute = $sum_minute+$row_reportYear['summinute'];
                //
        }
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">รวม</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_total,0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_hours,0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_minute,0)."</td>";
        echo "</tr>";
        echo "</table>";

        $html = ob_get_contents();
        ob_end_clean();
        $pdf = new mPDF('utf-8', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
        $pdf->SetAutoFont();
        $pdf->SetTitle('รายงานจองใช้ห้องประชุม สำนักงานอาสากาชาด');
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);
        //$pdf->Output();
        $name_filePdf = $str_year+543;
        $pdf->Output("reportroom_$name_filePdf.pdf",'D');
    }



    //ExportMonth//
    if(isset($_GET['st_year1']) && isset($_GET['st_month']) && !empty($_GET['key_ym']))
    {
        $str_year1 = mysql_real_escape_string($_GET['st_year1']);
        $str_month = mysql_real_escape_string($_GET['st_month']);


        $Sql_report_Month = "SELECT r.name_room AS nameroom,COUNT(id_reserv) AS sumtotal,";
        $Sql_report_Month .= " SUM(TIMEDIFF(HOUR(endtime),HOUR(starttime))) AS sumhours,";
        $Sql_report_Month .= " SUM(TIMEDIFF(MINUTE(endtime),MINUTE(starttime))) AS summinute";
        $Sql_report_Month .= " FROM reserv AS rs";
        $Sql_report_Month .= " INNER JOIN room as r ON(r.id_room = rs.id_room)";
        $Sql_report_Month .= " WHERE YEAR(startday) ='".$str_year1."' AND MONTH(startday) ='".$str_month."'";
        $Sql_report_Month .= " AND YEAR(endday) = '".$str_year1."' AND MONTH(endday) ='".$str_month."'";
        $Sql_report_Month .= " GROUP BY r.name_room";
        $result_report_Month = mysql_query($Sql_report_Month);

        echo "<div style=\"text-align: center\"><img style=\"text-align:center;\" src=\"images/logo_vb.png\"></div>";
        echo "<h2 style=\"text-align:center;font-size:15pt;\"><strong>รายงานการใช้ห้องประชุม สำนักงานอาสากาชาด</strong></h2>";
        echo "<br>";
        echo "<div style=\"text-align: center;font-size:13pt\"><strong><ins>ประจำเดือน&nbsp;".$thai_month_arr[$str_month]."&nbsp;".($str_year1+543)."</strong></ins></div>";
        echo "<br><br>";
        echo "<table style=\"border:2px solid #000000;font-size:12pt;width: 100%\" cellPadding=\"9\">";
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td align=\"center\" valign=\"middle\" style=\"width: 10%;border:1px solid #000000;text-align:center;\" rowspan=\"2\"><strong>ห้องประชุม</strong></td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\" colspan=\"3\"><strong>การใช้งานห้องประชุม</strong></td>";
        echo "</tr>";
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ครั้ง</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">ชั่วโมง</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">นาที</td>";
        echo "</tr>";
        while ($row_report_Month = mysql_fetch_array($result_report_Month)) {
        echo "<tr>";
        echo "<td style=\"width: 10%;border:1px solid #000000;\">$row_report_Month[nameroom]</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">".number_format($row_report_Month['sumtotal'],0)."</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">".number_format($row_report_Month['sumhours'],0)."</td>";
        echo "<td style=\"width: 10%;border:1px solid #000000;text-align:center;\">".number_format($row_report_Month['summinute'],0)."</td>";
        echo "</tr>";
            //--Total--//
            $sum_total = $sum_total+$row_report_Month['sumtotal'];
            $sum_hours = $sum_hours+$row_report_Month['sumhours'];
            $sum_minute = $sum_minute+$row_report_Month['summinute'];
            //---//            
        }
        echo "<tr style=\"border:1px solid #000000;font-size:12pt;background-color:#DCDCDC;\">";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">รวม</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_total,0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_hours,0)."</td>";
        echo "<td style=\"border:1px solid #000000;text-align:center;\">".number_format($sum_minute,0)."</td>";
        echo "</tr>";
        echo "</table>";

        $html = ob_get_contents();
        ob_end_clean();
        $pdf = new mPDF('utf-8', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
        $pdf->SetAutoFont();
        $pdf->SetTitle('รายงานจองใช้ห้องประชุม สำนักงานอาสากาชาด');
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);
        //$pdf->Output();
        $name_filePdf = $str_year1+543;
        $pdf->Output("reportroom_$thai_month_arr[$str_month]-$name_filePdf.pdf",'D');
    }

?>
