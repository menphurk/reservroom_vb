<?php
$thai_month_arr=array(
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

if(isset($_POST['str_year']))
{
    echo "<label for='txt_month'>เดือน : </label>";
    echo "<select id='txt_month' name='txt_month'>";
    echo "<option value=''>---</option>";
    foreach($thai_month_arr as $key => $val)
    {
        echo "<option value='$key'>$val</option>";
    }
    echo "</select>";
}
?>