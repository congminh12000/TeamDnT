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
$restrict->addLevel("2");
$restrict->Execute();
//End Restrict Access To Page
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width">
<title>TeamDnT - WebDesign : Admin Control Panel</title>
<script type="text/javascript" src="p7ehc/p7EHCscripts.js"></script>
<link href="p7csspbm2/p7csspbm2_12.css" rel="stylesheet" type="text/css">
<link href="p7csspbm2/p7csspbm2_print.css" rel="stylesheet" type="text/css" media="print">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome.css">
<link rel="stylesheet" href="../css/boostrap.css">
<link rel="stylesheet" href="../js/boostrap.js">
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
		mxi_includes_start("admincp_header.php");
		require(basename("admincp_header.php"));
		mxi_includes_end();
	?>
  </div>
  <div class="columns-wrapper">
  <div class="sidebar">
      <div class="content p7ehc-1">
         <?php
			  mxi_includes_start("admincp_menu.php");
			  require(basename("admincp_menu.php"));
			  mxi_includes_end();
		?>
      </div>
    </div>
    <div class="main-content">
      <div class="content p7ehc-1">
        <h1 class="page-topper">PROJECT MANAGEMENT</h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque congue tristique eros. Nulla facilisi. Quisque sem mauris, ullamcorper ac, gravida id, mattis id, sapien. Nullam adipiscing enim dapibus felis. Fusce a nisi in odio pulvinar fringilla. Nunc blandit interdum metus. Duis leo nunc, sollicitudin ut, fermentum congue, pharetra eu, massa. Suspendisse potenti. Morbi commodo mauris. Ut at pede. Ut id nisi. Donec scelerisque urna quis ligula. Praesent est. Vestibulum scelerisque. Curabitur quam. Fusce rhoncus pellentesque ipsum. Aenean venenatis metus ac quam. Maecenas lacus lacus, sagittis vitae, congue at, euismod eu, urna. Maecenas vitae purus. Praesent eros lectus, porta et, semper nec. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque congue tristique eros. Nulla facilisi. Quisque sem mauris, ullamcorper ac, gravida id, mattis id, sapien. Nullam adipiscing enim dapibus felis. Fusce a nisi in odio pulvinar fringilla. Nunc blandit interdum metus. Duis leo nunc, sollicitudin ut, fermentum congue, pharetra eu, massa. Suspendisse potenti. Morbi commodo mauris. Ut at pede. Ut id nisi. Donec scelerisque urna quis ligula. Praesent est. Vestibulum scelerisque. Curabitur quam. Fusce rhoncus pellentesque ipsum. Aenean venenatis metus ac quam. Maecenas lacus lacus, sagittis vitae, congue at, euismod eu, urna. Maecenas vitae purus. Praesent eros lectus, porta et, semper nec.</p>
      </div>
    </div>
</div>
  <?php
		mxi_includes_start("admincp_footer.php");
		require(basename("admincp_footer.php"));
		mxi_includes_end();
	?>
</div>
</body>
</html>
