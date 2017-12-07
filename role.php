<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');

    include_once('include/Conn.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>ตั้งค่าสิทธิ์ผู้ใช้งาน</h1>
    </div>
    <p class="text-right"><a class="btn btn-success" href="create_role.php" role="button"><span class="glyphicon glyphicon-plus"></span> สร้างสิทธิ์ผู้ใช้งาน</a></p>
    <table class="table table-bordered table-striped">
        <tr>
            <th width="3%">ลำดับ</th>
            <th>รายการ</th>
            <th>หน้า</th>
            <th width="20%">&nbsp;</th>
        </tr>
        <?php
        $data_role = "select * from role";
        $result_role = mysql_query($data_role);
        $num_role = mysql_num_rows($result_role);
        if($num_role == 0)
        {
            echo "<tr><td colspan='5'><strong><font color='#d9534f'><center><h2>ไม่มีข้อมูลในระบบ</h2></center></font></strong></td></tr>";
        }else
        {
            $num = 1;
            while($row_role = mysql_fetch_array($result_role))
            {
            
                echo "<tr>";
                echo "<td>".$num."</td>";
                echo "<td>".$row_role['role_name']."</td>";
                echo "<td>".$row_role['role_value']."</td>";
                echo "<td><a class=\"btn btn-info\" href=\"#\" onclick=\"role_edit($row_role[id_role])\" role=\"button\"><i class=\"fa fa-pencil fa-fw\"></i>&nbsp;แก้ไขข้อมูล</a><a class=\"btn btn-danger\" href=\"#\" onclick=\"role_delete($row_role[id_role])\" role=\"button\"><i class=\"fa fa-trash-o fa-fw\"></i>ลบข้อมูล</a></td>";
                echo "</tr>";
                $num++;
            }
        }
        ?>
    </table>
</div>



<?php 
    include_once('layout/footer.php');
?>