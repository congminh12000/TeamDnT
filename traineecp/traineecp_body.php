<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
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
		<h1 class="page-topper">TRAINING GUIDELINE</h1><br>
        <p>Tài liệu hướng dẫn quy trình thiết kế website - cms tại <strong><font style="color:#f9a020">TeamDnT</font></strong>.</p>
        <p>Tất cả thành viên tuân thủ theo quy chuẩn thiết kế chung để hỗ trợ, kế thừa trong các hoạt động, dự án của đội.</p>
        <p>Chúc may mắn! <img src="../images/icon-clover-grass.png" alt="Clover Grass"></p><br>
        <h4><a href="step01.php" target="_self">Phần 1: Cài đặt phần mềm</a></h4>
        <h4><a href="step02.php" target="_self">Phần 2: Cài đặt cơ bản</a></h4>
        <h4><a href="step03.php" target="_self">Phần 3: Khởi tạo cơ sở dữ liệu</a></h4>
        <h4><a href="step04.php" target="_self">Phần 4: Các bảng CSDL mặc định</a></h4>