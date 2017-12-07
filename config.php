<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h3>ตั้งค่าระบบ</h3>
    </div>

    <div class="col-md-6 col-md-offset-3">
    <table class="table table-bordered">
        <tr>
            <td align="center"><a href="groupuser.php"><i class="fa fa-handshake-o fa-4x" aria-hidden="true"></i><br><br> ตั้งค่าฝ่าย</a></td>
            <td align="center"><a href="backup.php"><i class="fa fa-database fa-4x" aria-hidden="true"></i><br><br> สำรองข้อมูล</a></td>
        </tr>
        <tr>
            <td align="center"><a href="status_room.php"><i class="fa fa-bolt fa-4x" aria-hidden="true"></i><br><br> สถานะห้อง</a></td>
            <td align="center"><a href="role.php"><i class="fa fa-user fa-4x" aria-hidden="true"></i><br><br> ตั้งค่าสิทธิ์</a></td>
        </tr>
    </table>
    </div>
</div>



<?php 
    include_once('layout/footer.php');
?>