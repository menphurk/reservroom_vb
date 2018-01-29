<?php session_start();?>
<style>
#content_reserv table tr td p
{
    font-size: 1.2em;
    margin-top: 11px;
}
</style>
<?php

    if(isset($_GET['key']) && !empty($_GET['key']))
    {
        require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
        ob_start(); // ทำการเก็บค่า html นะครับ
        include_once('include/Conn.php');

        $stylesheet = file_get_contents('css/mpdfstyletables.css');
        
        $_SESSION['key_reserv'] = htmlentities(mysql_real_escape_string($_GET['uidReserv']));
        $dataEdit_reserv = "SELECT * FROM reserv as r
        JOIN users as u ON(u.id_user = r.update_id)
        JOIN group_users as gu ON(gu.id_group_users = u.id_group_users)
        JOIN room as ro ON(ro.id_room = r.id_room)
        LEFT JOIN table_reserv as ts ON(ts.id = r.id_table_reserv)
        WHERE id_reserv='".$_SESSION['key_reserv']."'";
        $resultEdit_reserv = mysql_query($dataEdit_reserv);
        $rowEdit_reserv = mysql_fetch_array($resultEdit_reserv);
?>
        <div style="text-align: center"><img style="text-align:center;" src="images/logo_vb.png" alt=""></div>
        <h2 style="text-align:center;font-size:15pt;">แบบคำขอใช้ห้องประชุม สำนักงานอาสากาชาด</h2>
            <table width="1000px" style="border:2px solid #000000;font-size:12pt;" cellPadding="9" >
                <tr>
                    <td colspan="2" align="right">
                        <p>เลขที่จอง : <strong><ins><?php echo $rowEdit_reserv['id_reserv'];?></ins></strong></p>
                        <p>สถานะ : <strong><ins>
                            <?php 
                                if($rowEdit_reserv['id_status_reserv'] == '1'){
                                    echo "<font color='#d9534f'>ไม่อนุมัติ</font>";
                                }else if($rowEdit_reserv['id_status_reserv'] == '2')
                                {
                                    echo "<font color='#5cb85c'>อนุมัติ</font>";
                                }else if($rowEdit_reserv['id_status_reserv'] == '3')
                                {
                                    echo "<font color='#d44950'>ยกเลิก</font>";
                                    echo "<br>";
                                    echo "</strong>";
                                    echo "หมายเหตุ : ".$rowEdit_reserv['comment_reserv']."";
                                }
                            ?>
                        </ins></strong></p>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:10pt;">
                    <td colspan="2">
                        เรื่อง : <strong><ins><?php echo $rowEdit_reserv['topic'];?></ins></strong>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        รายละเอียด : <ins><?php echo $rowEdit_reserv['desc'];?></ins>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td>
                        ห้องประชุม : <ins><?php echo $rowEdit_reserv['name_room'];?></ins>
                    </td>
                    <td style="border:1px solid #000000;">
                        จำนวน : <ins><?php echo $rowEdit_reserv['num'];?></ins>&nbsp;คน</ins>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;">
                    <td colspan="2">
                        รายชื่อผู้เข้าประชุม : <ins><?php echo $rowEdit_reserv['namejoin'];?></ins>
                    </td>
                </tr>
                <?php
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
                            $startday = $rowEdit_reserv['startday'];
                            $ex_startday = explode("-",$startday);
                            $convert_startmonth = $ex_startday[1];
                            $convert_startmonth = $thai_month_arr[$convert_startmonth];
                            $ex_startday[0] = $ex_startday[0]+543;
                            $new_convertstartevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];

                            $endday = $rowEdit_reserv['endday'];
                            $ex_endday = explode("-",$endday);
                            $convert_endmonth = $ex_endday[1];
                            $ex_endday[0] = $ex_endday[0]+543;
                            $convert_endmonth = $thai_month_arr[$convert_endmonth];
                            $new_convertendevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];

                            //ConvertDate&Time Fidle//
                            $createDate = $rowEdit_reserv['create_date'];
                            $ex_createDate = explode(" ",$createDate);
                            //Date//
                            $exp_createDate = explode("-",$ex_createDate[0]);
                            $convert_Datemonth = $thai_month_arr[$exp_createDate[1]];
                            $convert_DateDay = $exp_createDate[2];
                            $convert_DateYear = $exp_createDate[0]+543;
                            $str_connvertDate = $convert_DateDay."-".$convert_Datemonth."-".$convert_DateYear;
                            //Time//
                            $convert_Time = $ex_createDate[1];
                ?>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        วันที่เริ่มต้น: <ins><?php echo $ex_startday[2];?></ins>&nbsp;เดือน&nbsp;<ins><?php echo $convert_startmonth;?></ins>&nbsp;พ.ศ.<ins><?php echo $ex_startday[0];?></ins>
                        วันที่สิ้นสุด <ins><?php echo $ex_endday[2];?></ins>&nbsp;เดือน&nbsp;<ins><?php echo $convert_endmonth;?></ins>&nbsp;พ.ศ.<ins><?php echo $ex_endday[0];?></ins>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        เวลา <ins><?php echo substr($rowEdit_reserv['starttime'],0,-3);?></ins>&nbsp;น. สิ้นสุดเวลา <ins><?php echo substr($rowEdit_reserv['endtime'],0,-3);?></ins> น.
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        <?php 
                            if($rowEdit_reserv['check_catering'] == 1)
                            {
                                $show_catering = "จัดเลี้ยงเอง/มีอุปกรณ์มาเอง";
                            }else if($rowEdit_reserv['check_catering'] == 2)
                            {
                                $show_catering = "จัดเลี้ยงเอง ยืมอุปกรณ์";
                                $show_txtcatering = "(".$rowEdit_reserv['txt_catering2'].")";
                            }else if($rowEdit_reserv['check_catering'] == 3)
                            {
                                $show_catering = "อื่นๆ";
                                $show_txtcatering = "(".$rowEdit_reserv['txt_cateringother'].")";
                            }
                        ?>
                        จัดเลี้ยงอาหาร : <ins><?php echo $show_catering;?></ins>&nbsp;<?php echo $show_txtcatering;?>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        อุปกรณ์โสตฯที่ต้องการใช้ :
                            <?php
                                $arr_data = array(
                                    'เครื่องโปรเจคเตอร์' => $rowEdit_reserv['check_projector'],
                                    'จอภาพ' => $rowEdit_reserv['check_screen'],
                                    'เครื่องเล่น DVD' => $rowEdit_reserv['check_dvd'],
                                    'โทรทัศน์' => $rowEdit_reserv['check_tv'],
                                    'เครื่องบันทึกเสียง' => $rowEdit_reserv['check_record'],
                                    'เครื่องขยายเสียง' => $rowEdit_reserv['check_amp'],
                                );
                                foreach($arr_data as $key_data => $val_data)
                                {
                                    if($val_data == 1)
                                    {
                                        echo "<br>-&nbsp;";
                                        echo "<ins>";
                                        print_r($key_data);
                                        echo "</ins>";
                                    }
                                }
                                $arr_data1 =array(
                                    'เจ้าหน้าที่ควบคุม' => array(
                                        $rowEdit_reserv['txt_control'].'&nbsp;คน' => $rowEdit_reserv['check_control'],
                                    ),
                                    'ไมโครโฟนไร้สาย' => array(
                                        $rowEdit_reserv['txt_wireless_mic'].'&nbsp;ชุด' => $rowEdit_reserv['check_wireless_mic']
                                    ),
                                    'ไมโครโฟนยืน' => array(
                                        $rowEdit_reserv['txt_mic'].'&nbsp;ชุด' => $rowEdit_reserv['check_mic'],
                                    ),
                                    'อื่นๆ' => array(
                                        $rowEdit_reserv['txt_other'] => $rowEdit_reserv['check_other'],
                                    ), 
                               
                                );
                                foreach($arr_data1 as $key_data1 => $val_data1)
                                {
                                    foreach($val_data1 as $txt_data => $txt_key)
                                    {
                                        if($txt_key == 1)
                                        {
                                            echo "<br>-&nbsp;";
                                            echo "<ins>";
                                            print_r($key_data1);
                                            echo "&nbsp;";
                                            print_r($txt_data);
                                            echo "</ins>";
                                        }
                                    }
                                }
                            ?>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td colspan="2">
                        รูปแบบการจัดห้องประชุม : <strong><ins><?php echo $rowEdit_reserv['name_table'];?></ins></strong>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;">
                    <td>
                        ชื่อผู้จอง : <strong><ins><?php echo $rowEdit_reserv['name_log'];?></ins></strong>
                    </td>
                    <td style="border:1px solid #000000;">
                        วันที่จอง : <strong><ins><?php echo $str_connvertDate;?></ins></strong>
                    </td>
                </tr>
                <tr style="border:1px solid #000000;font-size:12pt;"> 
                    <td>
                        หน่วยงาน/ฝ่าย : <strong><ins><?php echo $rowEdit_reserv['name_group_user'];?></ins></strong>
                    </td>
                    <td style="border:1px solid #000000;">
                        เบอร์โทรติดต่อ : <strong><ins><?php echo $rowEdit_reserv['tel'];?></ins></strong>   
                    </td>
                </tr>
            </table>
            <strong>***หมายเหตุ : 
            <br>1. สำนักงานอาสากาชาดไม่สะดวกในการให้ยืมเครื่อง Projector และคอมพิวเตอร์ ผู้ขอให้ห้องประชุมโปรดนำมาเอง<br>
            2. ผู้ขอให้ห้องประชุมต้องจัดเจ้าหน้าที่/พนักงานไปจัดสถานที่ล่วงหน้าและจัดเก็บให้ตามสมควร โดยให้สำนักงานอาสากาชาดจะประสานงานและอำนวยการความสะดวกให้<br>
            3. ในกรณีที่ขอให้ห้องประชุมนอกเวลาราชการ หรือในวันหยุดราชการ ผู้ขอให้ห้องประชุมต้องรับผิดชอบค่าปฏิบัติงานนอกเวลาราชการหรือวันหยุดราชการด้วย<br>
            </strong>
            <p>&nbsp;</p>   
<?php
    }
$html = ob_get_contents();
ob_end_clean();

$pdf = new mPDF('utf-8', 'A4', '0', ''); //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetTitle('แบบฟอร์มจองห้องประชุม สำนักงานอาสากาชาด');
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html,2);
//$pdf->Output();
$pdf->Output("$rowEdit_reserv[id_reserv]_$rowEdit_reserv[topic].pdf",'D');
?>