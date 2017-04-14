<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php session_start();?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make unified connection variable
$conn_cnn_teamdnt = new KT_connection($cnn_teamdnt, $database_cnn_teamdnt);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_cnn_teamdnt, "../");
//Grand Levels: Level
$restrict->addLevel("5");
$restrict->Execute();
//End Restrict Access To Page
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
</head>

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
        <h4>I. Tạo source dữ liệu mặc định</h4>
        <p><b>Vào đường dẫn thư mục: C:\AppServ\www\</b></p>
        <p><b>Tạo folder theo cấu trúc:</b></p>
        <ul type="square">
        	<li><i class="fa fa-folder-open" aria-hidden="true"></i> teamdnt <small>(folder)</small></li>
            <ol>
            	<li><i class="fa fa-folder-open" aria-hidden="true"></i> admincp <small>(folder)</small></li>
                <ol>
                	<li><i class="fa fa-file-code-o" aria-hidden="true"></i> admincp.php <small>(file)</small></li>
                    <li><i class="fa fa-file-code-o" aria-hidden="true"></i> logout.php <small>(file)</small></li>
                </ol>
                <li><i class="fa fa-folder-open" aria-hidden="true"></i> css <small>(folder)</small></li>
                <ol>
                	<li><i class="fa fa-file-code-o" aria-hidden="true"></i> style-primary.css <small>(file)</small></li>
                </ol>
                <li><i class="fa fa-folder-open" aria-hidden="true"></i> js <small>(folder)</small></li>
                <ol>
                	<li><i class="fa fa-file-code-o" aria-hidden="true"></i> teamdnt.js <small>(file)</small></li>
                </ol>
                <li><i class="fa fa-folder-open" aria-hidden="true"></i> images <small>(folder)</small></li>
                <li><i class="fa fa-file-code-o" aria-hidden="true"></i> index.php <small>(file)</small></li>
                <li><i class="fa fa-file-code-o" aria-hidden="true"></i> dntgate.php <small>(file)</small></li>
                <li><i class="fa fa-file-code-o" aria-hidden="true"></i> login_error.php <small>(file)</small></li>
            </ol>
       	</ul>
        <p><b>Lưu ý: để đổi đuôi file tùy chỉnh Windows <i class="fa fa-chevron-right" aria-hidden="true"></i> Organize <i class="fa fa-chevron-right" aria-hidden="true"></i> Folder and search Options <i class="fa fa-chevron-right" aria-hidden="true"></i> View <i class="fa fa-chevron-right" aria-hidden="true"></i> Hidden extensions for known file types <small>(bỏ chọn)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> OK</b></p><br>
        <h4>II. Cấu hình source website lên máy ảo</h4><br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-01.png" width="600">
        </div>
        <p><b>Start <i class="fa fa-chevron-right" aria-hidden="true"></i> All programs <i class="fa fa-chevron-right" aria-hidden="true"></i> AppServ <i class="fa fa-chevron-right" aria-hidden="true"></i> Configuration Server <i class="fa fa-chevron-right" aria-hidden="true"></i> Apache Edit the httpd.conf Configuration File</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-02.png" width="600">
        </div>
        <p><b>Nhấn Ctrl +F <small>(hiện bảng tìm kiếm)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> Điền vào "DocumentRoot" <i class="fa fa-chevron-right" aria-hidden="true"></i> Nhấn Enter 2 lần <i class="fa fa-chevron-right" aria-hidden="true"></i> tại dòng <mark>DocumentRoot "C:/AppServ/www/"</mark> sửa thành <mark>DocumentRoot "C:/AppServ/www/teamdnt/"</mark> <small>(lưu ý teamdnt là folder dữ liệu source gốc tạo ở trên)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> Save</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-03.png" width="600">
        </div>
        <p><b>Start <i class="fa fa-chevron-right" aria-hidden="true"></i> Search "services" <i class="fa fa-chevron-right" aria-hidden="true"></i> Chọn services.msc</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-04.png" width="600">
        </div>
        <p><b>Chọn Apache2.2 <i class="fa fa-chevron-right" aria-hidden="true"></i> Stop <i class="fa fa-chevron-right" aria-hidden="true"></i> Start</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-05.png" width="600">
        </div>
        <p><b>Chọn mysql <i class="fa fa-chevron-right" aria-hidden="true"></i> Stop <i class="fa fa-chevron-right" aria-hidden="true"></i> Start</b></p>
        <br>
        <h4>III. Cài đặt source website vào phần mềm Dreamweaver CS4</h4><br>
        <p>Đăng nhập: <b>Dreamweaver CS4.exe</b></p>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-06.png" width="600">
        </div>
        <p><b>Site <i class="fa fa-chevron-right" aria-hidden="true"></i> New Site...</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-07.png" width="600">
        </div>
        <p><b>Local Info <i class="fa fa-chevron-right" aria-hidden="true"></i><br>Site name: teamdnt<br>Local root folder: C:\AppServ\www\teamdnt\ <small>(\teamdnt\ là folder dữ liệu gốc)</small><br>Default images folder: C:\AppServ\www\teamdnt\images\</b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-08.png" width="600">
        </div>
        <p><b>Remote Info <i class="fa fa-chevron-right" aria-hidden="true"></i><br>Access: Local/Network<br>Remote folder: C:\AppServ\www\teamdnt\ <small>(\teamdnt\ là folder dữ liệu gốc)</small><br>Maintain synchronization information: <small>(chọn)</small><br>Automatically upload files to server on save: <small>(chọn)</small></b></p>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step02-09.png" width="600">
        </div>
        <p><b>Testing Server <i class="fa fa-chevron-right" aria-hidden="true"></i><br>Server Model: PHP/MySQL<br>Access:Local/Network<br>Testing server folder: C:\AppServ\www\teamdnt\ <small>(\teamdnt\ là folder dữ liệu gốc)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> OK</b></p>
        <br>
        <a href="traineecp.php" target="_self"><button type="button">Kết thúc phần 2 <i class="fa fa-chevron-right" aria-hidden="true"></i></button></a>
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
