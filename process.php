<?php include_once('include/Conn.php');
    error_reporting( error_reporting() & ~E_NOTICE );
    date_default_timezone_set("asia/bangkok");
    $create_date = date("Y-m-d");

    //--Permission--//
    if(isset($_REQUEST['role_name']))
    {
        $role_name = mysql_real_escape_string($_POST['role_name']);
        $role_value = mysql_real_escape_string($_POST['role_value']);
        
        $ch_data_role = "INSERT INTO `role`(`id_role`, `role_name`, `role_value`) VALUES (NULL,'".$role_name."','".$role_value."')";
        $result_data_role = mysql_query($ch_data_role);
        if($result_data_role)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['id_role_edit']))
    {
        echo $_REQUEST['id_role_edit'];
    }
    if(isset($_REQUEST['id_role']))
    {
        $id_role = mysql_real_escape_string($_POST['id_role']);
        $role_name = mysql_escape_string($_POST['edit_role_name']);
        $role_value = mysql_real_escape_string($_POST['edit_role_value']);
        $check_data_role = "UPDATE `role` SET `role_name`='".$role_name."',`role_value`='".$role_value."' WHERE id_role='".$id_role."' ";
        $result_data_role = mysql_query($check_data_role);
        if($result_data_role)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['id_role_del']))
    {
        $id_role_del = mysql_real_escape_string($_POST['id_role_del']);
        $check_data_role = "DELETE FROM `role` WHERE id_role='".$id_role_del."'";
        $result_data_role = mysql_query($check_data_role);
        if($result_data_role)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    //--GroupUser--//
    if(isset($_REQUEST['name_group']))
    {
        $data_name_group = mysql_real_escape_string($_POST['name_group']);
        $check_data_group = "INSERT INTO `group_users`(`id_group_users`, `name_group_user`) VALUES (NULL,'".$data_name_group."')";
        $result_data_group = mysql_query($check_data_group);
        if($result_data_group)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['id_group_data']))
    {
        echo $_REQUEST['id_group_data'];
    }
    if(isset($_REQUEST['data_condition_member']))
    {
        $sql_data_group = "select * from group_users";
        $result_data_group = mysql_query($sql_data_group);
        echo "<select class='form-control' id='search_member'>";
        while($row_data_group = mysql_fetch_array($result_data_group))
        {
            echo "<option value='$row_data_group[id_group_users]'>$row_data_group[name_group_user]</option>";
        }
        echo "</select>";
    }
    if(isset($_POST['data_condition_room']))
    {
        $sql_data_room = "select * from room";
        $result_data_room = mysql_query($sql_data_room);
        echo "<select class='form-control' id='txt_searchreserv'>";
        while($row_data_room = mysql_fetch_array($result_data_room))
        {
            echo "<option value='$row_data_room[id_room]'>$row_data_room[name_room]</option>";
        }
        echo "</select>";        
    }
    if(isset($_REQUEST['id_status_room']))
    {
        $id_statusRoom = mysql_real_escape_string($_POST['id_status_room']);
        $name_statusRoom = mysql_real_escape_string($_POST['name_status_room']);
        $check_statusRoom = "UPDATE status_room SET";
        $check_statusRoom .= " `name_status_room`='".$name_statusRoom."'";
        $check_statusRoom .= " WHERE id_status_room='".$id_statusRoom."'";
        $result_staturRoom = mysql_query($check_statusRoom);
        if($result_staturRoom)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['id_status_edit']))
    {
        echo $_REQUEST['id_status_edit'];
    }
    if(isset($_REQUEST['id_status_delete']))
    {
        $id_status = mysql_real_escape_string($_POST['id_status_delete']);
        $check_status = "DELETE status_room WHERE id_status_room='".$id_status."'";
        $result_status = mysql_query($check_status);
        if($result_status)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['data_condition_role']))
    {
        $sql_data_group = "select * from role";
        $result_data_group = mysql_query($sql_data_group);
        echo "<select class='form-control' id='search_member'>";
        while($row_data_group = mysql_fetch_array($result_data_group))
        {
            echo "<option value='$row_data_group[id_role]'>$row_data_group[role_name]</option>";
        }
        echo "</select>";        
    }
    if(isset($_REQUEST['id_group_edit']))
    {
        $id_group = mysql_real_escape_string($_POST['id_group_edit']);
        $name_group = mysql_real_escape_string($_POST['edit_name_group']);
        $check_data_edit = "UPDATE `group_users` SET `name_group_user`='".$name_group."' WHERE id_group_users='".$id_group."'";
        $result_data_edit = mysql_query($check_data_edit);
        if($result_data_edit)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    if(isset($_REQUEST['id_group_del']))
    {
        $id_group = mysql_real_escape_string($_POST['id_group_del']);
        $check_data_group = "DELETE FROM `group_users` WHERE id_group_users='".$id_group."'";
        $result_data_group = mysql_query($check_data_group);
        if($result_data_group)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    //--GroupUser--//
    //-----------------------------------------------------------------------------------//
    //--User--//
    if(isset($_REQUEST['name']))
    {
        $create_date = DATE("Y-m-d");
        $title = mysql_real_escape_string($_POST['title']);
        $name = mysql_real_escape_string($_POST['name']);
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string(md5($_POST['password']));
        $email = mysql_real_escape_string($_POST['email']);
        $group = mysql_real_escape_string($_POST['group']);
        $role = mysql_real_escape_string($_POST['role']);
        $ch_data_user = "INSERT INTO `users`(`id_user`, `username_log`, `password_log`,`title_id`, `name_log`, `email_log`, `create_date`, `id_group_users`, `id_role`) 
        VALUES (NULL,'".$username."','".$password."','".$title."','".$name."','".$email."','".$create_date."','".$group."','".$role."')";
         // echo $ch_data_user;
        $result_data_user = mysql_query($ch_data_user);
        if($result_data_user == 1)
        {
            echo 1;
        }else
        {
            echo 0;
        }

    }
    //---editmember.php---//
    if(isset($_REQUEST['id_user']))
    {
        $title = mysql_real_escape_string($_POST['edit_title']);
        $name = mysql_real_escape_string($_POST['edit_name_log']);
        $username = mysql_real_escape_string($_POST['edit_username_log']);
        $password = mysql_real_escape_string($_POST['edit_password_log']);
        $email = mysql_real_escape_string($_POST['edit_email_log']);
        $group = mysql_real_escape_string($_POST['edit_group_user']);
        $role = mysql_real_escape_string($_POST['edit_role']);
        $id_user = mysql_real_escape_string($_POST['id_user']);

        $ch_user_edit = "UPDATE `users` SET 
        `username_log`='".$username."',";
        if(!empty($password)){

            $ch_user_edit .= " `password_log`='".md5($password)."',";
        }
        $ch_user_edit .= "`title_id`='".$title."',";
        $ch_user_edit .= "`name_log`='".$name."',";
        $ch_user_edit .= "`email_log`='".$email."',";
        $ch_user_edit .= "`id_group_users`='".$group."',";
        $ch_user_edit .= "`id_role`='".$role."'";
        $ch_user_edit .= "WHERE id_user='".$id_user."'";
        $result_user_edit = mysql_query($ch_user_edit);
        if($result_user_edit)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    //---editmember.php---//
    //---editUser.php---//
    if(isset($_REQUEST['uid_user']))
    {
        $title = mysql_real_escape_string($_POST['title_edit']);
        $idUser = mysql_real_escape_string($_POST['uid_user']);
        $usernameLog = mysql_real_escape_string($_POST['username_edit']);
        $nameLog = mysql_real_escape_string($_POST['name_edit']);
        $emailLog = mysql_real_escape_string($_POST['email_edit']);
        $newPass = mysql_real_escape_string($_POST['new_pass']);
        //---SQL---//
        $UpdateUser = "UPDATE users SET";
        $UpdateUser .= " username_log='".$usernameLog."'";
        if(!empty($newPass))
        {
            $UpdateUser .= ", password_log='".md5($newPass)."'";
        }
        $UpdateUser .= ", title_id='".$title."'";
        $UpdateUser .= ", name_log='".$nameLog."'";
        $UpdateUser .= ", email_log='".$emailLog."'";
        $UpdateUser .= " WHERE id_user='".$idUser."'";
        $resultUser = mysql_query($UpdateUser);
        if($resultUser)
        {
            echo 1;
        }else
        {
            echo 0;
        }

    }
    //---editUser.php---//
    if(isset($_REQUEST['search_data_member']))
    {
        print_r($_REQUEST);
    }
    if(isset($_REQUEST['id_user_del']))
    {
        $iduser = mysql_real_escape_string($_POST['id_user_del']);
        $check_user_del = "delete from users where id_user='".$iduser."'";
        $result_user_del = mysql_query($check_user_del);
        if($result_user_del)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    //--User--//
    //--Room--//
    if(isset($_REQUEST['btn_create_room']))
    {
        //RUNROOM//
        $CodeRoom = "RVB";

        $sql = "SELECT MAX(id_room) AS lastid FROM room";
        $q = mysql_query($sql);
        $row = mysql_fetch_array($q);
        $maxId = substr($row['lastid'],-5);
        $maxId = ($maxId + 1);
        $maxId = substr("00000".$maxId,-5);
        $nextId = $CodeRoom.$maxId;
        //--RUNROOM--//

        if(!empty($_FILES["img_room"]["name"]))
        {
            $img_data = trim(mysql_real_escape_string($_FILES['img_room']['name']));
            $sp_img = explode(".",$img_data);
            $type_img = $sp_img[1];
            $img_data = "room-ImgUpload".time().".".$type_img;
            $upload_dir = "images/img_room/";
            move_uploaded_file($_FILES['img_room']['tmp_name'],$upload_dir.$img_data);
        }else
        {
                $name = mysql_real_escape_string($_POST['name_room']);
                $desc = mysql_real_escape_string($_POST['desc_room']);
                $num = mysql_real_escape_string($_POST['num_room']);
                $status = mysql_real_escape_string($_POST['status_room']);
                $update_id = mysql_real_escape_string($_POST['update_id']);
                $ch_data_room = "INSERT INTO `room`(`id_room`, `name_room`, `desc_room`, `num_room`, `img_room`, `id_status_room`, `create_date`, `update_id`) 
                VALUES ('".$nextId."','".$name."','".$desc."','".$num."','".$img_data."','".$status."','".$create_date."','".$update_id."')";
                $result_room = mysql_query($ch_data_room);
                if($result_room == 1)
                {
                    echo "<script>alert('เพิ่มข้อมูลห้องเรียบร้อยแล้ว')</script>";
                    echo "<script>window.location.href='room.php';</script>";
                }else
                {
                    echo "<script>alert('ไม่สามารถเพิ่มห้องได้ กรุณาลองใหม่อีกครั้ง')</script>";
                    echo "<script>window.history.back();</script>";
                }
        }
    }
    if(isset($_REQUEST['btn_edit_room']))
    {
        if(!empty($_FILES['img_room_edit']['name']))
        {
            $imgroom_edit = mysql_real_escape_string(basename($_FILES['img_room_edit']['name']));
            $ext_img = strtolower(end(explode('.', $imgroom_edit)));
            $imgroom_edit = "room-ImgUpload-".time().".".$ext_img;
            $upload_dir = "images/img_room/";
            if(move_uploaded_file($_FILES['img_room_edit']['tmp_name'],$upload_dir.$imgroom_edit))
            {
                unlink("images/img_room".$_REQUEST['img_room_old']);
            }
        }
        $name_edit = mysql_real_escape_string($_POST['name_room_edit']);
        $desc_edit = mysql_real_escape_string($_POST['desc_room_edit']);
        $num_edit = mysql_real_escape_string($_POST['num_room_edit']);
        $status_edit = mysql_real_escape_string($_POST['status_room_edit']);
        $update_id = mysql_real_escape_string($_POST['update_id']);
        $id_room_edit = mysql_real_escape_string($_POST['id_room_edit']);
        $ch_data_room = "UPDATE `room` SET 
        `name_room`='".$name_edit."',
        `desc_room`='".$desc_edit."',
        `num_room`='".$num_edit."',
        `img_room`='".$imgroom_edit."',
        `id_status_room`='".$status_edit."',
        `update_id`='".$update_id."' 
        WHERE id_room='".$id_room_edit."'";
        $result_data_room = mysql_query($ch_data_room);
        if($result_data_room == 1)
        {
                echo "<script>alert('แก้ไขข้อมูลห้องเรียบร้อยแล้ว')</script>";
                echo "<script>window.location.href='room.php';</script>";
        }else
        {
                echo "<script>alert('ไม่สามารถแก้ไขข้อมูลห้องได้ กรุณาลองใหม่อีกครั้ง')</script>";
                echo "<script>window.history.back();</script>";
        }
    }
    if(isset($_REQUEST['id_room_del']))
    {
        $id_room_del = mysql_real_escape_string($_POST['id_room_del']);
        $check_room_data = "delete from room where id_room='".$id_room_del."'";
        $result_room_data = mysql_query($check_room_data);
        if($result_room_data)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    //--Room--//
    //-----------------------------------------------------------------------------------//
    if(isset($_REQUEST['id_reserv']))
    {
        $id_reserv = mysql_real_escape_string($_POST['id_reserv']);
        $check_reserv = "UPDATE reserv SET id_status_reserv = '2' where id_reserv='".$id_reserv."'";
        $result_reserv = mysql_query($check_reserv);
        if($result_reserv)
        {
            echo 1;
        }else
        {
            echo 0;
        }        
    }
    if(isset($_REQUEST['id_reserv_del']))
    {
        $id_reserv_del = mysql_real_escape_string($_POST['id_reserv_del']);
        $check_reserv_del = "DELETE FROM reserv where id_reserv='".$id_reserv_del."'";
        $result_reserv_del = mysql_query($check_reserv_del);
        if($result_reserv_del)
        {
            echo 1;
        }else
        {
            echo 0;
        }         
    }
?>