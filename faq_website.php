<?php require_once('Connections/cnn_teamdnt.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_copyright = "SELECT ID_copyright, businessname, businessaddress, businessphonenumber, businessemail, businesslogo, business_metakey, business_metades, businessfanpageaddon, businessgoogleanalytics, businesswebsite FROM copyright WHERE ID_copyright = 1";
$rs_copyright = mysql_query($query_rs_copyright, $cnn_teamdnt) or die(mysql_error());
$row_rs_copyright = mysql_fetch_assoc($rs_copyright);
$totalRows_rs_copyright = mysql_num_rows($rs_copyright);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $row_rs_copyright['businessname']; ?></title>
<meta name="description" content="<?php echo $row_rs_copyright['business_metades']; ?>">
<meta name="keywords" content="<?php echo $row_rs_copyright['business_metakey']; ?>">
<meta name="author" content="<?php echo $row_rs_copyright['businessname']; ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="css/style-primary.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="shortcut icon" href="images/favicon-teamdnt.ico">
</head>

<body>
	<?php include("index_hotnews.php");?>
    <?php include("index_header.php");?>
    <div class="breadcrumb_total">
    	<div class="container">
            <nav class="breadcrumb">
              <a class="breadcrumb-item" href="<?php echo $url ?>index.html"><i class="fa fa-home" aria-hidden="true"></i></a>
              <span class="delimiter"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
              <a class="breadcrumb-item" href="<?php echo $url ?>services-website.html" target="_self">Thiết kế website</a>
              <span class="delimiter"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
              <span class="breadcrumb-item active">FAQ</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="faq">
    	<div class="container">
        	<br>
        	<h3><i class="fa fa-question-circle" aria-hidden="true"></i> Câu hỏi thường gặp</h3>
  			<p class="notes">Những câu hỏi thường gặp về thiết kế website. Liên hệ để được tư vấn tại đây.</p>
        	<br>
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                   <img src="images/icon-1.png" width="26" height="26">&nbsp;&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                   Domain là gì? Hosting là gì?</a>
                  </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                  <div class="panel-body">– Domain hay còn gọi là tên miền được hiểu đơn giản là địa chỉ của website trên internet. Tại Việt Nam có nhiều nhà cung cấp cho thuê tên miền như Mắt Bão, PAVietnam, FPT, …Tên miền được cung cấp dưới dạng cho thuê tùy theo thời gian đăng ký 1, 3 hoặc 5 năm và không có sở hữu vĩnh viễn và cần gia hạn tên miền khi gần hết hạn hợp đồng.Tùy theo mục đích sử dụng có thể đăng ký 1 hoặc nhiều tên miền cùng tên hoặc khác tên với các đuôi như .com, .com.vn, .vn, .net, .asia, .top, .luxury. Bảng giá tên miền tại nhà cung cấp hầu như gần bằng nhau. TeamDnT hỗ trợ khách hàng đăng ký tên miền thông qua các nhà cung cấp trên nếu có yêu cầu thiết kế website.<br><br>
				– Hosting hay còn gọi chung chung là host được hiểu như là nơi lưu trữ dữ liệu website để hoạt động 24/24. Tương tự như tên miền, hosting được cung cấp dựa trên phí duy trì được tính theo hàng thắng hoặc hàng năm. Chi phí thuê hosting dựa trên dung lượng lưu trữ / khối lượng thông tin trên website. TeamDnT cung cấp dịch vụ hosting 1 năm đầu sử dụng trong gói thiết kế website bao gồm cả gói cơ bản nhất và phí gia hạn được tính kể từ đầu năm thứ 2 sử dụng.</div>
                </div>
              </div> <!-- End faq1 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <img src="images/icon-2.png" width="26" height="26">&nbsp;&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    Tổng chi phí cho một website hoạt động là bao nhiêu?</a>
                  </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <div class="panel-body">Để một website hoạt động tức hiển thị online 24/24 cần đầy đủ 3 yếu tố sau:<br><br>
				+ Tên miền website. VD: www.teamdnt.asia (trả định kỳ hàng năm với giá theo nhà cung cấp tên miền)<br><br>
				+ Hosting nơi lưu trữ dữ liệu (miễn phí năm đầu theo gói thiết kế website, trả định kỳ hàng năm theo bảng phí hiện hành)<br><br>
				+ Dữ liệu website (trả 1 lần duy nhất khi đăng ký dịch vụ thiết kế website với bảng giá thiết kế hiện hành)</div>
                </div>
              </div> <!-- End faq2 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <img src="images/icon-3.png" width="26" height="26">&nbsp;&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                    Tôi cần cung cấp thông tin gì khi thiết kế website?</a>
                  </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                  <div class="panel-body">Chuẩn bị đầy đủ thông tin khi thiết kế website là một bước quan trọng giúp dự án triển khai đúng tiến độ, bản demo sát với bản chính thức bao gồm:<br><br>
					– Logo (file .psd, .ai, .eps, .png, .jpg), bảng màu chủ đạo (nếu có)<br><br>
					– Hình ảnh liên quan (.png, .jpg)<br><br>
					– Nội dung (thông tin giới thiệu, liên hệ, hoạt động, sản phẩm, tin tức mẫu)</div>
                </div>
              </div> <!-- End faq3 -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <img src="images/icon-4.png" width="26" height="26">&nbsp;&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                    Đội ngũ có cung cấp dịch vụ hậu mãi, bảo trì website không?</a>
                  </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                  <div class="panel-body">Khách hàng sử dụng gói thiết kế website bao gồm dịch vụ miễn phí hosting năm đầu, bên cạnh đó ưu đãi đi kèm như backup dữ liệu, khắc phục sự cố mạng đột xuất, hỗ trợ thay đổi chỉnh sửa nội dung không quá 10% nội dung website.<br><br>
					Hỗ trợ tư vấn trong thời gian sử dụng, bảo trì khi có sự cố xảy ra từ phía khách hàng quản trị website.</div>
                </div>
              </div> <!-- End faq4 -->
            </div> <!-- End panel-group -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <a href="<?php echo $url ?>services-website.html" class="btn btn-primary" role="button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Quay lại</a>
                    <p>Liên hệ tư vấn qua hotline <i class="fa fa-phone" aria-hidden="true"></i> (+84) 90.939.6888 .</p>
           		</div>
        </div> <!-- End container -->
    </div> <!-- End FAQ -->
    <br><br><br>
	<?php include("index_footer.php");?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
mysql_free_result($rs_copyright);
?>