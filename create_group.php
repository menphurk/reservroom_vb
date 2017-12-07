<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

?>
<div class="col-md-12">
    <div class="page-header">
        <h1>สร้างฝ่าย</h1>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">สร้างฝ่าย</div>
            <br>
            <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
                <label for="group" class="col-sm-2 control-label">ชื่อฝ่าย</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="group" name="group" placeholder="ฝ่ายประชาสัมพันธ์">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <center><button type="button" class="btn btn-success" id="btn_create_group">สร้าง</button></center>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



<?php 
    include_once('layout/footer.php');
?>