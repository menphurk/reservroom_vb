<html>
    <head>
        <title>ระบบจองห้องประชุมสำนักงานอาสากาชาด</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!---CSS-->
        <link href="css/fullcalendar.css?rev=<?php echo time();?>" rel="stylesheet">
        <link href="css/fullcalendar.print.css?rev=<?php echo time();?>" rel="stylesheet" media="print">
    </head>
<body>
<?php if(isset($_GET['print'])) { ?>
    <div style="margin:auto;width:100%;" class="show_calendar">
        <div id='calendar'></div>
    </div>
    <p class="text-left" style="font-size:12pt;font-weight:bolder;">
        <strong>***หมายเหตุ***</strong><br>
        <font color="#5cb85c">สีเขียว = ห้องรับรองใหญ่</font><br>
        <font color="#f0ad4e">สีส้ม = ห้องรับรองเล็ก</font><br>
        <font color="#1E90FF">สีน้ำเงิน = ห้องกิจกรรมอาสากาชาด ชั้น 2</font><br>
        <font color="#000000">สีดำ = ห้องศูนย์สมรรถนะการคิดเด็ก ชั้น 2</font><br>
        <font color="#d9534f">สีแดง = ห้องประชุม ชั้น 4</font><br>
    </p>
</body>
        <script type="text/javascript">
            window.print();
        </script>
        <script src="js/jquery.js?rev=<?php echo time();?>"></script>
		<script src="js/scripts.js?rev=<?php echo time();?>"></script>
		<script src="js/date_time.js?rev=<?php echo time();?>"></script>
        <script src="js/bootstrap.min.js?rev=<?php echo time();?>"></script>  
		<script src="js/moment.js?rev=<?php echo time();?>"></script>
        <script src="js/fullcalendar.js?rev=<?php echo time();?>"></script>
		<script src="js/th.js?rev=<?php echo time();?>"></script>
		<script src="js/jquery-ui.js?rev=<?php echo time();?>"></script>
<? 
}
?>