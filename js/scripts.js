﻿$(function(){
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
        },
        eventRender: function (event, element) {
            element.attr('href', 'javascript:void(0);');
            element.click(function() {
                $("#startTime").html(moment(event.start).format('Do MMMM YYYY HH:mm'));
                $("#endTime").html(moment(event.end).format('Do MMMM YYYY HH:mm'));
                $("#room").html(event.room);
                $("#name").html(event.name);
                $('#modalTitle').html(event.title);
                $('#desc').html(event.desc);
                $('#eventUrl').attr('href',event.url);
                $("#fullCalModal").modal();
            });
        },
        height: 500,
        buttonIcons:{
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'         
        },
        editable: false,
        events: "data_calendar.php",
        eventLimit:false,
    });
    //Menu Active
    $('.active > a').click(function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
    });
    
    $('.submenu > li').click(function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        $(this).parent('ul').prev('a').addClass('active');
        
    });

    $("#btn_login").click(function(){
        var username = $("#username_log").val();
        var password = $("#password_log").val();
        if(username == "")
        {
            alert("กรุณากรอกชื่อผู้ใช้งานก่อนครับ");
            $("#username_log").focus();
            return false;
        }else if(password == "")
        {
            alert("กรุณากรอกรหัสผ่านก่อนครับ");
            $("#password_log").focus();
            return false;
        }else 
        {
            return true;
        }
    });

    $("#btn_save_user").click(function(){
        var title = $("#title").val();
        var name = $("#name_log").val();
        var username = $("#username_log").val();
        var password = $("#password_log").val();
        var email = $("#email_log").val();
        var group = $("#group_user").val();
        var role = $("#role").val();
        if(title == "")
        {
            alert("กรุณาเลือกคำนำหน้าชื่อก่อนครับ");
            $("#title").focus();
            return false;
        }else if(name == "")
        {
            alert("กรุณากรอกชื่อก่อนครับ");
            $("#name_log").focus();
            return false;
        }else if(username == "")
        {
            alert("กรุณากรอกชื่อผู้ใช้งานก่อนครับ");
            $("#username_log").focus();
            return false;
        }else if(password == "")
        {
            alert("กรุณากรอกรหัสผ่านก่อนครับ");
            $("#password_log").focus();
            return false;
        }else if(group == "")
        {
            alert("กรุณาเลือกฝ่ายก่อนครับ");
            $("#group_user").focus();
            return false;
        }else if(role == "")
        {
            alert("กรุณาเลือกสิทธิ์ก่อนครับ");
            $("#role").focus();
            return false;            
        }else{
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "title="+title+"&name="+name+"&username="+username+"&password="+password+"&email="+email+"&group="+group+"&role="+role,
                success: function(ch_add_res)
                {
                    if(ch_add_res == 1)
                    {
                        alert("สร้างข้อมูล "+name+" เรียบร้อยแล้ว");
                        window.location.href = "member.php";
                    }else
                    {
                        alert("ไม่สามารถสร้างข้อมูล "+name+" ได้ กรุณาลองใหม่อีกครั้ง");
                        window.location.reload();                     
                    }
                }
            });
        }
    });
    $("#btn_edit_user").click(function(){
        var title = $("#title").val();
        var username = $("#username_log").val();
        var name = $("#name_log").val();
        var email = $("#email_log").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();
        var uid_user = $("#uid_user").val();
        if(uid_user != "")
        {
            if(confirm_password != new_password)
            {
                alert("รหัสผ่านไม่ตรงกัน กรุณากรอกให้ตรงกันด้วยครับ");
                $("#new_password").focus();
                $("#confirm_password").focus();
                return false;
            }else
            {
                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: "uid_user="+uid_user+"&title_edit="+title+"&username_edit="+username+"&name_edit="+name+"&email_edit="+email+"&new_pass="+new_password+"&confirm_pass="+confirm_password,
                    success: function(res_edit_user)
                    {
                        if(res_edit_user == 1)
                        {
                            alert("เปลี่ยนแปลงข้อมูลเรียบร้อยแล้ว");
                            window.location.href='reserv.php';
                        }else
                        {
                            alert("ไม่สามารถเปลี่ยนแปลงข้อมูลได้ กรุณาลองใหม่อีกครั้ง!");
                            window.location.reload();                            
                        }
                    }
                });
                return true;
            }
        }
    });

    $("#btn_create_group").click(function(){
        var name_group = $("#group").val();
        if(name_group == "")
        {
            alert("กรุณากรอกชื่อฝ่ายก่อนครับ");
            $("#group").focus();
            return false;
        }else
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "name_group="+name_group,
                success: function(ch_group_res)
                {
                    if(ch_group_res == 1)
                    {
                        alert("สร้าง "+name_group+" เรียบร้อยแล้ว");
                        window.location.href = 'groupuser.php';
                    }else
                    {
                        alert("ไม่สามารถสร้าง "+name_group+" ได้ กรุณาลองใหม่อีกครั้ง");
                        window.location.reload();
                    }
                }
            });
        }
    });

    $("#btn_edit_group").click(function(){
        var edit_name_group = $("#edit_name_group").val();
        var id_group = $("#id_group_user").val();
        if(id_group != "")
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "edit_name_group="+edit_name_group+"&id_group_edit="+id_group,
                success: function(edit_group_res)
                {
                    if(edit_group_res == 1)
                    {
                        alert("แก้ไข "+edit_name_group+" เรียบร้อยแล้ว");
                        window.location = 'groupuser.php';
                    }else
                    {
                        alert("ไม่สามารถแก้ไข "+edit_name_group+" ได้ กรุณาลองใหม่อีกครั้ง");
                        window.location.reload();
                    }
                }
            })
        }
    });

    $("#btn_create_role").click(function(){
        var role_name = $("#role_name").val();
        var role_value = $("#role_value").val();
        if(role_name == "")
        {
            alert("กรุณากรอกชื่อสิทธิ์ผู้ใช้งานก่อนครับ");
            $("#role_name").focus();
            return false;
        }else
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "role_name="+role_name+"&role_value="+role_value,
                success: function(ch_role_res)
                {
                    if(ch_role_res == 1)
                    {
                        alert("บันทึกข้อมูลเรียบร้อยแล้ว");
                        window.location.href = "role.php";
                    }else
                    {
                        alert("ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง!");
                        window.location.reload();
                    }
                }
            });
            return true;
        }
    });
    $("#btn_edit_role").click(function(){
        var edit_role_name = $("#edit_role_name").val();
        var edit_role_value = $("#edit_role_value").val();
        var id_role = $("#id_role").val();
        if(id_role != "")
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "edit_role_name="+edit_role_name+"&edit_role_value="+edit_role_value+"&id_role="+id_role,
                success: function(edit_role_res)
                {
                    if(edit_role_res == 1)
                    {
                        alert("แก้ไข "+edit_role_name+" เรียบร้อยแล้ว");
                        window.location = 'role.php';                
                    }else
                    {
                        alert("ไม่สามารถแก้ไข "+ edit_role_name +" ได้ กรุณาลองใหม่อีกครั้ง");
                        window.location.reload();                        
                    }
                }
            });
        }
    });
    $("#btn_create_room").click(function(){
        var name_room = $("#name_room").val();
        var desc_room = $("#desc_room").val();
        var num_room = $("#num_room").val();
        if(name_room == "")
        {
            alert("กรุณากรอกชื่อห้องประชุมครับ");
            $("#name_room").focus();
            return false;
        }else if(num_room == "")
        {
            alert("กรุณากรอกจำนวนด้วยครับ");
            $("#num_room").focus();
            return false;
        }else
        {
            return true;
        }

    });
    //
    //

    $("#btn_edit_member").click(function(){
        var edit_title = $("#edit_title").val();
        var edit_name_log = $("#edit_name_log").val();
        var edit_username_log = $("#edit_username_log").val();
        var edit_email_log = $("#edit_email_log").val();
        var edit_group_user = $("#edit_group_user").val();
        var edit_role = $("#edit_role").val();
        var edit_password = $("#new_password").val();
        var id_user = $("#id_user").val();
        if(id_user != "")
        {
            $.ajax({
                type:"POST",
                url: "process.php",
                data: "edit_name_log="+edit_name_log+"&edit_title="+edit_title+"&edit_username_log="+edit_username_log+"&edit_password_log="+edit_password+"&edit_email_log="+edit_email_log+"&edit_group_user="+edit_group_user+"&edit_role="+edit_role+"&id_user="+id_user,
                success: function(ch_editUser_res)
                {
                    if(ch_editUser_res == 1)
                    {
                        alert('แก้ไขข้อมูล '+edit_name_log+' เรียบร้อยแล้ว');
                        window.location.href = 'member.php';
                    }else
                    {
                        alert('ไม่สามารถแก้ไขข้อมูล '+edit_name_log+' ได้ กรุณาลองใหม่อีกครั้ง!');
                        window.location.reload();                  
                    }
                }
            });
        }
    });
    
    $("#btn_edit_status_room").click(function(){
        var name_status_room = $("#edit_name_status_room").val();
        var id_status_room = $("#id_status_room").val();
        if(id_status_room != "")
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "name_status_room="+name_status_room+"&id_status_room="+id_status_room,
                success: function(res_edit_statusRoom)
                {
                    if(res_edit_statusRoom == 1)
                    {
                        alert("แก้ไขข้อมูลสถานะห้องเรียบร้อยแล้ว");
                        window.location.href ='status_room.php';
                    }else
                    {
                        alert("ไม่สามารถแก้ไขข้อมูลสถานะห้องได้ กรุณาลองใหม่อีกครั้ง!");
                        window.location.href ='status_room.php';                        
                    }
                }
            });
        }
    });

    $("#btn_search_member").click(function(){
        var search_data = $("#search_data").val();
        if(search_data == "")
        {
            alert("กรุณาระบุคำที่ต้องการค้นหา!");
            $("#search_data").focus();
            return false;
        }else
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "search_data_member="+search_data,
                beforeSend: function()
                {

                },
                success: function(res_data_member)
                {
                    $("#show_data").html(res_data_member);
                }
            });
        }
    });
    $("#btn_create_reserv").click(function(){
        var starttime = $("#starttime").val();
        var endtime = $("#endtime").val();
        var room = $("#room").val();
        var topic = $("#topic").val();
        var typereserv = $("#typereserv").val();
        var num = $("#num").val();
        var tel = $("#tel").val();
        if(starttime == "")
        {
            alert("กรุณาเลือกเวลาเริ่มต้น");
            $("#starttime").focus();
            return false;
        }else if(endtime == "")
        {
            alert("กรุณาเลือกเวลาสิ้นสุด");
            $("#endtime").focus();
            return false;
        }else if(room == "")
        {
            alert("กรุณาเลือกห้องประชุมที่ต้องการจอง");
            $("#room").focus();
            return false;            
        }else if(topic == "")
        {
            alert("กรุณากรอกหัวข้อในการประชุม");
            $("#topic").focus();
            return false;
        }else if(typereserv == "")
        {
            alert("กรุณาเลือกประเภทงานประชุม");
            $("#typereserv").val();
            return false;
        }else if(num == "")
        {
            alert("กรุณากรอกจำนวนคนที่เข้าประชุม");
            $("#num").val();
            return false;
        }else if(tel == "")
        {
            alert("กรุณากรอกเบอร์โทรที่สามารถติดต่อได้");
            $("#tel").focus();
            return false;
        }else
        {
            return true;
        }
    });
    $("#check_control").click(function(){
        if(this.checked)
        {
            $("#txt_control").removeAttr('disabled','disabled')
            $("#txt_control").focus();
        }else
        {
            $("#txt_control").attr('disabled','disabled')
            $("#txt_control").val("")
        }
    });
    $("#check_wireless_mic").click(function(){
        if(this.checked)
        {
            $("#txt_wireless_mic").removeAttr('disabled','disabled')
            $("#txt_wireless_mic").focus();
        }else
        {
            $("#txt_wireless_mic").attr('disabled','disabled')
            $("#txt_wireless_mic").val("")
        }
    });
    $("#check_mic").click(function(){
        if(this.checked)
        {
            $("#txt_mic").removeAttr('disabled','disabled')
            $("#txt_mic").focus();
        }else
        {
            $("#txt_mic").attr('disabled','disabled')
            $("#txt_mic").val("")
        }
    });
    $("#check_other").click(function(){
        if(this.checked)
        {     
            $("#txt_other").removeAttr('disabled','disabled')
            $("#txt_other").focus()
        }else
        {
            $("#txt_other").attr('disabled','disabled')
            $("#txt_other").val("")
        }
    });
    $("#check_catering2").click(function(){
        if(this.checked)
        {
            $("#txt_cateringother").attr('disabled','disabled')
            $("#txt_cateringother").val("")
            $("#txt_catering2").removeAttr('disabled','disabled')
            $("#txt_catering2").focus()
        }else
        {
            $("#txt_catering2").attr('disabled','disabled')
            $("#txt_catering2").val("")
        }
    });
    $("#check_cateringother").click(function(){
        if(this.checked)
        {
            $("#txt_catering2").attr('disabled','disabled')
            $("#txt_catering2").val("")
            $("#txt_cateringother").removeAttr('disabled','disabled')
            $("#txt_cateringother").focus()
        }else
        {
            $("#txt_cateringother").attr('disabled','disabled')
            $("#txt_cateringother").val("")
        }
    });

    $("#btn_report").click(function(){
        $("#show_reportother").show();
        var startday_report = $("#startday_report").val();
        var endday_report = $("#endday_report").val();
        if(startday_report && endday_report != "")
        {
            $.ajax({
                type: "POST",
                url: "get_report.php",
                data: "startday="+startday_report+"&endday="+endday_report,
                beforeSend: function()
                {
                    $("#show_reportother").html("Loading...");
                },
                success: function(res_report)
                {   
                    $("#show_reportother").html(res_report);
                }
            });
        }else
        {
            $("#show_reportother").html("<center><h3>กรุณาเลือกวัน/เวลาที่ต้องการรายงาน</h3>");
        }
    });

    $("#report_year-tab").click(function(){
        $("#show_reportyear").show().empty();
        $("#show_reportother").hide();
        $("#show_reportmonth").hide();
    });
    $("#report_month-tab").click(function(){
        $("#show_reportmonth").show().empty();
        $("#show_reportother").hide();
        $("#show_reportyear").hide();
    });
    $("#report_other-tab").click(function(){
        $("#show_reportother").show().empty();
        $("#show_reportmonth").hide();
        $("#show_reportyear").hide();
    });
    //select year show month//
    $("#txt_year").change(function(){
        var str_year = $("#txt_year").val();
            $.ajax({
                type: "POST",
                url: "get_dataMonth.php",
                data: "str_year="+str_year,
                success: function(res_datamonth)
                {
                    $("#show_month").html(res_datamonth);
                },
            });
    });
    $("#btn_reportMonth").click(function(){
        var str_year = $("#txt_year").val();
        var str_month = $("#txt_month").val();
        if(str_year && str_month != "")
        {
            $.ajax({
                type: "POST",
                url: "get_report.php",
                data: "str_year="+str_year+"&str_month="+str_month,
                beforeSend: function()
                {
                    $("#show_reportmonth").html("Loading...");
                },
                success: function(res_report_month)
                {
                    $("#show_reportmonth").html(res_report_month);
                }
            });
        }else
        {
            $("#show_reportmonth").html("<center><h3>กรุณาเลือกปีที่ต้องการรายงาน</h3></center>");
        }
    });
    $("#btn_reportYear").click(function(){
        var report_year_txt = $("#report_year_txt").val();
        if(report_year_txt != "")
        {
            $.ajax({
                type: "POST",
                url: "get_report.php",
                data: "report_txt_year="+report_year_txt,
                beforeSend: function()
                {
                    $("#show_reportyear").html("Loading...");
                },
                success: function(res_report_year)
                {
                    $("#show_reportyear").html(res_report_year);
                }
            });
        }else
        {
            $("#show_reportyear").html("<center><h3>กรุณาเลือกปีที่ต้องการรายงาน</h3></center>");
        }        
    });

});
window.onload = load_data(1,'','');
window.onload = load_member(1,'','');
function load_data(page,txt_searchevent,dataReserv_condition)
{
    if(txt_searchevent != "")
    {
        var txt_searchevent = $("#txt_searchreserv").val();
        var data_condition = $("#dataReserv_condition").val();
    }
    $.ajax({
        type: "POST",
        url: "get_reserv.php",
        data: "data_condition="+data_condition+"&search_reserv="+txt_searchevent+"&page="+page+"&get_dataReserv=1",
        beforeSend: function()
        {
            $("#data_reserv").html("Loading...");
        },
        success: function(res_data_reserv)
        {
            $("#data_reserv").html(res_data_reserv);
        },
    });
}
function load_member(page,search_member,dataMember_condition)
{
    if(search_member != "")
    {
        var search_member = $("#search_member").val();
        var data_condition = $("#dataMember_condition").val();
    }
    $.ajax({
        type: "POST",
        url: "get_member.php",
        data: "data_condition="+data_condition+"&get_datamember=1&search_member="+search_member+"&page="+page,
        beforeSend: function()
        {
            $("#data_member").html("Loading...");
        },
        success: function(res_data_member)
        {
            $("#data_member").html(res_data_member);
        }
    });
}
function change_member()
{
    var data_condition_member = $("#dataMember_condition").val();
    if(data_condition_member == "gu.id_group_users")
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "data_condition_member="+data_condition_member,
            success: function(res_data_group)
            {
                $("#show_textbox_member").html(res_data_group);
            }
        });
    }

    if(data_condition_member == "r.id_role")
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "data_condition_role="+data_condition_member,
            success: function(res_data_role)
            {
                $("#show_textbox_member").html(res_data_role);
            }
        });        
    }
}
function change_room()
{
    var data_condition = $("#dataReserv_condition").val();
    if(data_condition == "rs.id_room")
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "data_condition_room="+data_condition,
            success: function(res_data_role)
            {
                $("#show_textbox_reserv").html(res_data_role);
            }
        });         
    }else if(data_condition == "status_reserv")
    {
        var txt_reserv = "<select class='form-control' id='txt_searchreserv'>";
        txt_reserv += "<option value='no'>ไม่อนุมัติ</option>";
        txt_reserv += "<option value='yes'>อนุมัติ</option>";
        txt_reserv += "</select>";
        $("#show_textbox_reserv").html(txt_reserv);
    }else if(data_condition == "startday")
    {
        var txt_date = "<input type='date' class='form-control' id='txt_searchreserv'>";
        $("#show_textbox_reserv").html(txt_date);
    }else
    {
        var txt_html = "";
    }
}
function remove_reserv(id_reserv)
{
    if(confirm("คุณแน่ใจต้องการลบข้อมูลการจอง ?"))
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "id_reserv_del="+id_reserv,
            success: function(res_delete)
            {
                if(res_delete == 1)
                {
                    alert("ลบข้อมูลการจองเรียบร้อยแล้ว");
                    window.location.href='reserv.php';
                }else
                {
                    alert("เกิดการผิดพลาด กรุณาลองใหม่อีกครั้ง!!");
                    window.location.href='reserv.php';             
                }
            }
        });
        return true;
    }else
    {
        return false;
    }
}
function confirm_reserv(id_reserv)
{
    if(confirm("ยืนยันข้อมูลการจองห้อง ??"))
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "id_reserv="+id_reserv,
            success: function(res_confirm)
            {
                if(res_confirm == 1)
                {
                    alert("ยืนยันข้อมูลการจองเรียบร้อยแล้ว");
                    window.location.href='reserv.php';
                }else
                {
                    alert("เกิดการผิดพลาด กรุณาลองใหม่อีกครั้ง!!");
                    window.location.href='reserv.php';
                }
            }
        });
        return true;
    }else
    {
        return false;
    }
}
function CheckNum(){
		if (event.keyCode < 48 || event.keyCode > 57){
		      event.returnValue = false;
	    	}
    }
