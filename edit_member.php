<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    if(isset($_GET['id_user_edit']) && !empty($_GET['id_user_edit']))
    {
        $id_user = $_GET['id_user_edit'];
        $data_user_edit = "select * from users where id_user='".$id_user."'";
        $result_user_edit = mysql_query($data_user_edit);
        $row_user_edit = mysql_fetch_array($result_user_edit);

?>
<div class="col-md-12">
    <div class="page-header">
        <h1>แก้ไขบัญชีผู้ใช้งาน</h1>
    </div>

    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> แก้ไขบัญชีผู้ใช้งาน</div>
        <div class="panel-body">
            
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="edit_title" class="col-sm-2 control-label">คำนำหน้า </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="edit_title" id="edit_title">
                        <option value="">--- กรุณาเลือก ---</option>
                        <?php
                        $edit_title = "select * from title";
                        $result_title = mysql_query($edit_title);
                        while($row_title = mysql_fetch_array($result_title))
                        {
                            if($row_user_edit['title_id'] == $row_title['title_id'])
                            {
                                $select_title = "selected";
                            }else
                            {
                                $select_title = "";
                            }
                            echo "<option value='$row_title[title_id]' $select_title>$row_title[title_name]</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_username_log" class="col-sm-2 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_name_log" name="edit_name_log" value="<?php echo $row_user_edit['name_log'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_username_log" class="col-sm-2 control-label">ชื่อผู้ใช้งาน</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_username_log" value="<?php echo $row_user_edit['username_log'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_email_log" class="col-sm-2 control-label">อีเมล์</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_email_log" name="edit_email_log" value="<?php echo $row_user_edit['email_log'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_group_user" class="col-sm-2 control-label">ฝ่าย </label>
                    <div class="col-sm-5">
                        <select class="form-control" name="edit_group_user" id="edit_group_user">
                        <option value="">--- กรุณาเลือกฝ่าย ---</option>
                        <?php
                        $edit_group = "select * from group_users";
                        $result_group = mysql_query($edit_group);
                        while($row_group = mysql_fetch_array($result_group))
                        {
                            if($row_user_edit['id_group_users'] == $row_group['id_group_users'])
                            {
                                $selected_group_user = "selected";
                            }else
                            {
                                $selected_group_user = "";
                            }
                            echo "<option value='$row_group[id_group_users]' $selected_group_user>$row_group[name_group_user]</option>";
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">   
                    <label for="edit_role" class="col-sm-2 control-label">สิทธิ์</label>
                    <div class="col-sm-4">     
                        <select class="form-control" id="edit_role">
                        <option value="">--- กรุณาเลือก ---</option>
                        <?php
                            $data_role = "select * from role";
                            $result_role = mysql_query($data_role);
                            while($row_role = mysql_fetch_array($result_role))
                            {
                                if($row_user_edit['id_role'] == $row_role['id_role'])
                                {
                                    $selected_role = "selected";
                                }else
                                {
                                    $selected_role = "";
                                }
                                echo "<option value='$row_role[id_role]' $selected_role>$row_role[role_name]</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div>
                <h4 class="header blue bolder smaller">เปลี่ยนรหัสผ่าน</h4>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="new_password">รหัสผ่านใหม่</label>

                            <div class="col-sm-5">
                                <input class="form-control" type="password" id="new_password" />
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="confirm_password">ยืนยันรหัสผ่าน</label>

                            <div class="col-sm-5">
                                <input class="form-control" type="password" id="confirm_password" />
                            </div>
                        </div>

                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        <input type="hidden" id="id_user" value="<?php echo $row_user_edit['id_user'];?>">
                        <button type="button" class="btn btn-success" id="btn_edit_member"><span class="glyphicon glyphicon-floppy-disk"></span> แก้ไขข้อมูล</button>
                    </div>
                </div>
            </form>

        </div>
        </div>

    </div>

</div>
<span id="show_bug"></span>

<?php 
    include_once('layout/footer.php');
    }else
    {
        echo "";
    }
?>