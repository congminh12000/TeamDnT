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
      	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<h4>I. Khởi tạo cơ sở dữ liệu<br><small>(trên máy tính thiết kế)</small></h4>
            <p>Đăng nhập: <b>MySQL Administrator.exe</b></p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-01.png" width="600">
            </div>
            <p><b>Server Host: localhost<br> Port: 3306<br> Username: root<br> Password: <small>(đã đặt)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> OK</i></b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-02.png" width="600">
            </div>
            <p><b>Chọn mục Catalogs hiển thị tất cả database hiện tại đang có (khung bên dưới).</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-03.png" width="600">
            </div>
            <p><b>Nhấn chuột phải khung bên dưới; chọn Creat New Schema để tạo database mới.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-04.png" width="600">
            </div>
            <p><b>Đặt tên database:<br>Schema Name: teamdnt <small>(bất kỳ)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> OK</i></b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-05.png" width="600">
            </div>
            <p><b>Xóa database; nhấn chuột phải lên database chọn Drop Schema.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-06.png" width="600">
            </div>
            <p><b>Tạo bảng mới; nhấn chuột trái lên database; góc phải bên dưới chọn Create Table.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-07.png" width="600">
            </div>
            <p><b>Nhập thông tin bảng bao gồm:<br>Table Name: <small>(tên bảng)</small><br>Comment: <small>(ghi chú bảng)</small><br>Column and Indices: <small>(trường dữ liệu)</small><br>Sau khi hoàn tất, lưu bảng nhấn Apply Changes.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-08.png" width="600">
            </div>
            <p><b>Nhập dữ liệu thô vào bảng để demo. Nhấn chuột phải lên bảng, chọn Edit Table Data.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-09.png" width="600">
            </div>
            <p><b>Để nhập / sửa nội dung. Nhấn vào nút Edit bên dưới.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-10.png" width="600">
            </div>
            <p><b>Chọn trường để nhập / sửa nội dung.<br> Lưu nội dung thay đổi nhấn nút Apply Changes <small>(bên dưới)</small>, không đồng ý thay đổi nhấn nút Discard Changes <small>(bên dưới bên cạnh)</small>.<br> Sau khi hoàn tất thay đổi nhấn vào nút Edit để xác nhận ngừng.</b></p>
            <br>
            <h4>II. Lưu dự phòng database<br><small>(trên máy tính thiết kế)</small></h4>
            <p>Mục: <b>Backup</b></p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-11.png" width="600">
            </div>
            <p><b>Chọn mục Backup <i class="fa fa-chevron-right" aria-hidden="true"></i> New Project</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-12.png" width="600">
            </div>
            <p><b>Cột trái: Schemata <i class="fa fa-chevron-right" aria-hidden="true"></i> Chọn database cần backup<br>Nhấn mũi tên ">" để chuyển toàn bộ dữ liệu qua Cột phải: Backup Content<br>Nhấn Executive Backup Now để tiếp tục.</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-13.png" width="600">
            </div>
            <p><b>Chọn đường dẫn nơi lưu database.<br> Đặt tên database - File Name <small>(nhớ điền .sql vào cuối)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> Save</b></p>
            <br>
            <h4>III. Phục hồi / Gán database<br><small>(trên máy tính thiết kế)</small></h4>
            <p>Mục: <b>Restore</b></p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-14.png" width="600">
            </div>
            <p><b>Chọn mục Restore <i class="fa fa-chevron-right" aria-hidden="true"></i> Open Backup File</b></p>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
   	    		<img src="imagesguideline/step03-15.png" width="600">
            </div>
            <p><b>File to restore: <small>(đường dẫn file .sql cần phục hồi)</small><br> Another schema: <small>(chọn nơi chứa database phục hồi - cần khởi tạo schema mới trước lúc restore)</small><br> Ignore Errors <small>(chọn)</small> <i class="fa fa-chevron-right" aria-hidden="true"></i> Start Restore</b></p>
            <br>
        	<a href="traineecp.php" target="_self"><button type="button">Kết thúc phần 3 <i class="fa fa-chevron-right" aria-hidden="true"></i></button></a>
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