function autoTel(obj,typeCheck){
        if(typeCheck==1){
            var pattern=new String("_-____-_____-_-__"); 
            var pattern_ex=new String("-");    
        }else{
            var pattern=new String("__-____-____");
            var pattern_ex=new String("-");                 
        }
        var returnText=new String("");
        var obj_l=obj.value.length;
        var obj_l2=obj_l-1;
        for(i=0;i<pattern.length;i++){           
            if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
                returnText+=obj.value+pattern_ex;
                obj.value=returnText;
            }
        }
        if(obj_l>=pattern.length){
            obj.value=obj.value.substr(0,pattern.length);           
        }
}
function readURL(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_room_preview')
                .attr('src', e.target.result)
                .width(400)
                .height(300);
            };

            reader.readAsDataURL(input.files[0]);
    }
}

function check_member()
{
    var username = $("#username_log").val();
    $.ajax({
        type: "POST",
        url: "process.php",
        data: "user="+username,
        beforeSend: function()
        {
            
        },
        success: function()
        {

        }
    });
}
function statusR_edit(id_status_room)
{
    $.ajax({
        type: "GET",
        url: "process.php",
        data: "id_status_edit="+id_status_room,
        success: function(ch_statusedit)
        {
            window.location.href = 'edit_statusroom.php?id_status_room='+ch_statusedit;
        }
    });
}
function statusR_delete(id_status_room)
{
    $.ajax({
        type: "GET",
        url: "process.php",
        data: "id_status_delete="+id_status_room,
        success: function(ch_statusdelete)
        {
            if(ch_statusdelete == 1)
            {
                alert("ลบข้อมูลเรียบร้อยแล้ว")
                window.location.reload();
            }else
            {
                alert("ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง!");
                window.location.reload();                
            }
        }
    });
}

