<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');
    if(isset($_GET['id_user']) && !empty($_GET['id_user']))
    {
        $showUser = "SELECT * FROM users WHERE id_user='".htmlentities($_GET['id_user'])."'";
        $result_User = mysql_query($showUser);
        $row_User = mysql_fetch_array($result_User);
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>แก้ไขข้อมูล</h1>
    </div>

    <div id="user-profile-3" class="user-profile row">
    <div class="col-sm-offset-1 col-sm-10">
        <form class="form-horizontal">
            <div class="tabbable">
                <ul class="nav nav-tabs padding-16">
                    <li class="active">
                        <a data-toggle="tab" href="#edit-basic">
                            <i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
                            ข้อมูลส่วนตัว
                        </a>
                    </li>
                </ul>

                <div class="tab-content profile-edit-tab-content">
                    <div id="edit-basic" class="tab-pane in active">
                        <h4 class="header blue bolder smaller">ข้อมูลทั่วไป</h4>

                        <div class="row">

                            <div class="col-xs-12 col-sm-8">
                                <div class="form-group">
                                    <label for="title" class="col-sm-4 control-label no-padding-right">คำนำหน้า </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="title" id="title">
                                        <option value="">--- กรุณาเลือก ---</option>
                                        <?php
                                        $edit_title = "select * from title";
                                        $result_title = mysql_query($edit_title);
                                        while($row_title = mysql_fetch_array($result_title))
                                        {
                                            if($row_User['title_id'] == $row_title['title_id'])
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

                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="name_log">ชื่อ-นามสกุล</label>

                                    <div class="col-sm-5">
                                            <input class="form-control" type="text" id="name_log" placeholder="First Name" value="<?php echo $row_User['name_log'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-4 control-label no-padding-right" for="username_log">ชื่อผู้ใช้งาน</label>

                                    <div class="col-sm-6">
                                        <input class="form-control" type="text" id="username_log" placeholder="Username" value="<?php echo $row_User['username_log'];?>" />
                                    </div>
                                </div>

                                <div class="space-4"></div>
                                
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="email_log">อีเมล์</label>

                                    <div class="col-sm-6">
                                        <span class="input-icon input-icon-right">
                                            <input class="form-control" type="text" id="email_log" placeholder="xxx@email.com" value="<?php echo $row_User['email_log'];?>" />
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="email_log">ฝ่าย</label>

                                    <div class="col-sm-5">
                                        <select class="form-control" id="">
                                            <option value="">--- กรุณาเลือก ---</option>
                                            <?php 
                                            $edit_group = "SELECT * FROM group_users";
                                            $result_group = mysql_query($edit_group);
                                            while($row_group = mysql_fetch_array($result_group))
                                            {
                                                if($row_group['id_group_users'] == $row_User['id_group_users'])
                                                {
                                                    $selected_group = "selected";
                                                }else
                                                {
                                                    $selected_group = "";
                                                }
                                                echo "<option value='$row_group[id_group_users]' $selected_group>$row_group[name_group_user]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        <div class="space"></div>

                        <h4 class="header blue bolder smaller">เปลี่ยนรหัสผ่าน</h4>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="new_password">รหัสผ่านใหม่</label>

                            <div class="col-sm-4">
                                <input class="form-control" type="password" id="new_password" />
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="confirm_password">ยืนยันรหัสผ่าน</label>

                            <div class="col-sm-4">
                                <input class="form-control" type="password" id="confirm_password" />
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="uid_user" value="<?php echo $_GET['id_user'];?>">
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" type="button" id="btn_edit_user">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        บันทึก
                    </button>

                </div>
            </div>
        </form>
    </div><!-- /.span -->
</div><!-- /.user-profile -->
</div>
<?php
    }
    include_once('layout/footer.php');
?>