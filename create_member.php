<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

?>
<div class="col-md-12">
    <div class="page-header">
        <h1>สร้างบัญชีผู้ใช้งาน</h1>
    </div>

<div class="col-md-6 col-md-offset-3">

    <div class="panel panel-danger">
        <div class="panel-heading"><i class="fa fa-user-o" aria-hidden="true"></i> สร้างบัญชีผู้ใช้งาน</div>
    <div class="panel-body">
        <form action="#" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">คำนำหน้า</label>
            <div class="col-sm-4">
                <select class="form-control" name="title" id="title">
                    <option value="">--- กรุณาเลือก ---</option>
                    <?php 
                    $data_title = "SELECT * FROM title";
                    $result_title = mysql_query($data_title);
                    while($row_title = mysql_fetch_array($result_title))
                    {
                        echo "<option value='$row_title[title_id]'>$row_title[title_name]</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name_log" class="col-sm-2 control-label">ชื่อ-นามสกุล</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="name_log" name="name_log" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <label for="username_log" class="col-sm-2 control-label">ชื่อผู้ใช้งาน</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="username_log" name="password_log" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label for="password_log" class="col-sm-2 control-label">รหัสผ่าน</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password_log" name="password_log" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="email_log" class="col-sm-2 control-label">อีเมล์</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="email_log" name="email_log" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="group_user" class="col-sm-2 control-label">ฝ่าย</label>
            <div class="col-sm-8">
                <select class="form-control" name="group_user" id="group_user">
                    <option value="">--- กรุณาเลือกฝ่าย ---</option>
                    <?php
                        $data_group = "select * from group_users";
                        $result_group = mysql_query($data_group);
                        while($row_group = mysql_fetch_array($result_group))
                        {
                            echo "<option value='$row_group[id_group_users]'>$row_group[name_group_user]</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="role" class="col-sm-2 control-label">สิทธิ์</label>
            <div class="col-sm-6">
                <select class="form-control" id="role">
                <option value="">--- กรุณาเลือก ---</option>
                <?php
                $data_role = "select * from role";
                $result_role = mysql_query($data_role);
                while($row_role = mysql_fetch_array($result_role))
                {
                    echo "<option value='$row_role[id_role]'>$row_role[role_name]</option>";
                }
                ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-success" id="btn_save_user"><span class="glyphicon glyphicon-floppy-disk"></span> สร้าง</button>
            </div>
        </div>
        </form>
    </div>
    </div>

</div>


<?php 
    include_once('layout/footer.php');
?>