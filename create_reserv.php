<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    include_once('include/Conn.php');

    //---ConvertDate---//
    $date_year = date("Y");
    $date_month = date("n");
    $date_day = date("d");
    $date_year = $date_year+543;
    //---ConvertDate---//
    if(isset($_GET['startday']) && isset($_GET['endday']))
    {
        $date_day = mysql_real_escape_string($_GET['startday']);
        $date_month = mysql_real_escape_string($_GET['month']);
        $date_year = mysql_real_escape_string($_GET['year']+543);
    }

?>
<div class="col-md-12">
    
    <div class="page-header">
        <h1>จองห้องประชุม</h1>
    </div>

    <div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">แบบฟอร์มจองห้องประชุมสำนักงานอาสากาชาด</h2>
    </div>
    <div class="panel-body">
        <form action="save_reserv.php" method="post" class="form-horizontal">
        <div class="page-header">
            <h3>วัน/เวลาที่ใช้</h3>
        </div>        
        <div class="form-group">
            <label for="startday" class="col-sm-1 control-label">วันที่เริ่มต้น :</label>
            <div class="col-sm-5">
                <select id="startday" name="startday">
                    <option value="">--- เลือกวัน ---</option>
                    <?php for($day=01;$day<=31;$day++)
                    {
                        if($date_day == $day)
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
                        if($date_month == $key)
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
                <select id="startyear" name="startyear">
                    <option value="">--- เลือกปี ---</option>
                    <?php
                    for($year = 2550; $year<=$date_year+10; $year++)
                    {
                        if($date_year == $year)
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
            <label for="endday" class="col-sm-1 control-label">วันที่สิ้นสุด :</label>
            <div class="col-sm-5">
              <select id="endday" name="endday">
                    <option value="">--- เลือกวัน ---</option>
                    <?php for($day=01;$day<=31;$day++)
                    {
                        if($date_day == $day)
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
                        if($date_month == $key)
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
                    for($year = 2550; $year<=$date_year+10; $year++)
                    {
                        if($date_year == $year)
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
function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '24' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'G:i';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[(string) $increment] = $date->format( $format );
    }

    return $times;
}
     $times = hoursRange(21600, 63000, 60 * 15, 'H:i');
?>
        <div class="form-group">
            <label for="starttime" class="col-sm-1 control-label">เวลา :</label>
            <div class="col-sm-5">
                <select id="starttime" name="starttime">
                    <option value="">---</option>
                    <?php 
                    foreach($times as $starttime)
                    {                    
                    ?>
                        <option value="<?php echo $starttime;?>"><?php echo $starttime;?></option>
                    <?php 
                    } 
                    ?>
                </select>
                <label for="">น.</label>
            </div>
            <label for="endtime" class="col-sm-1 control-label">สิ้นสุดเวลา :</label>
            <div class="col-sm-5">
                <select id="endtime" name="endtime">
                    <option value="">---</option>
                    <?php
                    foreach($times as $endtime)
                    {
                    ?>
                        <option value="<?php echo $endtime;?>"><?php echo $endtime;?></option>
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
                ?>
                    <option value="<?php echo $rowRoom['id_room'];?>" <?php echo $close_room;?>><?php echo $rowRoom['name_room'];?></option>
                <?php } ?>
                </select>
                </div>
            </div>
        </div>
        <div class="page-header">
            <h3>รายละเอียดการจอง</h3>
            <div class="form-group">
                <label for="typereserv" class="col-sm-2 control-label">ประเภทงานประชุม :</label>
                <div class="col-sm-2">
                    <select class="form-control" id="typereserv" name="typereserv">
                        <option value="">--- กรุณาเลือก ---</option>
                    <?php 
                        $data_type = "SELECT * FROM type_reserv";
                        $result_type = mysql_query($data_type);
                        while($row_type = mysql_fetch_array($result_type))
                        {
                            echo "<option value='$row_type[id_type]'>$row_type[name_type]</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="topic" class="col-sm-2 control-label">หัวข้อ :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="topic" name="topic" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">รายละเอียด :</label>
                <div class="col-sm-5">
                    <textarea class="form-control" style="resize:none;" rows="10" cols="30" id="desc" name="desc"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="num" class="col-sm-2 control-label">จำนวนผู้เข้าประชุม :</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" id="num" name="num" onkeyPress="CheckNum()">
                </div>
                <label for="" class="control-label">คน</label>
            </div>
            <div class="form-group">
                <label for="namejoin" class="col-sm-2 control-label">รายชื่อผู้เข้าร่วมประชุม :</label>
                <div class="col-sm-2">
                    <textarea class="form-control" rows="8" cols="40" style="resize:none;" id="namejoin" name="namejoin"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="tel" class="col-sm-2 control-label">เบอร์โทรศัพท์ :</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="tel" name="tel">
                </div>
            </div>
            <div class="form-group">
                <label for="catering" class="col-sm-2 control-label">จัดเลี้ยงอาหาร :</label>
                <div class="col-sm-8">
                    <div class="radio">
                    <label>
                        <input type="radio" name="check_catering" id="check_catering1" value="1">
                        จัดเลี้ยงเอง/มีอุปกรณ์มาเอง
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                        <input type="radio" name="check_catering" id="check_catering2" value="2">
                        จัดเลี้ยงเอง ยืมอุปกรณ์
                        <input type="text" class="form-control" id="txt_catering2" name="txt_catering2" disabled="disabled">
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                        <input type="radio" name="check_catering" id="check_cateringother" value="3">
                        อื่นๆ
                        <input type="text" class="form-control" id="txt_cateringother" name="txt_cateringother" disabled="disabled">
                    </label>
                    </div>                    
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">อุปกรณ์โสตฯที่ต้องการใช้ :</label>
                <div class="col-sm-7">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check_projector" id="check_projector" value="1">
                        เครื่องโปรเจคเตอร์
                    </label>
                    <label>
                        <input type="checkbox" name="check_screen" id="check_screen" value="1">
                        จอภาพ
                    </label>
                    <label>
                        <input type="checkbox" name="check_dvd" id="check_dvd" value="1">
                        เครื่องเล่น DVD
                    </label>
                    <label>
                        <input type="checkbox" name="check_tv" id="check_tv" value="1">
                        โทรทัศน์
                    </label>
                    <label>
                        <input type="checkbox" name="check_record" id="check_record" value="1">
                        เครื่องบันทึกเสียง
                    </label>
                    <label>
                        <input type="checkbox" name="check_amp" id="check_amp" value="1">
                        เครื่องขยายเสียง
                    </label>
                    </div>                    
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check_control" id="check_control" value="1">
                        เจ้าหน้าที่ควบคุม (คน)
                        <input type="text" class="form-control" id="txt_control" name="txt_control" disabled="disabled" onkeyPress="CheckNum()">
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check_wireless_mic" id="check_wireless_mic" value="1">
                        ไมโครโฟนไร้สาย (ชุด)
                        <input type="text" class="form-control" id="txt_wireless_mic" name="txt_wireless_mic" disabled="disabled" onkeyPress="CheckNum()">
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check_mic" id="check_mic" value="1">
                        ไมโครโฟนยืน (ชุด)
                        <input type="text" class="form-control" id="txt_mic" name="txt_mic" disabled="disabled" onkeyPress="CheckNum()">
                    </label>
                    </div>
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" name="check_other" id="check_other" value="1">
                        อื่นๆ (ระบุ)
                        <input type="text" class="form-control" id="txt_other" name="txt_other" disabled="disabled">
                    </label>
                    </div>                    
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">รูปแบบการจัดห้องประชุม :</label>
                <div class="col-sm-7">
                    <?php
                    $sql_table = "SELECT * FROM table_reserv";
                    $query_table = mysql_query($sql_table);
                    while($row_table = mysql_fetch_array($query_table))
                    {
                        echo "<div class='radio-inline'>";
                        echo "<label>";
                            echo "<input type='radio' name='table_reserv' id='table_reserv_$row_table[id]' value='$row_table[id]'>";
                            echo $row_table['name_table'];
                        echo "</label>";
                        echo "</div>";
                    }
                    echo "&nbsp;&nbsp;<input type='text' name='txt_tableReserv' id='txt_tableReserv' disabled='disabled'>";
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
            <input type="hidden" name="update_id" value="<?php echo $_SESSION['login'][0];?>">
            <center><button type="submit" class="btn btn-success" id="btn_create_reserv" name="btn_create_reserv" value="add">บันทึกการจอง</button></center>
            </div>
        </div>
        </form>
        </div>         
    </div>
</div>


<?php 
    include_once('layout/footer.php');
?>