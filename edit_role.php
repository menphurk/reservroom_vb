<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    if(isset($_GET['id_role']) && !empty($_GET['id_role']))
    {
        $id_role = $_GET['id_role'];
        $edit_role = "select * from role where id_role='".$id_role."'";
        $result_role = mysql_query($edit_role);
        $row_role = mysql_fetch_array($result_role);
?>

<div class="col-md-12">
    <div class="page-header">
        <h3>แก้ไขสิทธิ์ผู้ใช้งาน</h3>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> แก้ไขสิทธิ์ผู้ใช้งาน</div>
            <br>
            <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
                <label for="edit_role_name" class="col-sm-2 control-label">ชื่อสิทธิ์</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="edit_role_name" name="edit_role_name" placeholder="" value="<?php echo $row_role['role_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="edit_role_value" class="col-sm-2 control-label">จัดการหน้า</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="edit_role_value" name="edit_role_value" value="<?php echo $row_role['role_value'];?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <center>
                    <input type="hidden" id="id_role" value="<?php echo $row_role['id_role'];?>">
                    <button type="button" class="btn btn-success" id="btn_edit_role"><span class="glyphicon glyphicon-floppy-disk"></span> แก้ไขข้อมูล</button>
                </center>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<?php
    include_once('layout/footer.php');
    }else
    {
        echo "";
    }
?>