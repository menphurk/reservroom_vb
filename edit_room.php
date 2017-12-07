<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    if(isset($_GET['id_room']) && !empty($_GET['id_room']))
    {
        $id_room = $_GET['id_room'];
        $data_edit_room = "SELECT * FROM room where id_room='".$id_room."'";
        $result_edit_room = mysql_query($data_edit_room);
        $row_edit_room = mysql_fetch_array($result_edit_room);
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>แก้ไขห้องประชุม</h1>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span>&nbsp;แก้ไขห้องประชุม</div>
            <br>
                <form class="form-horizontal" action="process.php"  method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name_room" class="col-sm-3 control-label">ชื่อห้อง</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_room_edit" name="name_room_edit" value="<?php echo $row_edit_room['name_room'];?>">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="desc_room" class="col-sm-3 control-label">รายละเอียดห้อง</label>
                        <div class="col-sm-6">
                            <textarea style="resize:none" rows="10" class="form-control" cols="50" id="desc_room_edit" name="desc_room_edit"><?php echo $row_edit_room['desc_room'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_room" class="col-sm-3 control-label">จำนวน</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="num_room_edit" name="num_room_edit" value="<?php echo $row_edit_room['num_room'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_room" class="col-sm-3 control-label">สถานะห้อง</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="status_room" name="status_room_edit">
                                <?php
                                    $data_status_room = "select * from status_room";
                                    $result_status_room = mysql_query($data_status_room);
                                    while($row_status_room = mysql_fetch_array($result_status_room))
                                    {
                                        if($row_edit_room['id_status_room'] == $row_status_room['id_status_room'])
                                        {
                                            $selected_room = "selected";
                                        }else
                                        {
                                            $selected_room = "";
                                        }
                                        echo "<option value='$row_status_room[id_status_room]' $selected_room>$row_status_room[name_status_room]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_room" class="col-sm-3 control-label">รูปห้อง</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" id="img_room_edit" name="img_room_edit" onchange="readURL(this);">
                            <img id="img_room_preview">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                        <input type="hidden" name="update_id" value="<?php echo $_SESSION['login'][0];?>">
                        <input type="hidden" name="img_room_old" value="<?php echo $row_edit_room['img_room'];?>">
                        <input type="hidden" name="id_room_edit" value="<?php echo $id_room;?>">
                        <center><button type="submit" class="btn btn-success" id="btn_edit_room" name="btn_edit_room"><span class="glyphicon glyphicon-floppy-disk"></span> แก้ไขข้อมูลห้อง</button></center>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>
<?php } 
    include_once('layout/footer.php');
?>
