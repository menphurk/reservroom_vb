<?php 
    include_once('layout/header.php');
    include_once('layout/menu.php');
    include_once('include/Conn.php');
?>
<div class="col-md-12">
    <div class="page-header">
        <h1><i class="fa fa-history" aria-hidden="true"></i>&nbsp;ประวัติการจอง</h1>
    </div>
    
    <table class="table table-bordered table-striped">
        <tr>
            <th width="5%">ลำดับ</th>
            <th width="25%">รายการจอง</th>
            <th width="15%">ห้องประชุม</th>
            <th width="10%">วันที่จอง</th>
            <th width="10%">วันที่สิ้นสุด</th>
        </tr>
        <?php
            $thai_month_arr=array(
                        "00"=>"",
                        "01"=>"มกราคม",
                        "02"=>"กุมภาพันธ์",
                        "03"=>"มีนาคม",
                        "04"=>"เมษายน",
                        "05"=>"พฤษภาคม",
                        "06"=>"มิถุนายน", 
                        "07"=>"กรกฎาคม",
                        "08"=>"สิงหาคม",
                        "09"=>"กันยายน",
                        "10"=>"ตุลาคม",
                        "11"=>"พฤศจิกายน",
                        "12"=>"ธันวาคม"
            );
            $dataUser_reserv = "SELECT * FROM reserv as rs
            JOIN room as r ON(r.id_room = rs.id_room)
            WHERE rs.update_id='".$_SESSION['ses_id']."'";
            $result_dataUser = mysql_query($dataUser_reserv);
            $num_dataUser = mysql_num_rows($result_dataUser);
            if($num_dataUser == 0)
            {
                echo "<tr>";
                echo "<td colspan='5'>No Data!</td>";
                echo "</tr>";
            }else
            {
                $list_reserv = 1;
                while($row_dataUser = mysql_fetch_array($result_dataUser))
                {
                    echo "<tr>";
                    echo "<td>".$list_reserv."</td>";
                    echo "<td>".$row_dataUser['topic']."</td>";
                    echo "<td>".$row_dataUser['name_room']."</td>";

                    $startday = $row_dataUser['startday'];
                    $ex_startday = explode("-",$startday);
                    $convert_startmonth = $ex_startday[1];
                    $convert_startmonth = $thai_month_arr[$convert_startmonth];
                    $new_convertstartevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];

                    $endday = $row_dataUser['endday'];
                    $ex_endday = explode("-",$endday);
                    $convert_endmonth = $ex_endday[1];
                    $convert_endmonth = $thai_month_arr[$convert_endmonth];
                    $new_convertendevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];

                    echo "<td>".$new_convertstartevent."<br>".$row_dataUser['starttime']."</td>";
                    echo "<td>".$new_convertendevent."<br>".$row_dataUser['endtime']."</td>";
                    echo "</tr>";
                    $list_reserv++;
                }
            } 
        ?>
    </table>
</div>

<?php 
    include_once('layout/footer.php');
?>