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
        	<h4>Các bảng cơ sở dữ liệu cơ bản</h4>
            <p>Đăng nhập: <b>MySQL Administrator.exe</b></p><br>
            <h4>1. ACCOUNT <small>(table)</small> - Comment: <small>(Tài khoản)</small></h4>
            <table class="table table-bordered table-responsive">
            	<thead>
                	<tr>
                    	<th class="text-center">Column Name</th>
                        <th class="text-center">Datatype</th>
                        <th class="text-center">Default Value</th>
                        <th class="text-center">Comment</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<th>ID_account<br><i class="fa fa-key" aria-hidden="true"></i></th>
                        <td>interger<br><small>(not null, auto inc)</small></td>
                        <td class="text-center">Null</td>
                        <td>Khóa chính</td>
                    </tr>
                    <tr>
                    	<th>username</th>
                        <td>varchar(68)</td>
                        <td class="text-center">Null</td>
                        <td>Tên tài khoản</td>
                    </tr>
                    <tr>
                    	<th>password</th>
                        <td>varchar(68)</td>
                        <td class="text-center">Null</td>
                        <td>Mật khẩu</td>
                    </tr>
                    <tr>
                    	<th>accesslevel</th>
                        <td>tinyint(6)</td>
                        <td class="text-center">1</td>
                        <td>Quyền đăng nhập</td>
                    </tr>
                    <tr>
                    	<th>fullname</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Họ tên</td>
                    </tr>
                    <tr>
                    	<th>avatar</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Hình đại diện</td>
                    </tr>
                    <tr>
                    	<th>email</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Email đăng ký</td>
                    </tr>
                    <tr>
                    	<th>loginerrortotal</th>
                        <td>tinyint(28)</td>
                        <td class="text-center">Null</td>
                        <td>Số lần đăng nhập sai</td>
                    </tr>
                    <tr>
                    	<th>disableuserdate</th>
                        <td>datetime</td>
                        <td class="text-center">Null</td>
                        <td>Ngày khóa tài khoản</td>
                    </tr>
                    <tr>
                    	<th>registereddate</th>
                        <td>datetime</td>
                        <td class="text-center">Null</td>
                        <td>Ngày đăng ký tài khoản</td>
                    </tr>
                </tbody>
            </table><br>
            <h4>2. COPYRIGHT <small>(table)</small> - Comment: <small>(Tác quyền)</small></h4>
            <table class="table table-bordered table-responsive">
            	<thead>
                	<tr>
                    	<th class="text-center">Column Name</th>
                        <th class="text-center">Datatype</th>
                        <th class="text-center">Default Value</th>
                        <th class="text-center">Comment</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<th>ID_copyright<br><i class="fa fa-key" aria-hidden="true"></i></th>
                        <td>interger<br><small>(not null, auto inc)</small></td>
                        <td class="text-center">Null</td>
                        <td>Khóa chính</td>
                    </tr>
                    <tr>
                    	<th>businessname</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Tên đại diện</td>
                    </tr>
                    <tr>
                    	<th>businesslogo</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Logo đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessaddress</th>
                        <td>varchar(258)</td>
                        <td class="text-center">Null</td>
                        <td>Địa chỉ đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessemail</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Email đại diện</td>
                    </tr>
                    <tr>
                    	<th>businesswebsite</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Website đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessphonenumber</th>
                        <td>varchar(26)</td>
                        <td class="text-center">Null</td>
                        <td>Điện thoại đại diện</td>
                    </tr>
                    <tr>
                    	<th>business_metades</th>
                        <td>text</td>
                        <td class="text-center">Null</td>
                        <td>Mô tả đại diện</td>
                    </tr>
                    <tr>
                    	<th>business_metakey</th>
                        <td>text</td>
                        <td class="text-center">Null</td>
                        <td>Từ khóa đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessfanpageaddon</th>
                        <td>text</td>
                        <td class="text-center">Null</td>
                        <td>Fanpage Addon Source</td>
                    </tr>
                    <tr>
                    	<th>businessgoogleanalytics</th>
                        <td>text</td>
                        <td class="text-center">Null</td>
                        <td>Google Analytics Tracking Source</td>
                    </tr>
                    <tr>
                    	<th>businessfacebook</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Facebook đại diện</td>
                    </tr>
                    <tr>
                    	<th>businesstwitter</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Twitter đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessgoogle</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Google đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessyoutube</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Youtube đại diện</td>
                    </tr>
                    <tr>
                    	<th>businessinstagram</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Instagram đại diện</td>
                    </tr>
                    <tr>
                    	<th>businesspinterest</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Pinterest đại diện</td>
                    </tr>
                </tbody>
            </table><br>
             <h4>3. CONTACT <small>(table)</small> - Comment: <small>(Liên hệ)</small></h4>
             <table class="table table-bordered table-responsive">
            	<thead>
                	<tr>
                    	<th class="text-center">Column Name</th>
                        <th class="text-center">Datatype</th>
                        <th class="text-center">Default Value</th>
                        <th class="text-center">Comment</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<th>ID_contact<br><i class="fa fa-key" aria-hidden="true"></i></th>
                        <td>interger<br><small>(not null, auto inc)</small></td>
                        <td class="text-center">Null</td>
                        <td>Khóa chính</td>
                    </tr>
                    <tr>
                    	<th>contactfullname</th>
                        <td>varchar(68)</td>
                        <td class="text-center">Null</td>
                        <td>Tên người liên hệ</td>
                    </tr>
                    <tr>
                    	<th>contactemail</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Email người liên hệ</td>
                    </tr>
                    <tr>
                    	<th>contactphonenumber</th>
                        <td>varchar(26)</td>
                        <td class="text-center">Null</td>
                        <td>Điện thoại người liên hệ</td>
                    </tr>
                    <tr>
                    	<th>contactaddress</th>
                        <td>varchar(168)</td>
                        <td class="text-center">Null</td>
                        <td>Địa chỉ người liên hệ</td>
                    </tr>
                    <tr>
                    	<th>contactcontent</th>
                        <td>text</td>
                        <td class="text-center">Null</td>
                        <td>Nội dung liên hệ</td>
                    </tr>
                    <tr>
                    	<th>contactdate</th>
                        <td>datetime</td>
                        <td class="text-center">Null</td>
                        <td>Ngày liên hệ</td>
                    </tr>
                </tbody>
            </table><br>
            <h4>4. NEWS CATEGORY <small>(table)</small> - Comment: <small>(Danh mục tin tức)</small></h4>
            <table class="table table-bordered table-responsive">
            	<thead>
                	<tr>
                    	<th class="text-center">Column Name</th>
                        <th class="text-center">Datatype</th>
                        <th class="text-center">Default Value</th>
                        <th class="text-center">Comment</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<th>ID_newscategory<br><i class="fa fa-key" aria-hidden="true"></i></th>
                        <td>interger<br><small>(not null, auto inc)</small></td>
                        <td class="text-center">Null</td>
                        <td>Khóa chính</td>
                    </tr>
                    <tr>
                    	<th>newcategoryname</th>
                        <td>varchar(68)</td>
                        <td class="text-center">Null</td>
                        <td>Tên danh mục tin tức</td>
                    </tr>
                    <tr>
                    	<th>newscategoryvisible</th>
                        <td>tinyint(2)</td>
                        <td class="text-center">Null</td>
                        <td>Ẩn / hiện danh mục tin tức</td>
                    </tr>
                    <tr>
                    	<th>newscategoryorderlist</th>
                        <td>integer</td>
                        <td class="text-center">Null</td>
                        <td>Sắp xếp thứ tự danh mục tin tức</td>
                    </tr> 
                </tbody>
            </table><br>
            <h4>5. NEWS <small>(table)</small> - Comment: <small>(Tin tức)</small></h4>
            <table class="table table-bordered table-responsive">
            	<thead>
                	<tr>
                    	<th class="text-center">Column Name</th>
                        <th class="text-center">Datatype</th>
                        <th class="text-center">Default Value</th>
                        <th class="text-center">Comment</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<th>ID_news<br><i class="fa fa-key" aria-hidden="true"></i></th>
                        <td>interger<br><small>(not null, auto inc)</small></td>
                        <td class="text-center">Null</td>
                        <td>Khóa chính</td>
                    </tr>
                    <tr>
                    	<th>newcategoryname</th>
                        <td>varchar(68)</td>
                        <td class="text-center">Null</td>
                        <td>Tên danh mục tin tức</td>
                    </tr>
                    <tr>
                    	<th>newscategoryvisible</th>
                        <td>tinyint(2)</td>
                        <td class="text-center">Null</td>
                        <td>Ẩn / hiện danh mục tin tức</td>
                    </tr>
                    <tr>
                    	<th>newscategoryorderlist</th>
                        <td>integer</td>
                        <td class="text-center">Null</td>
                        <td>Sắp xếp thứ tự danh mục tin tức</td>
                    </tr> 
                </tbody>
            </table><br>
        </div> <!-- End column -->
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
