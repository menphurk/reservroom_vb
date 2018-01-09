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
                            <h1>รายการจองประชุม</h1>
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
                                    <?php if($_SESSION['login'][3] == '2'){?>
                                <button class="btn btn-app btn-light btn-xs" id="print_event"><i class="ace-icon fa fa-print bigger-160"></i>พิมพ์</button>
                                <?php } ?>
                                </p>
                                <p class="text-left" style="font-size:12pt;font-weight:bolder;">
                                    <strong>***หมายเหตุ***</strong><br>
                                        <font color="#5cb85c">สีเขียว = ห้องรับรองใหญ่</font><br>
                                        <font color="#f0ad4e">สีส้ม = ห้องรับรองเล็ก</font><br>
                                        <font color="#838B8B">สีเทา = ห้องกิจกรรมอาสากาชาด ชั้น 2</font><br>
                                        <font color="#000000">สีดำ = ห้องศูนย์สมรรถนะการคิดเด็ก ชั้น 2</font><br>
                                        <font color="#d9534f">สีแดง = ห้องประชุม ชั้น 4</font><br>
                                </p>
                                </div>

                                <div class="tab-pane fade" role="tabpanel" id="event_table" aria-labelledby="event_table-tab"> 
                                    <div class="row">
                                        <div class="col-md-12">
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