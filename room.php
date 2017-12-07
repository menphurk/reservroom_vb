<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');

?>
<div class="col-md-12">
    <div class="page-header">
        <h1>รายชื่อห้องประชุม</h1>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <table class="table table-bordered table-striped">
        <?php 
            $dataRoom = "select * from room as r
            join status_room as st on(st.id_status_room = r.id_status_room)
            order by id_room ASC";
            $resultRoom = mysql_query($dataRoom);
            $numRoom = mysql_num_rows($resultRoom);
            $num_room = 1;
            while($rowRoom = mysql_fetch_array($resultRoom))
            {
        ?>
        <tr>
            <th colspan="3"><?php echo $rowRoom['id_room'];?> : <?php echo $rowRoom['name_room'];?></th>
        </tr>
        <tr>
            <td rowspan="2" width="15%">
            <?php
                if($rowRoom['img_room'] == 0)
                {
                    echo "<img src='images/no-image.png'>";
                }else
                {
                    echo "<img src='images/$rowRoom[img_room]'>";
                }
            ?>
            </td>
            <td colspan="3">รายละเอียด : <?php echo $rowRoom['desc_room'];?></td>
        </tr>
        <tr height="35">
            <td>จำนวน : <strong><?php echo $rowRoom['num_room'];?></strong> ที่นั่ง</td>
            <td>สถานะ : 
                <?php $status_room = $rowRoom['id_status_room'];
                        echo "<strong>";
                    if($status_room == 1)
                    {
                        echo "<font color='#5cb85c'>".$rowRoom['name_status_room']."</font>";
                    }else if($status_room == 2)
                    {
                        echo "<font color='#d9534f'>".$rowRoom['name_status_room']."</font>";
                    }else if($status_room == 3)
                    {
                        echo "<font color='#f0ad4e'>".$rowRoom['name_status_room']."</font>";
                    }
                        echo "</strong>";

                ?>

            </td>
        </tr>
        <tr>
            <td colspan="3"><button class="btn btn-white btn-info" type="button" onclick="room_edit('<?php echo $rowRoom['id_room'];?>')"><i class="fa fa-pencil fa-fw"></i></button>
            &nbsp;<a class="btn btn-white btn-danger" href="#" onclick="room_delete('<?php echo $rowRoom['id_room'];?>')" role="button"><i class="fa fa-trash-o fa-fw"></i></a></td>
        </tr>
            <?php } ?>
        </table>        
        </div>
    </div>
</div>

<?php 
    include_once('layout/footer.php');
?>