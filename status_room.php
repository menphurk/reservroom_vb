<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h1>&nbsp;สถานะห้องประชุม</h1>
    </div>
    <div class="col-md-6 col-md-offset-3">
    <table class="table table-bordered table-striped">
        <tr>
            <th width="3%">ลำดับ</th>
            <th width="40%">รายการ</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        $data_statusroom = "select * from status_room";
        $result_statusroom = mysql_query($data_statusroom);
        $num_statusroom = mysql_num_rows($result_statusroom);
        if($num_statusroom == 0)
        {
            echo "<tr><td colspan='5'><strong><font color='#d9534f'><center><h2>ไม่มีข้อมูลในระบบ</h2></center></font></strong></td></tr>";
        }else
        {
            $num_status = 1;
            while($row_statusroom = mysql_fetch_array($result_statusroom))
            {
            
                echo "<tr>";
                echo "<td>".$num_status."</td>";
                echo "<td>".$row_statusroom['name_status_room']."</td>";
                echo "<td><a class=\"btn btn-info\" href=\"#\" onclick=\"statusR_edit('$row_statusroom[id_status_room]')\" role=\"button\"><i class=\"fa fa-pencil fa-fw\"></i>&nbsp;แก้ไขข้อมูล</a><a class=\"btn btn-danger\" href=\"#\" onclick=\"statusR_delete('$row_statusroom[id_status_room]')\" role=\"button\"><i class=\"fa fa-trash-o fa-fw\"></i>ลบข้อมูล</a></td>";
                echo "</tr>";
                $num_status++;
            }
        }
        ?>
    </table>
    </div>
</div>
<?php 
    include_once('layout/footer.php');
?>