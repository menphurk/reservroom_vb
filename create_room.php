<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>สร้างห้องประชุม</h1>
    </div>

    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">สร้างห้องประชุม</div>
            <br>
                <form class="form-horizontal" action="process.php"  method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name_room" class="col-sm-3 control-label">ชื่อห้อง</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_room" name="name_room" placeholder="">
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="desc_room" class="col-sm-3 control-label">รายละเอียดห้อง</label>
                        <div class="col-sm-6">
                            <textarea style="resize:none" rows="10" class="form-control" cols="50" id="desc_room" name="desc_room"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_room" class="col-sm-3 control-label">จำนวน</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="num_room" name="num_room">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_room" class="col-sm-3 control-label">สถานะห้อง</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="status_room" name="status_room">
                                <option value="">--- กรุณาเลือก ---</option>
                                <?php
                                    $data_status_room = "select * from status_room";
                                    $result_status_room = mysql_query($data_status_room);
                                    while($row_status_room = mysql_fetch_array($result_status_room))
                                    {
                                        echo "<option value='$row_status_room[id_status_room]'>$row_status_room[name_status_room]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img_room" class="col-sm-3 control-label">รูปห้อง</label>
                        <div class="col-sm-4">
                            <input type="file" class="form-control" id="img_room" name="img_room" onchange="readURL(this);">
                            <img id="img_room_preview">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                        <input type="hidden" name="update_id" value="<?php echo $_SESSION['login'][0];?>">
                        <center><button type="submit" class="btn btn-primary" id="btn_create_room" name="btn_create_room">สร้างห้อง</button></center>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>



<?php 
    include_once('layout/footer.php');
?>