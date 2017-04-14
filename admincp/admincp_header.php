<?php require_once('../Connections/cnn_teamdnt.php'); ?><?php
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
?><div class="logo">
      <a href="admincp.php" target="_self"><img src="../images/logo-teamdnt-horizontal.png" alt="TeamDnT - WebDesign"></a>
      <span class="logonotes"> - Content Management System</span>
</div>
<div class="headerlogout"><span class="hello">Hello,  <?php echo $_SESSION['kt_login_user'] ?></span>&nbsp;&nbsp;&nbsp;<a href="logout.php?logout=1" target="_self"><i class="fa fa-sign-out" aria-hidden="true"></i></a></div>
<div class="banner"><img src="p7csspbm2/img/pbm-mast.jpg" alt=""></div>