<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    if(isset($_GET['id_group']) && !empty($_GET['id_group']))
    {
        $id_group = $_GET['id_group'];
        $edit_group = "select * from group_users where id_group_users='".$id_group."'";
        $result_group = mysql_query($edit_group);
        $row_group = mysql_fetch_array($result_group);        
?>
<div class="col-md-12">
    <div class="page-header">
        <h3>แก้ไขฝ่าย</h3>
    </div>
    <div class="error" style="display:none;"></div>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> แก้ไขฝ่าย</div>
            <br>
            <form class="form-horizontal" method="post" action="#">
            <div class="form-group">
                <label for="edit_name_group" class="col-sm-2 control-label">ชื่อฝ่าย</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="edit_name_group" name="edit_name_group" value="<?php echo $row_group['name_group_user'];?>" placeholder="ฝ่ายประชาสัมพันธ์">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <input type="hidden" id="id_group_user" value="<?php echo $row_group['id_group_users'];?>">
                <center><button type="button" class="btn btn-success" id="btn_edit_group">แก้ไข</button></center>
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