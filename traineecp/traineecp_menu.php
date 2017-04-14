<?php require_once('../Connections/cnn_teamdnt.php'); ?><?php
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
?><ul class="menuside">
          <li><a href="step01.php" target="_self">1.&nbsp;&nbsp;Cài đặt phần mềm</a></li>
          <li><a href="step02.php" target="_self">2.&nbsp;&nbsp;Cài đặt cơ bản</a></li>
          <li><a href="step03.php" target="_self">3.&nbsp;&nbsp;Tạo cơ sở dữ liệu</a></li>
          <li><a href="step04.php" target="_self">4.&nbsp;&nbsp;Các bảng CSDL</a></li><br><br>
</ul>