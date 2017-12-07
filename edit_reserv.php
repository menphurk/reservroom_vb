<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    if(isset($_GET['id_reserv']) && !empty($_GET['id_reserv']))
    {
        $id_reserv_edit = $_GET['id_reserv'];
        $data_reserv_edit = "select * from reserv where id_reserv='".$id_reserv_edit."'";
        $result_reserv_edit = mysql_query($data_reserv_edit);
        $row_reserv_edit = mysql_fetch_array($result_reserv_edit);

        //---Day----//
        $date_year = date("Y")+543;

        $startday = $row_reserv_edit['startday'];
        $endday = $row_reserv_edit['endday'];
        $ex_startday = explode("-",$startday);
        $ex_endday = explode("-",$endday);
            //--Startday--//
            $str_start_year = $ex_startday[0]+543;
            $str_start_month = $ex_startday[1];
            $str_start_day = $ex_startday[2];
            //--Startday--//
            //--Endday--//
            $str_end_year = $ex_endday[0]+543;
            $str_end_month = $ex_endday[1];
            $str_end_day = $ex_endday[2];        
            //--Endday--//

         //---Day----//

         //--------------------------------------------------------------------//
         //----Time----//
         $str_starttime = substr($row_reserv_edit['starttime'],0,-3);
         $str_endtime = substr($row_reserv_edit['endtime'],0,-3);
         //----Time----//
         //--------------------------------------------------------------------//

?>
<div class="col-md-12">

<div class="page-header">
    <h1>แก้ไขข้อมูลการจอง</h1>
</div>

<div class="panel panel-success">
<div class="panel-heading">
    <h2 class="panel-title">แก้ไขข้อมูลการจองห้องประชุมสำนักงานอาสากาชาด</h2>
</div>
<div class="panel-body">
    <form action="update_reserv.php?id_reserv=<?php echo $_GET['id_reserv'];?>" method="post" class="form-horizontal">
    <div class="page-header">
        <h3>วัน/เวลาที่จอง</h3>
    </div>        
    <div class="form-group">
        <label for="startday" class="col-sm-1 control-label">วันที่จอง :</label>
        <div class="col-sm-5">
            <select id="startday" name="startday">
                <option value="">--- เลือกวัน ---</option>
                <?php 
                for($day=01;$day<=31;$day++)
                {
                    if($str_start_day == $day)
                    {
                        $cur_strday = "selected";
                    }else
                    {
                        $cur_strday = "";
                    }
                ?>
                    <option value="<?php echo $day;?>" <?php echo $cur_strday;?>><?php echo $day;?></option>
                <?php } ?>
            </select>
            <select id="startmonth" name="startmonth">
                <option value="">--- เลือกเดือน ---</option>
                <?php 
                $month = array(
                    '1' => "มกราคม",
                    '2' => "กุมภาพันธ์",
                    '3' => "มีนาคม",
                    '4' => "เมษายน",
                    '5' => "พฤษภาคม",
                    '6' => "มิถุนายน",
                    '7' => "กรกฎาคม",
                    '8' => "สิงหาคม",
                    '9' => "กันยายน",
                    '10' => "ตุลาคม",
                    '11' => "พฤศจิกายน",
                    '12' => "ธันวาคม",
                );
                foreach($month as $key => $value)
                {
                    if($str_start_month == $key)
                    {
                        $cur_strmonth = "selected";
                    }else
                    {
                        $cur_strmonth = "";
                    }
                ?>
                    <option value="<?php echo $key;?>" <?php echo $cur_strmonth;?>><?php echo $value;?></option>
                <?php } ?>
            </select>
            <select id="startyear" name="startyear">
                <option value="">--- เลือกปี ---</option>
                <?php
                for($year = 2550; $year<=$date_year; $year++)
                {
                    if($str_start_year == $year)
                    {
                        $cur_stryear = "selected";
                    }else
                    {
                        $cur_stryear = "";
                    }
                ?>
                    <option value="<?php echo $year;?>" <?php echo $cur_stryear;?>><?php echo $year;?></option>
                <?php } ?>
            </select>
        </div>
        <label for="endday" class="col-sm-1 control-label">ถึงวันที่ :</label>
        <div class="col-sm-5">
          <select id="endday" name="endday">
                <option value="">--- เลือกวัน ---</option>
                <?php
                for($day=01;$day<=31;$day++)
                {
                    if($str_end_day == $day)
                    {
                        $cur_strday = "selected";
                    }else
                    {
                        $cur_strday = "";
                    }
                ?>
                    <option value="<?php echo $day;?>" <?php echo $cur_strday;?>><?php echo $day;?></option>
                <?php } ?>
            </select>
            <select id="endmonth" name="endmonth">
                <option value="">--- เลือกเดือน ---</option>
                <?php 
                $month = array(
                    '1' => "มกราคม",
                    '2' => "กุมภาพันธ์",
                    '3' => "มีนาคม",
                    '4' => "เมษายน",
                    '5' => "พฤษภาคม",
                    '6' => "มิถุนายน",
                    '7' => "กรกฎาคม",
                    '8' => "สิงหาคม",
                    '9' => "กันยายน",
                    '10' => "ตุลาคม",
                    '11' => "พฤศจิกายน",
                    '12' => "ธันวาคม",
                );
                foreach($month as $key => $value)
                {
                    if($str_end_month == $key)
                    {
                        $cur_strmonth = "selected";
                    }else
                    {
                        $cur_strmonth = "";
                    }
                ?>
                    <option value="<?php echo $key;?>" <?php echo $cur_strmonth;?>><?php echo $value;?></option>
                <?php 
                } 
                ?>  
            </select>
            <select id="endyear" name="endyear">
                <option value="">--- เลือกปี ---</option>
                <?php
                for($year = 2550; $year<=$date_year; $year++)
                {
                    if($str_end_year == $year)
                    {
                        $cur_stryear = "selected";
                    }else
                    {
                        $cur_stryear = "";
                    }
                ?>
                <option value="<?php echo $year;?>" <?php echo $cur_stryear;?>><?php echo $year;?></option>
                <?php 
                } 
                ?>
            </select>
        </div>            
    </div>
<?php
function create_time_range($start, $end, $interval = '30 mins', $format = '24') 
{
    $startTime = strtotime($start); 
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '12')?'g:i':'G:i';

    $current   = time(); 
    $addTime   = strtotime('+'.$interval, $current); 
    $diff      = $addTime - $current;

    $times = array(); 
    while ($startTime < $endTime) { 
    $times[] = date($returnTimeFormat, $startTime); 
    $startTime += $diff; 
    } 
    $times[] = date($returnTimeFormat, $startTime); 
        return $times; 
}
 $times = create_time_range('08:30', '16:30', '15 mins');