function role_edit(id_role)
{
    $.ajax({
        type: "GET",
        url: "process.php",
        data: "id_role_edit="+id_role,
        success: function(ch_roleedit_status)
        {
            window.location.href = 'edit_role.php?id_role='+ch_roleedit_status;
        }
    });
}
function role_delete(id_role)
{
    if(confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้ ?"))
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "id_role_del="+id_role,
            success: function(del_role_res)
            {
                if(del_role_res == 1)
                {
                    alert("ลบข้อมูลเรียบร้อยแล้ว");
                    window.location.reload();
                }else
                {
                    alert("ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง");
                    window.location.reload();                    
                }
            }
        });
    }
}
function member_edit(id_user)
{
    $.ajax({
        type: "POST",
        url: "process.php",
        data: "id_user_edit="+id_user,
        success: function(res_data_user)
        {
            window.location.href = 'edit_member.php?id_user_edit='+id_user;            
        }
    });

}
function member_delete(id_user)
{
    if(confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้ ?"))
    {
        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: 'id_user_del='+id_user,
            success: function(del_user_res)
            {
                if(del_user_res == 1)
                {
                    alert("ลบข้อมูลเรียบร้อยแล้ว");
                    window.location.reload();
                }else 
                {
                    alert("ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง");
                    window.location.reload();                    
                }
            }
        });
        return true;
    }else
    {
        return false;
    }
}
function group_edit(id_group)
{
    $.ajax({
        type: "GET",
        url: "process.php",
        data: "id_group_data="+id_group,
        success: function(ch_groupedit_res)
        {
            window.location.href = 'edit_group.php?id_group='+ch_groupedit_res;
        }
    });
}
function group_delete(id_group)
{
        if(confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้ ?"))
        {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: "id_group_del="+id_group,
                success: function(del_group_res)
                {
                    if(del_group_res == 1)
                    {
                        alert("ลบ "+id_group+" เรียบร้อยแล้ว");
                        window.location.reload();
                    }else
                    {
                        alert("ไม่สามารถลบ "+id_group+" ได้ กรุณาลองใหม่อีกครั้ง");
                        window.location.reload();                
                    }
                }
            });
            return true;
        }else
        {
            return false;
        }
}
function room_edit(id_room)
{
    $.ajax({
        type: "GET",
        url: "process.php",
        data: "id_room="+id_room,
        success: function(res_data_room)
        {
            window.location.href = "edit_room.php?id_room="+id_room;
        },
    });
}
function room_delete(id_room)
{
    if(confirm("คุณแน่ใจว่าต้องการลบข้อมูลนี้ ?"))
    {
        $.ajax({
            type: "POST",
            url: "process.php",
            data: "id_room_del="+id_room,
            success: function(del_room_res)
            {
                if(del_room_res == 1)
                {
                    alert("ลบ "+id_room+" เรียบร้อยแล้ว");
                    window.location.reload();
                }else
                {
                    alert("ไม่สามารถลบข้อมูล "+id_room+" กรุณาลองใหม่อีกครั้ง!");
                    window.location.reload();
                }
            }
        });
        return true;
    }else
    {
        return false;
    }
}
