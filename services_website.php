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
$query_rs_copyright = "SELECT ID_copyright, businessname, businessaddress, businessphonenumber, businessemail, businesslogo, business_metakey, business_metades, businessfacebook, businessgoogle, businessyoutube, businessfanpageaddon, businessgoogleanalytics FROM copyright WHERE ID_copyright = 1";
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
              <span class="breadcrumb-item active">Thiết kế website</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="servicepage">
    	<div class="container">
        	<div class="row">
           	  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
               	<h3>DỊCH VỤ THIẾT KẾ WEBSITE</h3>
                <img src="images/icon-web.png"></div>
            </div> <!-- End row -->
            <div class="row">
            	<div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
                    <table width="100%" style="border: 1px solid #ffd9a3;" border="1" cellspacing="0" cellpadding="0">
                      <tr><br><br>
                        <td width="16%" align="center">&nbsp;#&nbsp;</td>
                        <td width="21%" align="center"><strong>Kinh doanh nhỏ<br />
                        800.000 VND</strong></td>
                        <td width="21%" align="center"><strong>Doanh nghiệp vừa / nhỏ<br />
                        3.500.000 VND</strong></td>
                        <td width="21%" align="center"><strong>Thương mại điện tử<br>
                        5.000.000 VND</strong></td>
                        <td width="21%" align="center"><strong>Thiết kế riêng<br>
                        8.000.000 VND</strong></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Kho giao diện</strong></td>
                        <td align="center">Cơ bản<br>
                        10 – 20 mẫu<br>
                        (Link kho theme cơ bản)</td>
                        <td align="center">Cao cấp<br>
                        50 – 70 mẫu<br>
                        (Link kho theme cao cấp)
                        </td>
                        <td align="center">Shopping Online<br>
                        30 mẫu<br>
                        (Link kho theme shopping)</td>
                        <td align="center">Theme bản quyền<br>
                        $25 – $55</td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Miễn phí hosting năm đầu</strong></td>
                        <td align="center"><img src="images/icon-no.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Google Analytics</strong></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>SEO</strong></td>
                        <td align="center">Cơ bản</td>
                        <td align="center">Cơ bản</td>
                        <td align="center">Chi tiết</td>
                        <td align="center">Chi tiết</td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Chức năng + / Widget</strong></td>
                        <td align="center"><img src="images/icon-no.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-no.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Social Backlinks</strong></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Blog / Tin tức</strong></td>
                        <td align="center">Cơ bản</td>
                        <td align="center">Cơ bản</td>
                        <td align="center">Nâng cao</td>
                        <td align="center">Nâng cao</td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Shop / Thanh toán</strong></td>
                        <td align="center"><img src="images/icon-no.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-no.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Hiển thị trên thiết bị di động</strong></td>
                        <td align="center">Android / iOS / WindowPhone</td>
                        <td align="center">Android / iOS / WindowPhone</td>
                        <td align="center">Android / iOS / WindowPhone</td>
                        <td align="center">Android / iOS / WindowPhone</td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Hướng dẫn quản trị</strong></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td align="center"><img src="images/icon-yes.png" width="26" height="26"></td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Thời gian hoàn thành tối đa</strong></td>
                        <td align="center">3 ngày</td>
                        <td align="center">15 ngày</td>
                        <td align="center">30 ngày</td>
                        <td align="center">30 ngày</td>
                      </tr>
                      <tr>
                        <td align="center"><strong>Hosting tính từ năm thứ 2<br>
                          (dung lượng &lt; 1Gb)</strong></td>
                        <td align="center">899.000 VND</td>
                        <td align="center">899.000 VND</td>
                        <td align="center">899.000 VND</td>
                        <td align="center">899.000 VND</td>
                      </tr>
                    </table>
            	</div> <!-- End view desktop-->
                <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                	<table class="table table-bordered"><br><br>
                    	<thead>
                        	<tr class="bg-warning">
                            	<th class="text-center" colspan="2">KINH DOANH NHỎ<br>800.000 VND<br><small><span class="whitelink"><a href="<?php echo $url ?>contact.html" target="_self">đặt hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a></span></small></th>
                            </tr>
                      	</thead>
                       	<tbody>
                        	<tr>
                            	<td><strong>Kho giao diện</strong></td>
                                <td class="text-center">Cơ bản<br>
                                10 – 20 mẫu<br>
								(Link kho theme cơ bản)</td>
                            </tr>
                            <tr>
                            	<td><strong>Miễn phí hosting năm đầu</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Google Analytics</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>SEO</strong></td>
                                <td class="text-center">Cơ bản</td>
                            </tr>
                            <tr>
                            	<td><strong>Chức năng + / Widget</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Social Backlinks</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Blog / Tin tức</strong></td>
                                <td class="text-center">Cơ bản</td>
                            </tr>
                            <tr>
                            	<td><strong>Shop / Thanh toán</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Hiển thị trên thiết bị di động</strong></td>
                                <td class="text-center">Android / iOS / WindowPhone</td>
                            </tr>
                            <tr>
                            	<td><strong>Hướng dẫn quản trị</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Thời gian hoàn thành tối đa</strong></td>
                                <td class="text-center">3 ngày</td>
                            </tr>
                            <tr>
                            	<td><strong>Hosting tính từ năm thứ 2 (dung lượng < 1Gb)</strong></td>
                                <td class="text-center">899.000 VND</td>
                            </tr>
                        </tbody>
                    </table> <!-- End package Kinh doanh nhỏ -->
                    <table class="table table-bordered"><br><br>
                    	<thead>
                        	<tr class="bg-warning">
                            	<th class="text-center" colspan="2">DOANH NGHIỆP VỪA / NHỎ<br>3.500.000 VND<br><small><span class="whitelink"><a href="<?php echo $url ?>contact.html" target="_self">đặt hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a></span></small></th>
                            </tr>
                      	</thead>
                       	<tbody>
                        	<tr>
                            	<td><strong>Kho giao diện</strong></td>
                                <td class="text-center">Cao cấp<br>
                                50 – 70 mẫu<br>
								(Link kho theme cao cấp)</td>
                            </tr>
                            <tr>
                            	<td><strong>Miễn phí hosting năm đầu</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Google Analytics</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>SEO</strong></td>
                                <td class="text-center">Cơ bản</td>
                            </tr>
                            <tr>
                            	<td><strong>Chức năng + / Widget</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Social Backlinks</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Blog / Tin tức</strong></td>
                                <td class="text-center">Cơ bản</td>
                            </tr>
                            <tr>
                            	<td><strong>Shop / Thanh toán</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Hiển thị trên thiết bị di động</strong></td>
                                <td class="text-center">Android / iOS / WindowPhone</td>
                            </tr>
                            <tr>
                            	<td><strong>Hướng dẫn quản trị</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Thời gian hoàn thành tối đa</strong></td>
                                <td class="text-center">15 ngày</td>
                            </tr>
                            <tr>
                            	<td><strong>Hosting tính từ năm thứ 2 (dung lượng < 1Gb)</strong></td>
                                <td class="text-center">899.000 VND</td>
                            </tr>
                        </tbody>
                    </table> <!-- End package Doanh nghiệp vừa / nhỏ -->
                    <table class="table table-bordered"><br><br>
                    	<thead>
                        	<tr class="bg-warning">
                            	<th class="text-center" colspan="2">THƯƠNG MẠI ĐIỆN TỬ<br>5.000.000 VND<br><small><span class="whitelink"><a href="<?php echo $url ?>contact.html" target="_self">đặt hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a></span></small></th>
                            </tr>
                      	</thead>
                       	<tbody>
                        	<tr>
                            	<td><strong>Kho giao diện</strong></td>
                                <td class="text-center">Shopping Online<br>
                                30 mẫu<br>
								(Link kho theme shopping)</td>
                            </tr>
                            <tr>
                            	<td><strong>Miễn phí hosting năm đầu</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Google Analytics</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>SEO</strong></td>
                                <td class="text-center">Chi tiết</td>
                            </tr>
                            <tr>
                            	<td><strong>Chức năng + / Widget</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Social Backlinks</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Blog / Tin tức</strong></td>
                                <td class="text-center">Nâng cao</td>
                            </tr>
                            <tr>
                            	<td><strong>Shop / Thanh toán</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Hiển thị trên thiết bị di động</strong></td>
                                <td class="text-center">Android / iOS / WindowPhone</td>
                            </tr>
                            <tr>
                            	<td><strong>Hướng dẫn quản trị</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Thời gian hoàn thành tối đa</strong></td>
                                <td class="text-center">30 ngày</td>
                            </tr>
                            <tr>
                            	<td><strong>Hosting tính từ năm thứ 2 (dung lượng < 1Gb)</strong></td>
                                <td class="text-center">899.000 VND</td>
                            </tr>
                        </tbody>
                    </table> <!-- End package Thương mại điện tử -->
                    <table class="table table-bordered"><br><br>
                    	<thead>
                        	<tr class="bg-warning">
                            	<th class="text-center" colspan="2">THIẾT KẾ RIÊNG<br>8.000.000 VND<br><small><span class="whitelink"><a href="<?php echo $url ?>contact.html" target="_self">đặt hàng <i class="fa fa-angle-right" aria-hidden="true"></i></a></span></small></th>
                            </tr>
                      	</thead>
                       	<tbody>
                        	<tr>
                            	<td><strong>Kho giao diện</strong></td>
                                <td class="text-center">Theme bản quyền<br>
                                $25 – $55</td>
                            </tr>
                            <tr>
                            	<td><strong>Miễn phí hosting năm đầu</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Google Analytics</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>SEO</strong></td>
                                <td class="text-center">Chi tiết</td>
                            </tr>
                            <tr>
                            	<td><strong>Chức năng + / Widget</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Social Backlinks</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Blog / Tin tức</strong></td>
                                <td class="text-center">Nâng cao</td>
                            </tr>
                            <tr>
                            	<td><strong>Shop / Thanh toán</strong></td>
                                <td class="text-center"><img src="images/icon-no.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Hiển thị trên thiết bị di động</strong></td>
                                <td class="text-center">Android / iOS / WindowPhone</td>
                            </tr>
                            <tr>
                            	<td><strong>Hướng dẫn quản trị</strong></td>
                                <td class="text-center"><img src="images/icon-yes.png" width="24" height="24"></td>
                            </tr>
                            <tr>
                            	<td><strong>Thời gian hoàn thành tối đa</strong></td>
                                <td class="text-center">30 ngày</td>
                            </tr>
                            <tr>
                            	<td><strong>Hosting tính từ năm thứ 2 (dung lượng < 1Gb)</strong></td>
                                <td class="text-center">899.000 VND</td>
                            </tr>
                        </tbody>
                    </table> <!-- End package Thương mại điện tử -->
                </div> <!-- End view mobile-->
            </div> <!-- End row table-->
            <div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                	<a href="<?php echo $url ?>contact.html" class="btn btn-primary" role="button">Liên hệ <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                	<p><i>Dịch vụ bao gồm hỗ trợ tư vấn mua tên miền theo yêu cầu của khách hàng.</i></p>
                    <p>Tham khảo <a href="#">QUY TRÌNH THỰC HIỆN DỰ ÁN</a> của TeamDnT.</p>
                    <p>Liên hệ tư vấn qua hotline <i class="fa fa-phone" aria-hidden="true"></i> (+84) 90.939.6888 hoặc xem <a href="<?php echo $url ?>faq-webdesign.html" target="_blank"><i class="fa fa-question-circle" aria-hidden="true"></i> Câu hỏi thường gặp</a>.</p>
                </div>
            </div> <!-- End row -->
        </div> <!-- End container -->
    </div> <!-- End Service Page -->
    <?php include("index_footer.php");?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Google Analytics Tracking -->
<?php echo $row_rs_copyright['businessgoogleanalytics']; ?>
</body>
</html>
<?php
mysql_free_result($rs_copyright);
?>