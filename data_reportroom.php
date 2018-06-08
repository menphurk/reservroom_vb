<?php
require('include/Conn.php');

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


////
$str_data_room = mysql_real_escape_string($_POST['str_room']);
$str_month_room = mysql_real_escape_string($_POST['str_month']);
$sqlReportRoom = "SELECT rs.topic as topic,rs.starttime as starttime,rs.endtime as endtime,DAY(startday) AS dayreserv,";
$sqlReportRoom .= "rs.id_room AS id_room,r.name_room AS name_room,rs.check_projector as check_projector,rs.check_screen as check_screen,rs.check_dvd as check_dvd,rs.check_dvd as check_dvd,rs.check_tv as check_tv,rs.check_record as check_record,";
$sqlReportRoom .= "rs.check_amp as check_amp,rs.txt_control as txt_control,rs.check_control as check_control,rs.txt_wireless_mic as txt_wireless_mic,rs.check_wireless_mic as check_wireless_mic,rs.txt_mic as txt_mic,rs.check_mic as check_mic,rs.txt_other as txt_other,";
$sqlReportRoom .= "rs.check_other as check_other,rs.check_catering AS check_catering,rs.txt_catering2 AS txt_catering2,rs.txt_cateringother AS txt_cateringother,rs.num AS num,tr.name_table AS name_table,u.name_log as namelog ";
$sqlReportRoom .= " FROM reserv as rs";
$sqlReportRoom .= " LEFT JOIN room as r on(r.id_room = rs.id_room)";
$sqlReportRoom .= " JOIN users as u on(u.id_user = rs.update_id)";
$sqlReportRoom .= " JOIN title as t on(t.title_id = u.title_id)";
$sqlReportRoom .= " LEFT JOIN table_reserv as tr on(tr.id = rs.id_table_reserv)";
$sqlReportRoom .= " WHERE id_status_reserv = '2'";
$sqlReportRoom .= " AND MONTH(startday) = '".$str_month_room."' AND MONTH(endday) = '".$str_month_room."' ";
if($str_data_room != "")
{
    $sqlReportRoom .= " AND rs.id_room = '".$str_data_room."'";
}
$sqlReportRoom .= " ORDER by MONTH(startday) DESC";
$queryReportRoom = mysql_query($sqlReportRoom);
$countReportRoom = mysql_num_rows($queryReportRoom);
if($countReportRoom == 0)
{
    echo "Nodata Reserv";
}else
{

    $dayname=array(0=>'อาทิตย์',1=>'จันทร์',2=>'อังคาร',3=>'พุธ',4=>'พฤหัสบดี',5=>'ศุกร์',6=>'เสาร์');
    $month_name=array(1=>'มกราคม',2=>'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฎาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
    $date_year = date("Y");
    $str_merch_date = $date_year.'-'.$str_month_room;
    $sp_m_y=explode('-',$str_merch_date);//แยกค่าเดือน/ปี ออกจากกันโดยใช้ แบ่งตามเครื่องหมาย "-" จะได้ $sp_m_y[0]=ปี,$sp_m_y[1]=เดือน
    $nextMonth=date('Y-n', mktime(0,0,0,($sp_m_y[1]+1),1,$sp_m_y[0]));
    $prevMonth=date('Y-n',mktime(0,0,0,($sp_m_y[1]-1),1,$sp_m_y[0]));
    $fistday=date('w',strtotime( $str_merch_date.'-1' ));
    $numsday=date('t',strtotime($str_merch_date));
    $tday1=$fistday+$numsday;
    $tday2=ceil($tday1/7)*7;
    echo '<table class="table table-bordered" id="calendar">';
    echo '<tr><td colspan="7" id="tr_month_title">';
    if($str_data_room == 'RVB00001')
    {
        $str_room = "ห้องรับรองใหญ่";
    }else if($str_data_room == 'RVB00002')
    {
        $str_room = "ห้องกิจกรรมอาสากาชาด ชั้น 2";
    }else if($str_data_room == 'RVB00003')
    {
        $str_room = "ห้องรับรองเล็ก";
    }else if($str_data_room == 'RVB00004')
    {
        $str_room = "ห้องประชุม ชั้น 4";
    }else if($str_data_room == 'RVB00005')
    {
        $str_room = "ห้องศูนย์สมรรถนะการคิดเด็ก ชั้น 2";
    }else
    {
        $str_room = "";
    }

    echo '<center>';
    echo '<h2>'.$str_room.'</h2>';
    echo '<h2>&nbsp;เดือน'.$month_name[$sp_m_y[1]*1].'ปี '.($sp_m_y[0]+543).'</h2>';
    echo '</center>';

    echo '<tr class="active">';
    foreach($dayname as $key => $value){
        if($value == "เสาร์" && $value == 6)
        {
            $cur_color = "danger";
        }else
        {
            $cur_color = "";
        }
        echo '<td class="'.$cur_color.'">'.$value.'</td>';
    }
    echo '</tr>';
    for($i=1;$i <=$tday2;$i++){
        if($i%7==1){echo '<tr>';}
        $dayreal=($i-$fistday>=1&&$i-$fistday<=$numsday)?$i-$fistday:'';
        // $today=date('Y-n-j')==$m_y.'-'.($i-$fistday)?'class="success"':'';
        // echo $today;
        echo '<td width"10%">';
        echo $dayreal;
        echo "<br>";
        while($row_reportReserv = mysql_fetch_array($queryReportRoom))
        {
            $reportReserv[] = $row_reportReserv;
        }
        foreach($reportReserv as $value_report)
        {
            if($dayreal == $value_report['dayreserv'])
            {
                echo "-".$value_report['topic']."&nbsp;<strong>(".substr($value_report['starttime'],0,-3)."-".substr($value_report['endtime'],0,-3)."น.)</strong>&nbsp;<br>";
            }
        }
        echo '</td>';
        if($i%7==0){
            echo '</tr>';
        }
    }
    //echo '<tr><td colspan="7" id="ft_calendar"><a href="calendar.php?m_y='.date('Y-n').'" id="go_calendar">เดือนปัจจุบัน</a></td></tr>';
    echo '</table>';

    echo "มีทั้งหมด&nbsp;".$countReportRoom."&nbsp;รายการ";

$token = md5(uniqid(rand(), true));
?>
<center><button class="btn btn-app btn-pink btn-xs" onclick="window.location.href='export_pdfroom.php?st_month=<?php echo $str_month_room;?>&st_room=<?php echo $str_data_room;?>&key=<?php echo $token;?>'"><i class="ace-icon fa fa-file-pdf-o bigger-160"></i>Export</button></center>
<?php } ?>