<?php session_start();?>
<style>
#content_reserv table tr td p
{
    font-size: 1.2em;
    margin-top: 11px;
}
</style>
<?php
    if(isset($_REQUEST['key']) && !empty($_REQUEST['key']))
    {
        require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
        ob_start(); // ทำการเก็บค่า html นะครับ
        include_once('include/Conn.php');
        $stylesheet = file_get_contents('css/mpdfstyletables.css');
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

        $str_data_room = mysql_real_escape_string($_GET['st_room']);
        $str_month_room = mysql_real_escape_string($_GET['st_month']);
        $sqlReportRoom = "SELECT rs.topic as topic,rs.starttime as starttime,rs.endtime as endtime,DAY(startday) AS dayreserv,";
        $sqlReportRoom .= "rs.id_room AS id_room,r.name_room AS name_room,rs.check_projector as check_projector,rs.check_screen as check_screen,rs.check_dvd as check_dvd,rs.check_dvd as check_dvd,rs.check_tv as check_tv,rs.check_record as check_record,";
        $sqlReportRoom .= "rs.check_amp as check_amp,rs.txt_control as txt_control,rs.check_control as check_control,rs.txt_wireless_mic as txt_wireless_mic,rs.check_wireless_mic as check_wireless_mic,rs.txt_mic as txt_mic,rs.check_mic as check_mic,rs.txt_other as txt_other,";
        $sqlReportRoom .= "rs.check_other as check_other,rs.check_catering AS check_catering,rs.txt_catering2 AS txt_catering2,rs.txt_cateringother AS txt_cateringother,rs.num AS num,tr.name_table AS name_table,u.name_log as namelog ";
        $sqlReportRoom .= " FROM reserv as rs";
        $sqlReportRoom .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
        $sqlReportRoom .= " JOIN users as u on(u.id_user = rs.update_id)";
        $sqlReportRoom .= " JOIN title as t on(t.title_id = u.title_id)";
        $sqlReportRoom .= " LEFT JOIN table_reserv as tr on(tr.id = rs.id_table_reserv)";
        $sqlReportRoom .= " WHERE id_status_reserv = '2'";
        $sqlReportRoom .= " AND MONTH(startday) = '".$str_month_room."' AND MONTH(endday) = '".$str_month_room."' ";
        if($str_data_room != "")
        {
            $sqlReportRoom .= " AND rs.id_room = '".$str_data_room."'";
        }
        $sqlReportRoom .= " ORDER by MONTH(startday) DESC";
        $queryReportRoom = mysql_query($sqlReportRoom);
        $countReportRoom = mysql_num_rows($queryReportRoom);
        if($countReportRoom == 0)
        {
            echo "Nodata Reserv";
        }else
        {
        
            $dayname=array(0=>'อาทิตย์',1=>'จันทร์',2=>'อังคาร',3=>'พุธ',4=>'พฤหัสบดี',5=>'ศุกร์',6=>'เสาร์');
            $month_name=array(1=>'มกราคม',2=>'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฎาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
            $date_year = date("Y");
            $str_merch_date = $date_year.'-'.$str_month_room;
            $sp_m_y=explode('-',$str_merch_date);//แยกค่าเดือน/ปี ออกจากกันโดยใช้ แบ่งตามเครื่องหมาย "-" จะได้ $sp_m_y[0]=ปี,$sp_m_y[1]=เดือน
            $nextMonth=date('Y-n', mktime(0,0,0,($sp_m_y[1]+1),1,$sp_m_y[0]));
            $prevMonth=date('Y-n',mktime(0,0,0,($sp_m_y[1]-1),1,$sp_m_y[0]));
            $fistday=date('w',strtotime( $str_merch_date.'-1' ));
            $numsday=date('t',strtotime($str_merch_date));
            $tday1=$fistday+$numsday;
            $tday2=ceil($tday1/7)*7;
            echo "<center>";
            echo "<div style='text-align: center'><img style='text-align:center;' src='images/logo_vb.png'></div>";
            echo "<h2 style='text-align:center;font-size:18pt;'>รายการจองห้องประชุม</h2>";
            echo "</center>";
            if($str_data_room == 'RVB00001')
            {
                $str_room = "ห้องรับรองใหญ่";
            }else if($str_data_room == 'RVB00002')
            {
                $str_room = "ห้องกิจกรรมอาสากาชาด ชั้น 2";
            }else if($str_data_room == 'RVB00003')
            {
                $str_room = "ห้องรับรองเล็ก";
            }else if($str_data_room == 'RVB00004')
            {
                $str_room = "ห้องประชุม ชั้น 4";
            }else if($str_data_room == 'RVB00005')
            {
                $str_room = "ห้องศูนย์สมรรถนะการคิดเด็ก ชั้น 2";
            }else
            {
                $str_room = "";
            }
        
            echo '<center>';
            echo "<h2 style='text-align:center;font-size:18pt;'>".$str_room."</h2>";
            echo '</center>';
            echo "<table width='1000px' style='border:2px solid #000000;' cellPadding='9'>";
            echo "<tr style='border:2px solid #000000;font-size:25pt;background-color:#DCDCDC'><td colspan='7'>";
            echo "<center><div style='text-align:center;font-size:50;font-weight:bold'>&nbsp;เดือน".$month_name[$sp_m_y[1]*1]."ปี ".($sp_m_y[0]+543)."</div></center>";
            echo "</tr>";
            echo "<tr style='border:2px solid #000000;font-size:20;background-color:#ffffff;'>";
            foreach($dayname as $val){
                echo "<td style='border:2px solid #000000;font-size:42;background-color:#BEBEBE;font-weight:bold'>".$val."</td>";
            }
            echo '</tr>';
            for($i=1;$i <=$tday2;$i++){
                if($i%7==1){echo "<tr style='border:1px solid #000000;font-size:40;background-color:#ffffff;'>";}
                $dayreal=($i-$fistday>=1&&$i-$fistday<=$numsday)?$i-$fistday:'';
                // $today=date('Y-n-j')==$m_y.'-'.($i-$fistday)?'class="success"':'';
                // echo $today;
                echo "<td style='border:1px solid #000000;font-size:40px;background-color:#ffffff;'>";
                echo $dayreal;
                echo "<br>";
                while($row_reportReserv = mysql_fetch_array($queryReportRoom))
                {
                    $reportReserv[] = $row_reportReserv;
                }
                foreach($reportReserv as $value_report)
                {
                    if($dayreal == $value_report['dayreserv'])
                    {
                        echo "-".$value_report['topic']."&nbsp;<strong>(".substr($value_report['starttime'],0,-3)."-".substr($value_report['endtime'],0,-3)."น.)</strong><br>";
                    }
                }
                echo '</td>';
                if($i%7==0){
                    echo '</tr>';
                }
            }
            //echo '<tr><td colspan="7" id="ft_calendar"><a href="calendar.php?m_y='.date('Y-n').'" id="go_calendar">เดือนปัจจุบัน</a></td></tr>';
            echo '</table>';
        
            echo "มีทั้งหมด&nbsp;<strong>".$countReportRoom."</strong>&nbsp;รายการ";
        
        }

    }
    $html = ob_get_contents();
    ob_end_clean();
    
    $date_month_str = $month_name[$sp_m_y[1]*1];
    $pdf = new mPDF('utf-8', 'A4-L', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
    $pdf->SetAutoFont();
    $pdf->SetTitle("รายการจองห้องประชุม ประจำเดือน $date_month_str-$str_room");
    $pdf->WriteHTML($stylesheet,1);
    $pdf->WriteHTML($html,2);
    //$pdf->Output();
    $pdf->Output("รายการจองห้องประชุม ประจำเดือน $date_month_str-$str_room.pdf",'D');
    ?>