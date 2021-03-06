<?php session_start();
if(isset($_POST['get_dataReserv']))
{
    include_once('include/Conn.php');
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
?>
    <p>

    </p>
    <hr>
    <table class="table table-striped table-bordered" cellspacing="0">
        <tr>
            <th width="2%">เลขที่จอง</th>
            <th width="5%">สถานะ</th>
            <th width="15%">หัวข้อประชุม</th>
            <th width="15%">ห้องประชุม</th>
            <th width="10%">วันที่-เวลาเริ่มต้น</th>
            <th width="10%">วันที่-เวลาสิ้นสุด</th>
            <th width="10%">ชื่อผู้จอง</th>
            <th width="10%">วันที่จอง</th>
            <th width="8%" align="center">&nbsp;</th>
        </tr>
    <?php
    $str_page = mysql_real_escape_string($_POST['page']);
    $str_search = mysql_real_escape_string($_POST['search_reserv']);
    $str_search_con = mysql_real_escape_string($_POST['data_condition']);

    $get_reserv = " SELECT * FROM reserv as rs";
    $get_reserv .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
    $get_reserv .= " JOIN users as u on(u.id_user = rs.update_id)";
    $get_reserv .= " JOIN title as t on(t.title_id = u.title_id)";
    if($str_search && $str_search_con != "")
    {
        $get_reserv .= " WHERE $str_search_con LIKE '%".$str_search."%'";
    }
    $result_event = mysql_query($get_reserv);
    $num_event = mysql_num_rows($result_event);
    if($num_event == 0)
    {
        echo "<tr><td colspan='8' align='center'><font color='#d9534f' size='5px'>ไม่มีข้อมูลในระบบ!</font></td></tr>";
    }
    $per_page = 10;
    $page = $str_page;
    if(!$page)
    {
        $page = 1;
    }
    $prev_page = $page-1;
    $Next_page = $page+1;

    $start_page = (($per_page*$page)-$per_page);
    if($num_event<=$per_page)
    {
        $num_pages = 1;
    }else if(($num_event % $per_page) == 0)
    {
        $num_pages = ($num_event/$per_page);
    }else
    {
        $num_pages = ($num_event/$per_page)+1;
        $num_pages = (int)$num_pages;
    }
    $get_reserv .= " ORDER BY id_reserv DESC LIMIT $start_page,$per_page";
    
    $result_event = mysql_query($get_reserv);
        while($row_event = mysql_fetch_array($result_event))
        {

            echo "<tr id='pagination_reserv'>";
            echo "<td>".$row_event['id_reserv']."</td>";
            echo "<td>";
            if($row_event['id_status_reserv'] == '1'){
                echo "<font color='#A0522D'>ไม่อนุมัติ</font>";
            }else if($row_event['id_status_reserv'] == '2')
            {
                echo "<font color='#5cb85c'>อนุมัติ</font>";
            }else if($row_event['id_status_reserv'] == '3')
            {
                echo "<font color='#d9534f'>ยกเลิก</font>";
            }
            echo "</td>";
            echo "<td>".$row_event['topic']."</td>";
            echo "<td>".$row_event['name_room']."</td>";

            $startday = $row_event['startday'];
            $ex_startday = explode("-",$startday);
            $convert_startmonth = $ex_startday[1];
            $convert_startmonth = $thai_month_arr[$convert_startmonth];
            $ex_startday[0] = $ex_startday[0]+543;
            $new_convertstartevent = $ex_startday[2]."-".$convert_startmonth."-".$ex_startday[0];

            $endday = $row_event['endday'];
            $ex_endday = explode("-",$endday);
            $convert_endmonth = $ex_endday[1];
            $ex_endday[0] = $ex_endday[0]+543;
            $convert_endmonth = $thai_month_arr[$convert_endmonth];
            $new_convertendevent = $ex_endday[2]."-".$convert_endmonth."-".$ex_endday[0];

            //ConvertDate&Time Fidle//
            $createDate = $row_event['create_date'];
            $ex_createDate = explode(" ",$createDate);
            //Date//
            $exp_createDate = explode("-",$ex_createDate[0]);
            $convert_Datemonth = $thai_month_arr[$exp_createDate[1]];
            $convert_DateDay = $exp_createDate[2];
            $convert_DateYear = $exp_createDate[0]+543;
            $str_connvertDate = $convert_DateDay."-".$convert_Datemonth."-".$convert_DateYear;
            //Time//
            $convert_Time = $ex_createDate[1];

            echo "<td>".$new_convertstartevent."<br>".substr($row_event['starttime'],0,-3)."&nbsp;น.</td>";
            echo "<td>".$new_convertendevent."<br>".substr($row_event['endtime'],0,-3)."&nbsp;น.</td>";
            echo "<td>".$row_event['title_name']."&nbsp;".$row_event['name_log']."</td>";
            echo "<td>".$str_connvertDate."</td>";
            echo "<td>";
            echo "<center><button class=\"btn btn-app btn-info btn-xs\" onclick=\"javascript:window.location.href='show_reserv.php?id_reserv=$row_event[id_reserv]'\">
            <i class=\"ace-icon fa fa-info bigger-120\"></i>ดูข้อมูล</button></center>";
            echo "</tr>";
        ?>
    <?php
    }
    ?>
    </table>
    <p>มีทั้งหมด <?php echo $num_event;?> รายการ</p>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if($prev_page)
            {
            ?>
            <li>
            <a href="#" onclick="load_data('<?php echo $prev_page;?>')" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>
            <?php } ?>
            <?php 
            $RankPage = 30;
            $LastShowPage = $page + $RankPage;
            if($LastShowPage > $num_pages){
                $LastShowPage = $num_pages;
            }
            $FirstShowPage = $page - $RankPage;
            if($FirstShowPage < 1){
                $FirstShowPage = 1;
            }
            for($i=$FirstShowPage;$i<=$LastShowPage;$i++){
                if($i == $page)
                {
                    $cur_page = "class='active'";
                }else
                {
                    $cur_page = "";
                }
            ?>
                <li <?php echo $cur_page;?>><a href="#" onclick="load_data('<?php echo $i;?>')"><?php echo $i;?></a></li>
        <?php } ?>
        <?php if($page != $num_pages)
        {?>
            <li>
                <a href="#" onclick="load_data('<?php echo $Next_page;?>')" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
        </ul>
    </nav>
<?php } ?>