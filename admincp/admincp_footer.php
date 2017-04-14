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
?><div class="footer"><p class="copyright">&copy; 2017 Copyright by <a href="http://www.teamdnt.website">TeamDnT - WebDesign</a></p></div>