?>
    <div class="form-group">
        <label for="starttime" class="col-sm-1 control-label">เวลาจอง :</label>
        <div class="col-sm-5">
            <select id="starttime" name="starttime">
                <option value="">---</option>
                <?php 
                foreach($times as $starttime)
                { 
                    if($str_starttime == $starttime)
                    {
                        $cur_starttime = "selected";
                    }else
                    {
                        $cur_starttime = "";
                    }
                ?>
                    <option value="<?php echo $starttime;?>" <?php echo $cur_starttime;?>><?php echo $starttime;?></option>
                <?php 
                } 
                ?>
            </select>
            <label for="">น.</label>
        </div>
        <label for="endtime" class="col-sm-1 control-label">ถึงเวลา :</label>
        <div class="col-sm-5">
            <select id="endtime" name="endtime">
                <option value="">---</option>
                <?php
                foreach($times as $endtime)
                {
                    if($str_endtime == $endtime)
                    {
                        $cur_endtime = "selected";
                    }else
                    {
                        $cur_endtime = "";
                    }
                ?>
                    <option value="<?php echo $endtime;?>" <?php echo $cur_endtime;?>><?php echo $endtime;?></option>
                <?php 
                } 
                ?>
            </select>
            <label for="">น.</label>
        </div>
    </div>
    <div class="page-header">
        <h3>รายละเอียดห้องประชุม</h3>
        <div class="form-group">
            <label for="room" class="col-sm-2 control-label">ห้องประชุม :</label>
            <div class="col-sm-3">
            <select class="form-control" id="room" name="room">
                <option value="">--- กรุณาเลือกห้อง ---</option>
            <?php
            $dataRoom = "select * from room as r
            join status_room as st on(st.id_status_room = r.id_status_room)
            order by id_room ASC";
            $resultRoom = mysql_query($dataRoom);
            while($rowRoom = mysql_fetch_array($resultRoom))
            {
                if($rowRoom['id_status_room'] == 2 || $rowRoom['id_status_room'] == 3)
                {
                    $close_room = "disabled";
                }else
                {
                    $close_room = "";
                }
                    if($row_reserv_edit['id_room'] == $rowRoom['id_room'])
                    {
                        $cur_room = "selected";
                    }else
                    {
                        $cur_room = "";
                    }
            ?>
                <option value="<?php echo $rowRoom['id_room'];?>" <?php echo $cur_room;?> <?php echo $close_room;?>><?php echo $rowRoom['name_room'];?></option>
            <?php } ?>
            </select>
            </div>
        </div>
    </div>
    <div class="page-header">
        <h3>รายละเอียดการจอง</h3>
        <div class="form-group">
            <label for="typeActivity" class="col-sm-2 control-label">ประเภทงานประชุม :</label>
            <div class="col-sm-2">
                <select class="form-control" id="typereserv" name="typereserv">
                    <option value="">--- กรุณาเลือก ---</option>
                    <?php 
                    $data_type = "SELECT * FROM type_reserv";
                    $result_type = mysql_query($data_type);
                    while($row_type = mysql_fetch_array($result_type))
                    {
                        if($row_reserv_edit['id_type'] == $row_type['id_type'])
                        {
                            $cur_typereserv = "selected";
                        }else
                        {
                            $cur_typereserv = "";
                        }
                        echo "<option value='$row_type[id_type]' $cur_typereserv>$row_type[name_type]</option>";
                    }
                ?>                
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="topic" class="col-sm-2 control-label">หัวข้อ :</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="topic" name="topic" value="<?php echo $row_reserv_edit['topic'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="col-sm-2 control-label">รายละเอียด :</label>
            <div class="col-sm-5">
                <textarea class="form-control" style="resize:none;" rows="10" cols="30" id="desc" name="desc"><?php echo $row_reserv_edit['desc'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">จำนวนผู้เข้าประชุม :</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="num" name="num" onkeyPress="CheckNum()" value="<?php echo $row_reserv_edit['num'];?>">
            </div>
            <label for="" class="control-label">คน</label>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">รายชื่อผู้เข้าร่วมประชุม :</label>
            <div class="col-sm-2">
                <textarea class="form-control" rows="8" cols="40" style="resize:none;" id="namejoin" name="namejoin"><?php echo $row_reserv_edit['namejoin'];?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">เบอร์โทรศัพท์ :</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $row_reserv_edit['tel'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="catering" class="col-sm-2 control-label">จัดเลี้ยงอาหาร :</label>
            <div class="col-sm-8">
                <div class="radio">
                <label>
                <?php 
                    if($row_reserv_edit['check_catering'] == 1)
                    {
                        $cur_catering1 = "checked";
                    }else
                    {
                        $cur_catering1 = "";
                    }
                ?>
                    <input type="radio" name="check_catering" id="check_catering1" value="1" <?php echo $cur_catering1;?>>
                    จัดเลี้ยงเอง/มีอุปกรณ์มาเอง
                </label>
                </div>
                <div class="radio">
                <label>
                <?php 
                if($row_reserv_edit['check_catering'] == 2)
                {
                    $cur_catering2 = "checked";
                    $show_catering2 = $row_reserv_edit['txt_catering2'];
                    $enable_catering2 = "";

                }else
                {
                    $enable_catering2 = "disabled";
                    $cur_catering2 = "";
                    $show_catering2 = "";
                }
                ?>
                    <input type="radio" name="check_catering" id="check_catering2" value="2" <?php echo $cur_catering2;?>>
                    จัดเลี้ยงเอง ยืมอุปกรณ์
                    <input type="text" class="form-control" id="txt_catering2" name="txt_catering2" <?php echo $enable_catering2;?> value="<?php echo $show_catering2;?>">
                </label>
                </div>
                <div class="radio">
                <label>
                <?php 
                if($row_reserv_edit['check_catering'] == 3)
                {
                    $cur_catering3 = "checked";
                    $show_catering3 = $row_reserv_edit['txt_cateringother'];
                    $enable_catering3 = "";
                }else
                {
                    $enable_catering3 = "disabled";
                    $cur_catering3 = "";
                    $show_catering3 = "";
                }
            ?>
                    <input type="radio" name="check_catering" id="check_cateringother" value="3" <?php echo $cur_catering3;?>>
                    อื่นๆ
                    <input type="text" class="form-control" id="txt_cateringother" name="txt_cateringother" <?php echo $enable_catering3;?> value="<?php echo $show_catering3;?>">
                </label>
                </div>                    
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">อุปกรณ์โสตฯที่ต้องการใช้ :</label>
            <div class="col-sm-7">
                <div class="checkbox">
                <?php 
                    if($row_reserv_edit['check_projector'] == 1)
                    {
                        $check_projector = "checked";
                    }else
                    {
                        $check_projector = "";
                    }
                ?>
                <label>
                    <input type="checkbox" name="check_projector" id="check_projector" value="1" <?php echo $check_projector;?>>
                    เครื่องโปรเจคเตอร์
                </label>
                <?php 
                if($row_reserv_edit['check_screen'] == 1)
                {
                    $check_screen = "checked";
                }else
                {
                    $check_screen = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_screen" id="check_screen" value="1" <?php echo $check_screen;?>>
                    จอภาพ
                </label>
                <?php 
                if($row_reserv_edit['check_dvd'] == 1)
                {
                    $check_dvd = "checked";
                }else
                {
                    $check_dvd = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_dvd" id="check_dvd" value="1" <?php echo $check_dvd;?>>
                    เครื่องเล่น DVD
                </label>
                <?php 
                if($row_reserv_edit['check_tv'] == 1)
                {
                    $check_tv = "checked";
                }else
                {
                    $check_tv = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_tv" id="check_tv" value="1" <?php echo $check_tv;?>>
                    โทรทัศน์
                </label>
                <?php 
                if($row_reserv_edit['check_record'] == 1)
                {
                    $check_record = "checked";
                }else
                {
                    $check_record = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_record" id="check_record" value="1" <?php echo $check_record;?>>
                    เครื่องบันทึกเสียง
                </label>
                <?php 
                if($row_reserv_edit['check_amp'] == 1)
                {
                    $check_amp = "checked";
                }else
                {
                    $check_amp = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_amp" id="check_amp" value="1" <?php echo $check_amp;?>>
                    เครื่องขยายเสียง
                </label>
                </div>                    
                <div class="checkbox">
                <?php 
                if($row_reserv_edit['check_control'] == 1)
                {
                    $check_control = "checked";
                    $show_control = $row_reserv_edit['txt_control'];
                    $enable_control = "";
                }else
                {
                    $enable_control = "disabled";
                    $check_control = "";
                    $show_control = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_control" id="check_control" value="1" <?php echo $check_control;?>>
                    เจ้าหน้าที่ควบคุม (คน)
                    <input type="text" class="form-control" id="txt_control" name="txt_control" <?php echo $enable_control;?> onkeyPress="CheckNum()" value="<?php echo $show_control;?>">
                </label>
                </div>
                <div class="checkbox">
                <?php 
                if($row_reserv_edit['check_wireless_mic'] == 1)
                {
                    $check_wireless_mic = "checked";
                    $show_wireless_mic = $row_reserv_edit['txt_wireless_mic'];
                    $enable_wireless_mic = "";
                }else
                {
                    $enable_wireless_mic = "disabled";
                    $check_wireless_mic = "";
                    $show_wireless_mic = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_wireless_mic" id="check_wireless_mic" value="1" <?php echo $check_wireless_mic;?>>
                    ไมโครโฟนไร้สาย (ชุด)
                    <input type="text" class="form-control" id="txt_wireless_mic" name="txt_wireless_mic" <?php echo $enable_wireless_mic;?> onkeyPress="CheckNum()" value="<?php echo $show_wireless_mic;?>">
                </label>
                </div>
                <div class="checkbox">
                <?php 
                if($row_reserv_edit['check_mic'] == 1)
                {
                    $check_mic = "checked";
                    $show_mic = $row_reserv_edit['txt_mic'];
                    $enable_mic = "";
                }else
                {
                    $enable_mic = "disabled";
                    $check_mic = "";
                    $show_mic = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_mic" id="check_mic" value="1" <?php echo $check_mic;?>>
                    ไมโครโฟนยืน (ชุด)
                    <input type="text" class="form-control" id="txt_mic" name="txt_mic" <?php echo $enable_mic;?> onkeyPress="CheckNum()" value="<?php echo $show_mic;?>">
                </label>
                </div>
                <div class="checkbox">
                <?php 
                if($row_reserv_edit['check_other'] == 1)
                {
                    $check_other = "checked";
                    $show_other = $row_reserv_edit['txt_other'];
                    $enable_other = "";
                }else
                {
                    $enable_other = "disabled";
                    $check_other = "";
                    $show_other = "";
                }
                ?>
                <label>
                    <input type="checkbox" name="check_other" id="check_other" value="1" <?php echo $check_other;?>>
                    อื่นๆ (ระบุ)
                    <input type="text" class="form-control" id="txt_other" name="txt_other" <?php echo $enable_other;?> value="<?php echo $show_other;?>">
                </label>
                </div>                    
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
        <input type="hidden" name="update_id" value="<?php echo $_SESSION['login'][0];?>">
        <center><button type="submit" class="btn btn-success" id="btn_edit_reserv" name="btn_edit_reserv">ปรับปรุงการจอง</button></center>
        </div>
    </div>
    </form>
    </div>         
</div>
</div>
<?php } 
include_once('layout/footer.php');
?>
