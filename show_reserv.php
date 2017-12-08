<?php
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');
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
    if(isset($_GET['id_reserv']) && !empty($_GET['id_reserv']))
    {
        $_SESSION['reserv'] = $_GET['id_reserv'];
        $token = md5(uniqid(rand(), true));
        $id_reserv = mysql_real_escape_string($_GET['id_reserv']);
        $dataEdit_reserv = "SELECT * FROM reserv as r
        JOIN users as u ON(u.id_user = r.update_id)
        LEFT JOIN room as ro ON(ro.id_room = r.id_room)
        LEFT JOIN type_reserv as tr ON(tr.id_type = r.id_type)
        JOIN group_users as gu ON(gu.id_group_users = u.id_group_users)
        WHERE id_reserv='".$id_reserv."'";
        $resultEdit_reserv = mysql_query($dataEdit_reserv);
        $rowEdit_reserv = mysql_fetch_array($resultEdit_reserv);
?>
<style>
#content_reserv table tr td p
{
    font-size: 1.0em;
    margin-top: 11px;
}
</style>
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
    <div class="panel-body">
        <center>
        <img src="images/logo_vb.png" alt=""><br>
        <h2>แบบคำขอใช้ห้องประชุม สำนักงานอาสากาชาด</h2>
        </center>
        <div id="content_reserv">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        <p class="text-right">เลขที่จอง : <strong><ins><?php echo $rowEdit_reserv['id_reserv'];?></ins></strong></p>
                        <p class="text-right">สถานะ : <strong><ins>
                            <?php 
                                if($rowEdit_reserv['status_reserv'] == 'yes')
                                {
                                    echo "<font color='#5cb85c'>อนุมัติ</font>";
                                }else
                                {
                                    echo "<font color='#d9534f'>ไม่อนุมัติ</font>";
                                }
                            ?>
                        </ins></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="text-left">เรื่อง : <strong><ins><?php echo $rowEdit_reserv['topic'];?></ins></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="text-left">รายละเอียด : <ins><?php echo $rowEdit_reserv['desc'];?></ins></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-left">ห้องประชุม : <ins><?php echo $rowEdit_reserv['name_room'];?></ins></p>
                    </td>
                    <td>
                        <p class="text-left">จำนวน : <ins><?php echo $rowEdit_reserv['num'];?></ins>&nbsp;คน</ins></p>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <p class="text-left">รายชื่อผู้เข้าประชุม : <ins><?php echo $rowEdit_reserv['namejoin'];?></ins></p>
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
                ?>
                <tr>
                    <td colspan="3">
                        <p class="text-left">วันที่จอง: <ins><?php echo $ex_startday[2];?></ins>&nbsp;เดือน&nbsp;<ins><?php echo $convert_startmonth;?></ins>&nbsp;พ.ศ.<ins><?php echo $ex_startday[0];?></ins>
                        ถึงวันที่ <ins><?php echo $ex_endday[2];?></ins>&nbsp;เดือน&nbsp;<ins><?php echo $convert_endmonth;?></ins>&nbsp;พ.ศ.<ins><?php echo $ex_endday[0];?></ins></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="text-left">ตั้งแต่เวลา <ins><?php echo substr($rowEdit_reserv['starttime'],0,-3);?></ins>&nbsp;น. ถึงเวลา <ins><?php echo substr($rowEdit_reserv['endtime'],0,-3);?></ins> น.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php 
                            if($rowEdit_reserv['check_catering'] == 1)
                            {
                                $show_catering = "จัดเลี้ยงเอง/มีอุปกรณ์มาเอง";
                            }else if($rowEdit_reserv['check_catering'] == 2)
                            {
                                $show_catering = "จัดเลี้ยงเอง ยืมอุปกรณ์";
                            }else if($rowEdit_reserv['check_catering'] == 3)
                            {
                                $show_catering = "อื่นๆ";
                            }else
                            {
                                $show_catering = "";
                            }
                        ?>
                        <p class="text-left">จัดเลี้ยงอาหาร : <ins><?php echo $show_catering;?></ins>
                        <?php 
                            if($rowEdit_reserv['check_catering'] == 2)
                            {
                                echo "ระบุ (".$rowEdit_reserv['txt_catering2'].")";
                            }else if($rowEdit_reserv['check_catering'] == 3)
                            {
                                echo "ระบุ (".$rowEdit_reserv['txt_cateringother'].")";
                            }
                        ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="text-left">อุปกรณ์โสตฯที่ต้องการใช้ :
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
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="text-left">ชื่อผู้จอง : <ins><?php echo $rowEdit_reserv['name_log'];?></ins></p>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <p class="text-left">หน่วยงาน/ฝ่าย : <ins><?php echo $rowEdit_reserv['name_group_user'];?></ins></p>
                    </td>
                    <td>
                        <p class="text-left">เบอร์โทรติดต่อ : <ins><?php echo $rowEdit_reserv['tel'];?></ins></p>        
                    </td>
                </tr>
            </table>
            <p style="font-size:1.0em">
            <strong>***หมายเหตุ : 
            <br>1. สำนักงานอาสากาชาดไม่สะดวกในการให้ยืมเครื่อง Projector และคอมพิวเตอร์ ผู้ขอใช้ห้องประชุมโปรดนำมาเอง<br>
            2. ผู้ขอใช้ห้องประชุมต้องจัดเจ้าหน้าที่/พนักงานไปจัดสถานที่ล่วงหน้าและจัดเก็บให้ตามสมควร โดยให้สำนักงานอาสากาชาดจะประสานงานและอำนวยการความสะดวกให้<br>
            3. ในกรณีที่ขอใช้ห้องประชุมนอกเวลาราชการ หรือในวันหยุดราชการ ผู้ขอใช้ห้องประชุมต้องรับผิดชอบค่าปฏิบัติงานนอกเวลาราชการหรือวันหยุดราชการด้วย<br>
            </strong>
            </p>
            <p>&nbsp;</p>
            <?php
            if($rowEdit_reserv['status_reserv'] == 'yes')
            {
                $disabled = "disabled";
            }else
            {
                $disabled = "";
            }
            ?>
            <center>
            <?php 
                if($rowEdit_reserv['id_user'] != $_SESSION['login'][0])
                {
                    $disabled_btnEditAnddel = "disabled";
                }else
                {
                    $disabled_btnEditAnddel = "";
                }
            ?>
            <button class="btn btn-app btn-yellow btn-xs" <?php echo $disabled_btnEditAnddel;?> onclick="javascript:window.location.href='edit_reserv.php?id_reserv=<?php echo $_SESSION['reserv'];?>'"><i class="ace-icon fa fa-pencil bigger-160"></i>แก้ไข</button>
            <button class="btn btn-app btn-danger btn-xs" <?php echo $disabled_btnEditAnddel;?> onclick="remove_reserv('<?php echo $_SESSION['reserv'];?>')" <?php echo $disabled;?>><i class="ace-icon fa fa-trash-o bigger-200"></i>ลบ</button>
            <?php if($_SESSION['login'][3] == 2 || $_SESSION['login'][3] == 1){?>
            <button class="btn btn-app btn-success btn-xs" <?php echo $disabled;?> onclick="confirm_reserv('<?php echo $_SESSION['reserv'];?>')"><i class="ace-icon fa fa-check bigger-200"></i>ยืนยัน</button>
            <?php } ?>
            <button class="btn btn-app btn-pink btn-xs" onclick="window.location.href='export_pdf.php?uidReserv=<?php echo $_SESSION['reserv'];?>&key=<?php echo $token;?>'"><i class="ace-icon fa fa-file-pdf-o bigger-160"></i>Export</button>
            </center>
        </div>
    </div>
    </div>    
</div>
<?php
    }
    include_once('layout/footer.php');
?>