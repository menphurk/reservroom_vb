<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>ฝ่าย</h1>
    </div>
    <p class="text-right"><a class="btn btn-success" href="create_group.php" role="button"><span class="glyphicon glyphicon-plus"></span> สร้างชื่อฝ่าย</a></p>
    <div class="col-md-6 col-md-offset-3">
    <table class="table table-bordered table-striped">
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อฝ่าย</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        $data_group = "select * from group_users";
        $result_group = mysql_query($data_group);
        $num_group = mysql_num_rows($result_group);
        if($num_group == 0)
        {
            echo "<tr><td colspan='5'><strong><font color='#d9534f'><center><h2>ไม่มีข้อมูลในระบบ</h2></center></font></strong></td></tr>";
        }else
        {
            $numgroup = 1;
            while($row_group = mysql_fetch_array($result_group))
            {
                echo "<tr>";
                echo "<td>".$numgroup."</td>";
                echo "<td>".$row_group['name_group_user']."</td>";
                echo "<td><a class=\"btn btn-info\" href=\"#\" onclick=\"group_edit($row_group[id_group_users])\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\"></span> แก้ไขชื่อฝ่าย</a>&nbsp;<a class=\"btn btn-danger\" href=\"#\" onclick=\"group_delete($row_group[id_group_users])\" role=\"button\"><i class=\"fa fa-trash-o fa-fw\"></i> ลบชื่อฝ่าย</a></td>";
                $numgroup++;
            }
        }
        ?>
    </table>
    </div>
</div>



<?php 
    include_once('layout/footer.php');
?>