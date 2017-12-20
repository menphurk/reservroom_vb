<?php
function duration($remain){
    $wan=floor($remain/86400);
    $l_wan=$remain%86400;
    $hour=floor($l_wan/3600);
    $l_hour=$l_wan%3600;
    $minute=floor($l_hour/60);
    $second=$l_hour%60;
    return "ผ่านมาแล้ว ".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
}

function HoursDiff($strTime1,$strTime2)
{
           return (strtotime($strTime2) - strtotime($strTime1))/( 60 * 60 );
}
function MinuteDiff($strTime1,$strTime2)
{
           return Floor(strtotime($strTime2) - strtotime($strTime1))/60;
}
?>