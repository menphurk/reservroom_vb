<?php session_start();
    include_once('layout/header.php');
    if(!isset($_SESSION['login']))
    {
?>
  <div class="col-md-12">

    <div class="page-header">
      <center>
        <img src="images/logo_vb.png" class="img-rounded">
        <h1 class="bigger" style="margin-top:17px;">ระบบจองห้องประชุมสำนักงานอาสากาชาด</h1>
      </center>
    </div>
    
    <div class="col-md-6">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">      
           <div class="item active">
            <img src="images/slider/slider1.jpg" alt="...">
          </div>
          <div class="item">
            <img src="images/slider/slider2.jpg" alt="...">
          </div>
          <div class="item">
            <img src="images/slider/slider3.jpg" alt="...">
          </div> 
        </div>
      </div>
    </div>
    <div class="col-md-6">

      <div class="panel panel-primary">
          <div class="panel-heading">กรุณาเข้าสู่ระบบ</div>
          <div class="panel-body">
              <form action="chk_login.php" method="post">
              <div class="form-group">
                  <label for="username_log">ชื่อผู้ใช้งาน</label>
                  <input type="text" class="form-control" name="username_log" id="username_log" placeholder="Username">
              </div>
              <div class="form-group">
                  <label for="password_log">รหัสผ่าน</label>
                  <input type="password" class="form-control" name="password_log" id="password_log" placeholder="Password">
              </div>
              <center><button type="submit" class="btn btn-primary" id="btn_login" name="btn_login"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;เข้าสู่ระบบ</button></center>
              </form>
              <!--<hr>-->
              <!--<center><h4 style="color:#d9534f;">(สำหรับอาสากาชาดที่ต้องการจองห้องประชุม <a href="add_reserv.php">กรุณาคลิกที่นี่!</a>)</h4></center>-->
          </div>    
      </div>
    </div>
  </div>
<?php
    }else {
      header("Location:reserv.php");
    }
    include_once('layout/footer.php');
?>