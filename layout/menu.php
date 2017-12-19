<?php session_start();
    include_once('session_expire.php');
    include_once('include/Conn.php');
    if(!isset($_SESSION['login']))
    {
      echo "<script>window.location.href='index.php';</script>";
    }
    $get_user = "select * from users where id_user='".$_SESSION['login'][0]."'";
    $result_user = mysql_query($get_user);
    $row_user = mysql_fetch_array($result_user);
?>
		<div id="navbar" class="navbar navbar-default">

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>
        <script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							ระบบจองห้องประชุม สำนักงานอาสากาชาด สภากาชาดไทย
						</small>
					</a>


					<!-- /section:basics/navbar.toggle -->
				</div>
				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
          <li class="purple">

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>ยินดีต้อนรับ,</small>
									<?php echo $_SESSION['login'][2];?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
									<a href="history.php?id_user=<?php echo $_SESSION['login'][0];?>">
										<i class="ace-icon fa fa-history"></i>
										ประวัติการจอง
									</a>
								</li>
								<li>
									<a href="profile.php?id_user=<?php echo $_SESSION['login'][0];?>">
										<i class="ace-icon fa fa-user"></i>
										แก้ไขข้อมูล
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										ออกจากระบบ
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div id="date_time"></div>
            <script type="text/javascript"> window.onload = date_time('date_time');</script>						
						<!-- /section:basics/sidebar.layout.shortcuts -->

				</div><!-- /.sidebar-shortcuts -->

        <!-- #section:basics/sidebar -->
        <div id="sidebar" class="sidebar responsive">
            <ul class="nav nav-list">
            <?php
              if($row_user['id_role'] == 1)
              {
            ?>
                  <li class="">
                    <a href="#" class="dropdown-toggle">
                      <i class="menu-icon fa fa-bandcamp"></i>
                      <span class="menu-text"> 1.การจองห้อง </span>

                      <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                      <li class="">
                        <a href="reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          รายการจองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>

                      <li class="">
                        <a href="create_reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          จองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>
                    </ul>
                </li>
                <li class="">
                  <a href="#" class="dropdown-toggle">
                    <span class="menu-icon glyphicon glyphicon-flag"></span>
                    <span class="menu-text"> 2.ห้องประชุม </span>

                    <b class="arrow fa fa-angle-down"></b>
                  </a>

                  <b class="arrow"></b>

                  <ul class="submenu">
                    <li class="">
                      <a href="room.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายชื่อห้องประชุม
                      </a>

                      <b class="arrow"></b>
                    </li>

                    <li class="">
                      <a href="create_room.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        สร้างห้องประชุม
                      </a>

                      <b class="arrow"></b>
                    </li>
                  </ul>
                </li>
                <li class="">
                  <a href="report.php">
                    <i class="menu-icon fa fa-file-text"></i>
                    <span class="menu-text"> 3.รายงาน </span>
                  </a>
    
                  <b class="arrow"></b>
                </li>
                <li class="">
                  <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user-circle-o"></i>
                    <span class="menu-text"> 4.บัญชีผู้ใช้งาน </span>

                    <b class="arrow fa fa-angle-down"></b>
                  </a>

                  <b class="arrow"></b>

                  <ul class="submenu">
                    <li class="">
                      <a href="member.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายชื่อบัญชีผู้ใช้งาน
                      </a>

                      <b class="arrow"></b>
                    </li>

                    <li class="">
                      <a href="create_member.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        สร้างบัญชีผู้ใช้งาน
                      </a>

                      <b class="arrow"></b>
                    </li>
                  </ul>
                </li>
                <li class="">
                  <a href="config.php">
                    <i class="menu-icon fa fa-cog"></i>
                    <span class="menu-text"> 5.ตั้งค่าระบบ </span>
                  </a>
    
                  <b class="arrow"></b>
                </li>
                <?php }else if($row_user['id_role'] == 2){ ?>
                  <li class="active open">
                    <a href="#" class="dropdown-toggle">
                      <i class="menu-icon fa fa-bandcamp"></i>
                      <span class="menu-text"> 1.การจองห้อง </span>

                      <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                      <li class="active">
                        <a href="reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          รายการจองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>

                      <li class="">
                        <a href="create_reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          จองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>
                    </ul>
                </li>
                <li class="">
                  <a href="#" class="dropdown-toggle">
                    <span class="menu-icon glyphicon glyphicon-flag"></span>
                    <span class="menu-text"> 2.ห้องประชุม </span>

                    <b class="arrow fa fa-angle-down"></b>
                  </a>

                  <b class="arrow"></b>

                  <ul class="submenu">
                    <li class="">
                      <a href="room.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        รายชื่อห้องประชุม
                      </a>

                      <b class="arrow"></b>
                    </li>

                    <li class="">
                      <a href="create_room.php">
                        <i class="menu-icon fa fa-caret-right"></i>
                        สร้างห้องประชุม
                      </a>

                      <b class="arrow"></b>
                    </li>
                  </ul>
                </li>
                <li class="">
                  <a href="report.php">
                    <i class="menu-icon fa fa-file-text"></i>
                    <span class="menu-text"> 3.รายงาน </span>
                  </a>
    
                  <b class="arrow"></b>
                </li>                    
                <?php }else if($row_user['id_role'] == 3){ ?>
                  <li class="">
                    <a href="#" class="dropdown-toggle">
                      <i class="menu-icon fa fa-bandcamp"></i>
                      <span class="menu-text"> 1.การจองห้อง </span>

                      <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                      <li class="">
                        <a href="reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          รายการจองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>

                      <li class="">
                        <a href="create_reserv.php">
                          <i class="menu-icon fa fa-caret-right"></i>
                          จองห้องประชุม
                        </a>

                        <b class="arrow"></b>
                      </li>
                    </ul>
                </li>                
                <?php } ?>
            </ul><!-- /.nav-list -->

            <!-- #section:basics/sidebar.layout.minimize -->
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>

            <!-- /section:basics/sidebar.layout.minimize -->
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>

        <!-- /section:basics/sidebar -->
        <div class="main-content">
            <div class="main-content-inner">

                <!-- /section:basics/content.breadcrumbs -->
                <div class="page-content">

                        <div class="ace-settings-box clearfix" id="ace-settings-box">
                            <div class="pull-left width-50">
                                <!-- #section:settings.skins -->
                                <div class="ace-settings-item">
                                    <div class="pull-left">
                                        <select id="skin-colorpicker" class="hide">
                                            <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                        </select>
                                    </div>
                                    <span>&nbsp; Choose Skin</span>
                                </div>

                                <!-- /section:settings.skins -->

                                <!-- #section:settings.navbar -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                                    <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                </div>

                                <!-- /section:settings.navbar -->

                                <!-- #section:settings.sidebar -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                </div>

                                <!-- /section:settings.sidebar -->

                                <!-- #section:settings.breadcrumbs -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                </div>

                                <!-- /section:settings.breadcrumbs -->

                                <!-- #section:settings.rtl -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                </div>

                                <!-- /section:settings.rtl -->

                                <!-- #section:settings.container -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                                    <label class="lbl" for="ace-settings-add-container">
                                        Inside
                                        <b>.container</b>
                                    </label>
                                </div>

                                <!-- /section:settings.container -->
                            </div><!-- /.pull-left -->

                            <div class="pull-left width-50">
                                <!-- #section:basics/sidebar.options -->
                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                                    <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                </div>

                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                                    <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                </div>

                                <div class="ace-settings-item">
                                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                </div>

                                <!-- /section:basics/sidebar.options -->
                            </div><!-- /.pull-left -->
                        </div><!-- /.ace-settings-box -->
                    </div><!-- /.ace-settings-container -->