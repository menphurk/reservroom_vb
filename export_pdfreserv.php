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
        $str_data_month = mysql_real_escape_string($_REQUEST['st_month']);
        $str_data_year = mysql_real_escape_string($_REQUEST['st_year']);
        $str_data_room = mysql_real_escape_string($_REQUEST['st_room']);
        $sql_reportReserv = "SELECT rs.topic as topic,rs.starttime as starttime,rs.endtime as endtime,DAY(startday) AS dayreserv,";
        $sql_reportReserv .= "rs.id_room AS id_room,r.name_room AS name_room,rs.check_projector as check_projector,rs.check_screen as check_screen,rs.check_dvd as check_dvd,rs.check_dvd as check_dvd,rs.check_tv as check_tv,rs.check_record as check_record,";
        $sql_reportReserv .= "rs.check_amp as check_amp,rs.txt_control as txt_control,rs.check_control as check_control,rs.txt_wireless_mic as txt_wireless_mic,rs.check_wireless_mic as check_wireless_mic,rs.txt_mic as txt_mic,rs.check_mic as check_mic,rs.txt_other as txt_other,";
        $sql_reportReserv .= "rs.check_other as check_other,rs.check_catering AS check_catering,rs.txt_catering2 AS txt_catering2,rs.txt_cateringother AS txt_cateringother,rs.num AS num,tr.name_table AS name_table ";
        $sql_reportReserv .= " FROM reserv as rs";
        $sql_reportReserv .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
        $sql_reportReserv .= " JOIN users as u on(u.id_user = rs.update_id)";
        $sql_reportReserv .= " JOIN title as t on(t.title_id = u.title_id)";
        $sql_reportReserv .= " LEFT JOIN table_reserv as tr on(tr.id = rs.id_table_reserv)";
        $sql_reportReserv .= " WHERE id_status_reserv = '2'";
        $sql_reportReserv .= " AND MONTH(startday) = '".$str_data_month."' AND MONTH(endday) = '".$str_data_month."' ";
        $sql_reportReserv .= " AND YEAR(startday) = '".$str_data_year."' AND YEAR(endday) = '".$str_data_year."' ";
        if($str_data_room != "")
        {
            $sql_reportReserv .= " AND rs.id_room='".$str_data_room."'";
        }
        $sql_reportReserv .= " ORDER by MONTH(startday) DESC";
        $query_reportReserv = mysql_query($sql_reportReserv);
        $num_reportReserv = mysql_num_rows($query_reportReserv);
        
        $date_month = $thai_month_arr[$str_data_month];
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
        echo "<center><h2 style='text-align:center;font-size:15pt;'>รายการจองห้องประชุม</h2></center>";
        echo "<h2>เดือน :&nbsp;".$date_month."&nbsp;".($str_data_year+543)."<br>".$str_room."</h2>";
        echo "<table width='1000px' style='border:2px solid #000000;font-size:12pt;' cellPadding='9'>";

            $list=array();
            $month = $str_data_month;
            $year = date('Y');
            
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);          
                if (date('m', $time)==$month)       
                    $list[]=date('d', $time);
            }
            while($row_reportReserv = mysql_fetch_array($query_reportReserv))
            {
                $rowReport[] = $row_reportReserv;
            }
        
            //Room//
            $sql_room = "SELECT * FROM room";
            $query_room = mysql_query($sql_room);
            while($row_room = mysql_fetch_array($query_room))
            {
                $listRoom[] = $row_room;
            }    

                foreach($list as $key => $value) //Date
                {
                    echo "<tr style='border:2px solid #000000;font-size:12pt;background-color:#DCDCDC'>";
                    echo "<td>วันที่&nbsp;<strong>".$value."</strong></td>";
                    echo "</tr>";

                    // foreach($listRoom as $value_room) //Room
                    // {

                        foreach($rowReport as $value_report) //Report
                        {
                            if($value_report['id_room'] == 'RVB00001')
                            {
                                $colorRoom = "#98FB98";
                            }else if($value_report['id_room'] == 'RVB00002')
                            {
                                $colorRoom = "#00BFFF";
                            }else if($value_report['id_room'] == 'RVB00003')
                            {
                                $colorRoom = "#f0ad4e";
                            }else if($value_report['id_room'] == 'RVB00004')
                            {
                                $colorRoom = "#FF6A6A";
                            }else if($value_report['id_room'] == 'RVB00005')
                            {
                                $colorRoom = "#696969";
                            }
                            // if($value_room['id_room'] == $value_report['id_room'])
                            // {
                                if($value == $value_report['dayreserv'])
                                {
                                    if($str_data_room == "")
                                    {
                                        echo "<tr style='border:1px solid #000000;font-size:9pt;background-color:$colorRoom;color:white'>";
                                        echo "<td><strong>&nbsp;&nbsp;-&nbsp;&nbsp;".$value_report['name_room']."</strong></td>";
                                        echo "</tr>";
                                    }
                                    echo "<tr style='border:1px solid #000000;font-size:9pt;'>";
                                    echo "<td>&nbsp;&nbsp;&nbsp;***&nbsp;<strong>หัวข้อการประชุม :</strong> ".$value_report['topic']."
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เวลา</strong>&nbsp;".substr($value_report['starttime'],0,-3)."น.&nbsp;"."&nbsp;<strong>ถึง</strong>&nbsp;".substr($value_report['endtime'],0,-3)."น. &nbsp;
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>จำนวน : </strong><ins>$value_report[num]</ins>&nbsp;คน</ins>
                                    <br>&nbsp;&nbsp;&nbsp;&nbsp;";
                                        if($value_report['check_catering'] == 1)
                                        {
                                            $show_catering = "จัดเลี้ยงเอง/มีอุปกรณ์มาเอง";
                                        }else if($value_report['check_catering'] == 2)
                                        {
                                            $show_catering = "จัดเลี้ยงเอง ยืมอุปกรณ์";
                                        }else if($value_report['check_catering'] == 3)
                                        {
                                            $show_catering = "อื่นๆ";
                                        }else
                                        {
                                            $show_catering = "";
                                        }
                                    echo "<strong>จัดเลี้ยงอาหาร :</strong> <ins>$show_catering</ins>";
                                        if($value_report['check_catering'] == 2)
                                        {
                                            echo "&nbsp;&nbsp;ระบุ (".$value_report['txt_catering2'].")";
                                        }else if($value_report['check_catering'] == 3)
                                        {
                                            echo "&nbsp;&nbsp;ระบุ (".$value_report['txt_cateringother'].")";
                                        }
                                    echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>อุปกรณ์โสตฯที่ต้องการใช้ :</strong>";
                                    $arr_data = array(
                                        'เครื่องโปรเจคเตอร์' => $value_report['check_projector'],
                                        'จอภาพ' => $value_report['check_screen'],
                                        'เครื่องเล่น DVD' => $value_report['check_dvd'],
                                        'โทรทัศน์' => $value_report['check_tv'],
                                        'เครื่องบันทึกเสียง' => $value_report['check_record'],
                                        'เครื่องขยายเสียง' => $value_report['check_amp'],
                                    );
                                    foreach($arr_data as $key_data => $val_data)
                                    {
                                        if($val_data == 1)
                                        {
                                            echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;";
                                            echo "<ins>";
                                            print_r($key_data);
                                            echo "</ins>";
                                        }
                                    }
                                    $arr_data1 =array(
                                        'เจ้าหน้าที่ควบคุม' => array(
                                            $value_report['txt_control'].'&nbsp;คน' => $value_report['check_control'],
                                        ),
                                        'ไมโครโฟนไร้สาย' => array(
                                            $value_report['txt_wireless_mic'].'&nbsp;ชุด' => $value_report['check_wireless_mic']
                                        ),
                                        'ไมโครโฟนยืน' => array(
                                            $value_report['txt_mic'].'&nbsp;ชุด' => $value_report['check_mic'],
                                        ),
                                        'อื่นๆ' => array(
                                            $value_report['txt_other'] => $value_report['check_other'],
                                        ), 
                                   
                                    );
                                    foreach($arr_data1 as $key_data1 => $val_data1)
                                    {
                                        foreach($val_data1 as $txt_data => $txt_key)
                                        {
                                            if($txt_key == 1)
                                            {
                                                echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;";
                                                echo "<ins>";
                                                print_r($key_data1);
                                                echo "&nbsp;";
                                                print_r($txt_data);
                                                echo "</ins>";
                                            }
                                        }
                                    }
                                    echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<strong>รูปแบบการจัดห้องประชุม :</strong> <ins>$value_report[name_table]</ins>";
                                    echo "</td>";
                                }
                            //}
                            echo "</tr>";
                        }
                    //}
                }
            ?>
            </table>
<?php } 
$html = ob_get_contents();
ob_end_clean();

$pdf = new mPDF('utf-8', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetTitle("รายการจองห้องประชุม ประจำเดือน $date_month-$data_year-$str_room");
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html,2);
//$pdf->Output();
$data_year = $str_data_year+543;
$pdf->Output("รายการจองห้องประชุม ประจำเดือน $date_month-$data_year-$str_room.pdf",'D');
?>