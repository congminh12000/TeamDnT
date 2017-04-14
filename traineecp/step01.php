<?php session_start();?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width">
<title>TeamDnT - WebDesign : Trainee Page</title>
<script type="text/javascript" src="p7ehc/p7EHCscripts5.js"></script>
<link href="p7csspbm2/p7csspbm2_125.css" rel="stylesheet" type="text/css">
<link href="p7csspbm2/p7csspbm2_print5.css" rel="stylesheet" type="text/css" media="print">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css"> 
<script type="text/javascript" href="../js/boostrap.js"></script>
<link rel="shortcut icon" href="../images/favicon-teamdnt.ico">
<!--[if lte IE 7]>
<style>
.menutop li {display: inline;}
div, .menuside a {zoom: 1;}
.masthead .banner, .masthead .banner img {width: 100%;}
.sidebar2 {width: 19%;}
</style>
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
<div class="content-wrapper">
    <div class="masthead">
    <?php
		mxi_includes_start("traineecp_header.php");
		require(basename("traineecp_header.php"));
		mxi_includes_end();
	?>
  </div>
  <div class="columns-wrapper">
  <div class="sidebar">
      <div class="content p7ehc-1">
         <?php
			  mxi_includes_start("traineecp_menu.php");
			  require(basename("traineecp_menu.php"));
			  mxi_includes_end();
		?>
      </div>
    </div>
    <div class="main-content">
      <div class="content p7ehc-1">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<h4>I. Cài đặt phần mềm máy chủ ảo Apache<br><small>(trên máy tính thiết kế)</small></h4>
            <p>File name: <b>appserv-win32-2.5.8.exe</b></p>   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-01.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</i></b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-02.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> I Agree</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-03.png" width="600">
            </div>
            <p><b>Máy chủ ảo chạy trong thư mục AppServ, chọn ổ đĩa cài đặt <i class="fa fa-chevron-right" aria-hidden="true"></i> Next<br><small>(Tất cả dữ liệu source website chạy trong thư mục này)</small></b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-04.png" width="600">
            </div>
            <p><b>Chọn hết 4 tùy chọn <i class="fa fa-chevron-right" aria-hidden="true"></i> Next</i></b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-05.png" width="600">
            </div>
            <p><b>Server Name: localhost<br> Administrator's Email Address: <small>(email bất kỳ)</small><br> Port: 80 <i class="fa fa-chevron-right" aria-hidden="true"></i>  Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-06.png" width="600">
            </div>
            <p><b>Root Password: <small>(bất kỳ)</small><br> Re-enter Root Password: <small>(như trên)</small><br> Character Sets & Collations: UTF-8 Unicode<br> Enable InnoDB: <small>(chọn)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i>  Install</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-07.png" width="600">
            </div>
            <p><b>Start Apache: <small>(chọn)</small><br> Start MySQL: <small>(chọn)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i>  Finish</b></p>
            <br>
            <h4>II. Cài đặt phần mềm MySQL quản trị dữ liệu (database) website<br><small>(trên máy tính thiết kế)</small></h4>
            <p>File name: <b>mysql-gui-tools-5.0-r12-win32.msi</b></p> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-08.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Next/b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-09.png" width="600">
            </div>
            <p><b>I accept the terms in the license agreement: <small>(chọn)</small><br><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-10.png" width="600">
            </div>
            <p><b>Chọn đường dẫn cài đặt phần mềm: <small>(chọn mặc định)</small><br><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-11.png" width="600">
            </div>
            <p><b>Complete: <small>(chọn)</small><br><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-12.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Install</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-13.png" width="600">
            </div>
            <p><b>Trong quá trình cài hiện thông báo.</p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-14.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-15.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Next</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-16.png" width="600">
            </div>
            <p><b><i class="fa fa-chevron-right" aria-hidden="true"></i> Finish</i></b></p>
            <br>
           	<h4>III. Cài đặt phần mềm thiết kế website<br><small>(trên máy tính thiết kế)</small></h4>
            <p>File name: <b>Dreamweaver CS4 Setup <i class="fa fa-chevron-right" aria-hidden="true"></i> Setup.exe</b></p>
            <p><b>Crack</b></p>
            <br>
            <h4>IV. Cài đặt plugin hỗ trợ phần mềm thiết kế website<br><small>(trên máy tính thiết kế)</small></h4>
            <p>File name: <b>CodeHints-CSS3.mxp</b> / <b>HTML5CS3_4.mxp</b> / <b>p7_PBM2_204.mxp</b> / <b>DevToolbox-1_0_1.mxp</b></p>
            <p><b>Mở ứng dụng Adobe Extension Manager CS4</b></p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step01-17.png" width="600">
            </div>
            <p><b>Chọn nút Install <i class="fa fa-chevron-right" aria-hidden="true"></i> Chọn file <i class="fa fa-chevron-right" aria-hidden="true"></i> Install</b></p>
            <p><b>Lưu ý: khi vào Dreamweaver CS4 lần đầu yêu cầu kích hoạt điền Serial.txt của DevToolbox-1_0_1.mxp</b></p>
            <br>
            <a href="traineecp.php" target="_self"><button type="button">Kết thúc phần 1 <i class="fa fa-chevron-right" aria-hidden="true"></i></button></a>
        </div>
      </div> <!-- End content -->
    </div> <!-- End main-content -->
</div>
  <?php
		mxi_includes_start("traineecp_footer.php");
		require(basename("traineecp_footer.php"));
		mxi_includes_end();
	?>
</div>
</body>
</html>
