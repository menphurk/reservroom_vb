<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
?>
<div class="col-md-12">
    
    <div class="page-header">
        <h1>รายงาน</h1>
    </div>
    <center>
    <ul class="nav nav-tabs" id="myTabs" role="tablist"> 

                                <li role="presentation" class="active">
                                    <a href="#report_year" id="report_year-tab" role="tab" data-toggle="tab" aria-controls="report_year" aria-expanded="false"><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;รายงานแบบรายปี</a>
                                </li> 
                                <li role="presentation" class="">
                                    <a href="#report_month" role="tab" id="report_month-tab" data-toggle="tab" aria-controls="report_month" aria-expanded="false"><i class="fa fa-file-text"></i>&nbsp;รายงานแบบรายเดือน</a>
                                </li> 
                                <li role="presentation" class="">
                                    <a href="#report_other" role="tab" id="report_other-tab" data-toggle="tab" aria-controls="report_other" aria-expanded="false"><i class="fa fa-file-text"></i>&nbsp;รายงานแบบกำหนดเอง</a>
                                </li> 
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active in" role="tabpanel" id="report_year" aria-labelledby="report_year-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form-inline" id="form-report-year">
                                                <div class="form-group">
                                                <label for="report_year">เลือกปีที่ต้องการ </label>
                                                <select id="report_year_txt" name="report_year">
                                                    <option value="">---</option>
                                                    <?php for($i=2560;$i>=2557;$i--){?>
                                                    <option value="<?php echo ($i-543);?>"><?php echo $i;?></option>
                                                    <?php } ?>   
                                                </select>
                                                </div>
                                                <button type="button" class="btn btn-default" id="btn_reportYear">ค้นหา</button>
                                            </form>
                                            <span id="show_reportyear"></span>
                                        </div>
                                    </div>                                  
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="report_month" aria-labelledby="report_month-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <form class="form-inline" id="form-report-month">
                                            <div class="form-group">
                                                <label for="txt_year">ปี : </label>
                                                <select id="txt_year" name="txt_year">
                                                    <option value="">---</option>
                                                    <?php for($i=2560;$i>=2557;$i--){?>
                                                    <option value="<?php echo ($i-543);?>"><?php echo $i;?></option>
                                                    <?php } ?>   
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <span id="show_month"></span>
                                            </div>
                                                <button type="button" class="btn btn-default" id="btn_reportMonth">ค้นหา</button>                                            
                                            
                                        </form>
                                                <span id="show_reportmonth"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="report_other" aria-labelledby="report_other-tab"> 
                                    <div class="row">
                                        <div class="col-md-12">
                                        <form class="form-inline" id="form-report-other">
                                            <div class="form-group">
                                            <label for="startday_report">ตั้งแต่วันที่ : </label>
                                            <input type="date" class="form-control" id="startday_report" name="startday_report">
                                            </div>
                                            <div class="form-group">
                                            <label for="endday_report">ถึงวันที่ : </label>
                                            <input type="date" class="form-control" id="endday_report" name="endday_report">
                                            </div>
                                                <button type="button" class="btn btn-default" id="btn_report">ค้นหา</button>
                                            </form>
                                            <span id="show_reportother"></span>                                            
                                        </div>
                                    </div>     
                                </div>

                            </div>
</div>

<?php 
    include_once('layout/footer.php');
?>