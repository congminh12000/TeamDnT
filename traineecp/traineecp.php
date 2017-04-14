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
        <?php
			  mxi_includes_start("traineecp_body.php");
			  require(basename("traineecp_body.php"));
			  mxi_includes_end();
		?>
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
