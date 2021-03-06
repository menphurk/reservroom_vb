<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    //---ConvertDate---//
    $date_year = date("Y");
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
    $date_month = $thai_month_arr[date("m")];
    $date_month1 = date("m");
    $date_day = date("d");
    $date_year = $date_year+543;
    //---ConvertDate---//
?>
                    <!-- /section:settings.box -->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="page-header">
                            <h1>รายการการใช้ห้องประชุม</h1>
                        </div>
                            <!-- PAGE CONTENT BEGINS -->
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#event_today" id="event_today-tab" role="tab" data-toggle="tab" aria-controls="event_today" aria-expanded="false"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>&nbsp;รายการจองวันนี้</a>
                                </li>                                 
                                <li role="presentation" class="">
                                    <a href="#event_list" id="event_list-tab" role="tab" data-toggle="tab" aria-controls="event_list" aria-expanded="false"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;ข้อมูลแบบปฏิทิน</a>
                                </li> 
                                <li role="presentation" class="">
                                    <a href="#event_table" role="tab" id="event_table-tab" data-toggle="tab" aria-controls="event_table" aria-expanded="false"><span class="glyphicon glyphicon-list"></span>&nbsp;ข้อมูลแบบตาราง</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active in" role="tabpanel" id="event_today" aria-labelledby="event_today-tab"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span id="data_today"></span>
                                        </div>
                                    </div>     
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="event_list" aria-labelledby="event_list-tab">
                                <p>
                                    <div style="margin:auto;width:100%;" class="show_calendar">
                                    
                                    <div id='calendar'></div>
                                    </div>
                                <br>
                                </p>
                                <p class="text-left" style="font-size:12pt;font-weight:bolder;">
                                    <strong>***หมายเหตุ***</strong><br>
                                    <?php
                                        $sqlRoom = "SELECT * FROM room";
                                        $queryRoom = mysql_query($sqlRoom);
                                        while($rowRoom = mysql_fetch_array($queryRoom)){
                                            $arrTextColor = array('สีเขียว','สีส้ม','สีน้ำเงิน','สีแดง','สีดำ','สีน้ำตาล');
                                            $arrColor[] = $rowRoom['color_room'];
                                            $arrRoom[] = $rowRoom['name_room'];
                                        }
                                        $all = count($arrColor);
                                        for ($i=0; $i < $all; $i++){
                                        print "<font color='$arrColor[$i]'>$arrTextColor[$i] = $arrRoom[$i] </font><br>";
                                        }
                                    ?>
                                </pre>
                                </div>

                                <div class="tab-pane fade" role="tabpanel" id="event_table" aria-labelledby="event_table-tab"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-4">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <label for="search_reserv">ค้นหา :</label>
                                                    <select class="form-control" id="dataReserv_condition" onchange="change_room(this.value)">
                                                        <option value="">-----</option>
                                                        <option value="id_reserv">เลขที่จอง</option>
                                                        <option value="topic">หัวข้อประชุม</option>
                                                        <option value="rs.id_room">ห้องประชุม</option>
                                                        <option value="name_log">ชื่อผู้จอง</option>
                                                        <option value="startday">วันที่จอง</option>
                                                        <option value="id_status_reserv">สถานะ</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-5">
                                                        <span id="show_textbox_reserv"><input type="text" class="form-control" id="txt_searchreserv" placeholder="กรอกคำที่ต้องการค้นหา"></span>
                                                    </div>
                                                </div>
                                                <button type="button" id="btn_search_data" onclick="load_data('1',$('#txt_searchreserv').val(),$('#search').val());" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;ค้นหา</button>
                                            </form>        
                                            </div>
                                        </div>
                                            <span id="data_reserv"></span>
                                        </div>
                                    </div>     
                                </div>

                            </div>
                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
<!-- -->
<div id="fullCalModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            <h4 id="modalTitle" class="modal-title"></h4>
        </div>
        <div id="modalBody" class="modal-body">
        <strong>รายละเอียดการจอง</strong>&nbsp;:&nbsp;<p id="desc"></p>
        <strong>วัน/เวลาจอง</strong>&nbsp;:&nbsp;<p><span id="startTime"></span>&nbsp;น.&nbsp;ถึง&nbsp;<span id="endTime"></span>&nbsp;น.</p>
        <strong>ห้องประชุม</strong>&nbsp;:&nbsp;<p id="room"></p>
        <strong>ชื่อผู้จอง</strong>&nbsp;:&nbsp;<p id="name"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            <button class="btn btn-primary"><a id="eventUrl" target="_blank" style="color:white;">รายละเอียดเพิ่มเติม</a></button>
        </div>
    </div>
</div>
</div>
<!-- -->
<style>
.modal
{
    background-color: rgba(0,0,0,.0001) !important;
}
</style>

<?php 
    include_once('layout/footer.php');
?>
<script>
$("#print_event").click(function () {
    print()
});
</script>