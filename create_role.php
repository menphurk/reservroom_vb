<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

?>

<div class="col-md-12">
    <div class="page-header">
        <h1>สร้างสิทธิ์ผู้ใช้งาน</h1>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">สร้างสิทธิ์ผู้ใช้งาน</div>
            <br>
            <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
                <label for="role_name" class="col-sm-2 control-label">ชื่อสิทธิ์</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="role_name" name="role_name" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="role_value" class="col-sm-2 control-label">จัดการหน้า</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="role_value" name="role_value" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-8">
                <center><button type="button" class="btn btn-default" id="btn_create_role">สร้าง</button></center>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>



<?php 
    include_once('layout/footer.php');
?>