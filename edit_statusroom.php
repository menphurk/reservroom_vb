<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');

    if(isset($_GET['id_status_room']) && !empty($_GET['id_status_room']))
    {
        $id_status_room = $_GET['id_status_room'];
        $edit_status_room = "select * from status_room where id_status_room='".$id_status_room."'";
        $result_status_room = mysql_query($edit_status_room);
        $row_status_room = mysql_fetch_array($result_status_room);
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>แก้ไขสถานะห้อง</h1>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> แก้ไขสถานะห้อง</div>
            <br>
            <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
                <label for="edit_name_status_room" class="col-sm-2 control-label">ชื่อสถานะห้อง</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="edit_name_status_room" name="edit_name_status_room" placeholder="" value="<?php echo $row_status_room['name_status_room'];?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <center>
                    <input type="hidden" id="id_status_room" value="<?php echo $row_status_room['id_status_room'];?>">
                    <button type="button" class="btn btn-success" id="btn_edit_status_room"><span class="glyphicon glyphicon-floppy-disk"></span> แก้ไขข้อมูล</button>
                </center>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<?php
    }
    include_once('layout/footer.php');
?>