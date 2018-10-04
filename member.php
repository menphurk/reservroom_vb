<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>รายการบัญชีผู้ใช้งาน</h1>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <form class="form-inline">
                <div class="form-group">
                    <label for="search_reserv">ค้นหา :</label>
                    <select class="form-control" id="dataMember_condition" onchange="change_member(this.value)">
                        <option value="">-----</option>
                        <option value="id_user">รหัสสมาชิก</option>
                        <option value="name_log">ชื่อ-นามสกุล</option>
                        <option value="username_log">ชื่อผู้ใช้งาน</option>
                        <option value="gu.id_group_users">ฝ่าย</option>
                        <option value="r.id_role">สิทธิ์ผู้ใช้งาน</option>
                    </select>
                </div>
                <div class="form-group">
                    <span id="show_textbox_member"><input type="text" class="form-control" id="search_member" placeholder="ค้นหาข้อมูล..."></span>
                </div>
                <button type="button" class="btn btn-primary" onclick="load_member('1',$('#search_member').val(),$('#dataMember_condition').val())"><span class="glyphicon glyphicon-search"></span>&nbsp;ค้นหา</button>
            </form>
        </div>
    </div>
    <span id="data_member"></span>
</div>



<?php 
    include_once('layout/footer.php');
?>