<?php if(isset($_POST['get_datamember']))
{
    error_reporting( error_reporting() & ~E_NOTICE );
    include_once("include/Conn.php");
?>
    <p>
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
    </p>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ชื่อ-นามสกุล</th>
            <th width="18%">ชื่อผู้ใช้งาน</th>
            <th width="15%">ฝ่าย</th>
            <th width="15%">สิทธิ์ผู้ใช้งาน</th>
            <th width="20%">&nbsp;</th>
        </tr>
        <?php
        $str_page = mysql_real_escape_string($_POST['page']);
        $str_search_member = mysql_escape_string($_POST['search_member']);
        $str_data_condition = mysql_real_escape_string($_POST['data_condition']);

        $dataUser = "select * from users as u 
        join group_users as gu on(gu.id_group_users = u.id_group_users)
        left join title as t on(t.title_id = u.title_id)
        join role as r on(r.id_role = u.id_role)";
        if($str_search_member && $str_data_condition != "")
        {
            $dataUser .= " WHERE $str_data_condition LIKE '%".$str_search_member."%'";
        }
        $resultUser = mysql_query($dataUser);
        $numUser = mysql_num_rows($resultUser);
        if($numUser == 0)
        {
            echo "<tr><td colspan='6' align='center'><font color='#d9534f' size='5px'>ไม่มีข้อมูลในระบบ!</font></td></tr>";
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
        if($numUser<=$per_page)
        {
            $num_pages = 1;
        }else if(($numUser % $per_page) == 0)
        {
            $num_pages = ($numUser/$per_page);
        }else
        {
            $num_pages = ($numUser/$per_page)+1;
            $num_pages = (int)$num_pages;
        }
        $dataUser .= " ORDER BY id_user ASC LIMIT $start_page,$per_page";
        $resultUser = mysql_query($dataUser);
            $num = 1;
            while($rowUser = mysql_fetch_array($resultUser))
            {
                echo "<tr>";
                echo "<td>".$rowUser['title_name']." ".$rowUser['name_log']."</td>";
                echo "<td>".$rowUser['username_log']."</td>";
                echo "<td>".$rowUser['name_group_user']."</td>";
                echo "<td>".$rowUser['role_name']."</td>";
                echo "<td><a class=\"btn btn-info\" href=\"#\" onclick=\"member_edit($rowUser[id_user])\" role=\"button\"><i class=\"fa fa-pencil fa-fw\"></i>&nbsp;แก้ไขข้อมูล</a>";
                echo "<a class=\"btn btn-danger\" href=\"#\" onclick=\"member_delete($rowUser[id_user])\" role=\"button\"><i class=\"fa fa-trash-o fa-fw\"></i>ลบข้อมูล</a></td>";
                echo "</tr>";
            $num++;
            }
        ?>
    </table>
    <p>มีทั้งหมด <?php echo $numUser;?> รายการ</p>
    <nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if($prev_page)
        {
        ?>
        <li>
        <a href="#" onclick="load_member('<?php echo $prev_page;?>')" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php } ?>
        <?php for($i=1;$i<=$num_pages;$i++){
            if($i == $page)
            {
                $cur_page = "class='active'";
            }else
            {
                $cur_page = "";
            }
        ?>
            <li <?php echo $cur_page;?>><a href="#" onclick="load_member('<?php echo $i;?>')"><?php echo $i;?></a></li>
    <?php } ?>
    <?php if($page != $num_pages)
    {?>
        <li>
            <a href="#" onclick="load_member('<?php echo $Next_page;?>')" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    <?php } ?>
    </ul>
</nav>
    <?php } ?>