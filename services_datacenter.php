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
$query_rs_copyright = "SELECT * FROM copyright WHERE ID_copyright = 1";
$rs_copyright = mysql_query($query_rs_copyright, $cnn_teamdnt) or die(mysql_error());
$row_rs_copyright = mysql_fetch_assoc($rs_copyright);
$totalRows_rs_copyright = mysql_num_rows($rs_copyright);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<link rel="stylesheet" href="js/boostrap.js">
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
              <span class="breadcrumb-item active">Lưu trữ dữ liệu</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="servicepage">
    	<div class="container">
        	<div class="row">
           	  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
               	<h3>DỊCH VỤ LƯU TRỮ DỮ LIỆU</h3>
                <img src="images/icon-hosting.png"><br><br><br>
              </div>
            </div> <!-- End row -->
            <div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
               		<h4>HOSTING LINUX<br><span class="line-orange"></span></h4><br><br>
                </div> <!-- End hosting linux title -->
                <table class="table table-bordered table-responsive">
                  <thead>
                  	<tr>
                    	<th class="text-center">&nbsp;#&nbsp;</th>
                        <th class="text-center">Hosting<br>(<800Mb)</th>
                        <th class="text-center">VPS</th>
                        <th class="text-center">Server</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                    	<th class="text-center">Phí vận hành / năm</th>
                        <td class="text-center">899.000 VND</td>
                        <td class="text-center">28.000.000 VND</td>
                        <td class="text-center">50.000.000 VND</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Băng thông</th>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Parking Domain</th>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Sub-domain</th>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                        <td class="text-center">Không giới hạn</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Hỗ trợ phục hồi dữ liệu</th>
                        <td class="text-center">3 ngày gần nhất</td>
                        <td class="text-center">Định kỳ / tuần</td>
                        <td class="text-center">Định kỳ / tuần</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Cập nhật thông tin</th>
                        <td class="text-center">< 72h</td>
                        <td class="text-center">< 24h</td>
                        <td class="text-center">< 6h</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Khắc phục sự cố mạng</th>
                        <td class="text-center">< 6h</td>
                        <td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	<span class="notetable">Báo giá trên dựa trên thông số cơ bản, được hầu hết khách hàng của TeamDnT sử dụng. Quý khách có nhu cầu thiết lập hệ thống tùy chỉnh phù hợp với yêu cầu riêng (core/ram/hdd) vui lòng gửi yêu cầu liên hệ <a href="contact.php" target="_self">&nbsp;tại đây <i class="fa fa-paper-plane" aria-hidden="true"></i></a>.</span>
                </div>
            </div> <!-- End row hosting linux -->
            <div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
               		<br><br><h4>EMAIL HOSTING<br><span class="line-orange"></span></h4><br><br>
                </div> <!-- End email hosting title -->
                <table class="table table-bordered table-responsive">
                  <thead>
                  	<tr>
                    	<th class="text-center">&nbsp;#&nbsp;</th>
                        <th class="text-center">30<br><small>hộp thư</small></th>
                        <th class="text-center">80<br><small>hộp thư</small></th>
                        <th class="text-center">150<br><small>hộp thư</small></th>
                        <th class="text-center">300<br><small>hộp thư</small></th>
                        <th class="text-center">500<br><small>hộp thư</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                    	<th class="text-center">Phí lưu trữ / năm</th>
                        <th class="text-center">3.360.000 VND<br><small>(280.000 VND / tháng)</small></th>
                        <th class="text-center">4.800.000 VND<br><small>(400.000 VND / tháng)</small></th>
                        <th class="text-center">7.200.000 VND<br><small>(600.000 VND / tháng)</small></th>
                        <th class="text-center">9.000.000 VND<br><small>(750.000 VND / tháng)</small></th>
                        <th class="text-center">14.400.000 VND<br><small>(1.200.000 VND / tháng)</small></th>
                    </tr>
                    <tr>
                    	<th class="text-center">Tổng lưu lượng ổ cứng</th>
                        <td class="text-center">60 GB</small></td>
                        <td class="text-center">160 GB</small></td>
                        <td class="text-center">300 GB</small></td>
                        <td class="text-center">600 GB</small></td>
                        <td class="text-center">1000 GB</small></td>
                    </tr>
                    <tr>
                    	<th class="text-center">Định kỳ gia hạn</th>
                        <td class="text-center">> 6 tháng</small></td>
                        <td class="text-center">> 6 tháng</small></td>
                        <td class="text-center">> 3 tháng</small></td>
                        <td class="text-center">> 3 tháng</small></td>
                        <td class="text-center">> 3 tháng</small></td>
                    </tr>
                    <tr>
                    	<th class="text-center">Khắc phục sự cố mạng</th>
                        <td class="text-center">< 2h</td>
						<td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Bàn giao dữ liệu<br><small>(Ngưng sử dụng dịch vụ)</small></th>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                    </tr>
                    <tr>
                    	<th class="text-center">Anti-spam / Anti-virus</th>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                    </tr>
                  </tbody>
                </table>
            </div> <!-- End row email hosting -->
            <div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
               		<br><br><h4>GOOGLE EMAIL<br><span class="line-orange"></span></h4><br><br>
                </div> <!-- End email google title -->
                <table class="table table-bordered table-responsive">
                  <thead>
                  	<tr>
                    	<th class="text-center">&nbsp;#&nbsp;</th>
                        <th class="text-center">50<br><small>hộp thư</small></th>
                        <th class="text-center">100<br><small>hộp thư</small></th>
                        <th class="text-center">200<br><small>hộp thư</small></th>
                        <th class="text-center">500<br><small>hộp thư</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                    	<th class="text-center">Phí mua trọn dịch vụ</th>
                        <th class="text-center">7.000.000 VND</th>
                        <th class="text-center">10.000.000 VND</th>
                        <th class="text-center">13.000.000 VND</th>
                        <th class="text-center">16.000.000 VND</th>
                    </tr>
                    <tr>
                    	<th class="text-center">Lưu lượng</th>
                        <td class="text-center">25 GB / hộp thư</td>
                        <td class="text-center">25 GB / hộp thư</td>
                        <td class="text-center">25 GB / hộp thư</td>
                        <td class="text-center">25 GB / hộp thư</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Khắc phục sự cố mạng</th>
                        <td class="text-center">< 2h</td>
						<td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                        <td class="text-center">< 2h</td>
                    </tr>
                    <tr>
                    	<th class="text-center">Tích hợp đầy đủ ứng dụng đính kèm của Gmail</th>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                        <td class="text-center"><img src="images/icon-yes.png" width="26" height="26"></td>
                    </tr>
                    <tr>
                    	<th class="text-center">Thời gian sử dụng<br><small>(Với điều kiện không nâng cấp tài khoản)</small></th>
                        <td class="text-center">Vĩnh viễn</td>
                        <td class="text-center">Vĩnh viễn</td>
                        <td class="text-center">Vĩnh viễn</td>
                        <td class="text-center">Vĩnh viễn</td>
                    </tr>
                  </tbody>
                </table>
            </div> <!-- End row email google -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
           		<a href="<?php echo $url ?>contact.html" class="btn btn-primary" role="button">Liên hệ <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                <p><i>Dịch vụ trên chưa bao gồm thuế giá trị gia tăng.</i></p>
                <p>Liên hệ tư vấn qua hotline <i class="fa fa-phone" aria-hidden="true"></i> (+84) 90.939.6888 .</p>
                </div>
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