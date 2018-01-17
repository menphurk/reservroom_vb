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
                            <h1>พิมพ์รายการห้องประชุม</h1>
                        </div>
                            <p>
                            <div class="col-md-6 col-md-offset-4">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label for="search_reserv">ค้นหาเดือน :</label>
                                        <select class="form-control" id="data_month" onchange="">
                                            <?php foreach($thai_month_arr as $value => $thai_month)
                                            {
                                                echo "<option value='$value'>$thai_month</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="btn_reportlistreserv"><span class="glyphicon glyphicon-search"></span>&nbsp;ค้นหา</button>
                                </form>
                            </div>
                            </p><br><br>
                            <span id="show_report"></span>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
</div>
<!-- -->

<?php 
    include_once('layout/footer.php');
?>