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
              <span class="breadcrumb-item active">Thiết kế bộ nhận dạng thương hiệu</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
	<div class="servicepage">
    	<div class="container">
        	<div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h3>DỊCH VỤ THIẾT KẾ BỘ NHẬN DẠNG THƯƠNG HIỆU</h3>
                    <img src="images/icon-print.png"></div>
                </div>
            	<div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <br><br><h4>HẠNG MỤC<br><span class="line-orange"></span></h4><br><br>
                    </div> <!-- End hosting linux title -->
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-2 col-lg-push-2 text-center">
                <table class="table table-bordered table-responsive">
                  <thead>
                  	<tr>
                    	<th>#&nbsp;</th>
                        <th class="text-center">Dịch vụ</th>
                        <th class="text-center">&nbsp;$&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                    	<th scope="row">1</th>
                    	<th>Logo <small>(có Brand Guideline)</small></th>
                        <td class="text-right">5.600.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">2</th>
                    	<th>Logo <small>(không có Brand Guideline)</small></th>
                        <td class="text-right">1.800.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">3</th>
                    	<th>Folder</th>
                        <td class="text-right">700.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">4</th>
                    	<th>Broucher <small>(6 mặt)</small></th>
                        <td class="text-right">1.200.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">5</th>
                    	<th>Namecard</th>
                        <td class="text-right">500.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">6</th>
                    	<th>Catelogue <small>(16 trang)</small></th>
                        <td class="text-right">2.600.000 VND</td>
                    </tr>
                     <tr>
                    	<th scope="row">7</th>
                    	<th>Flyer</th>
                        <td class="text-right">300.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">8</th>
                    	<th>Invitation</th>
                        <td class="text-right">500.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">9</th>
                    	<th>Banner</th>
                        <td class="text-right">700.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">10</th>
                    	<th>Standee</th>
                        <td class="text-right">600.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">11</th>
                    	<th>Poster</th>
                        <td class="text-right">700.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">12</th>
                    	<th>Uniform</th>
                        <td class="text-right">500.000 VND</td>
                    </tr>
                    <tr>
                    	<th scope="row">12</th>
                    	<th>Voucher</th>
                        <td class="text-right">400.000 VND</td>
                    </tr>
                  </tbody>
                </table>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-push-2 col-lg-push-2">
                	<span class="notetable">Báo giá trên dựa trên chưa bao gồm chi phí in ấn và thuế giá trị gia tăng.</span>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <a href="<?php echo $url ?>contact.html" class="btn btn-primary" role="button">Liên hệ <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                    <p>Liên hệ tư vấn qua hotline <i class="fa fa-phone" aria-hidden="true"></i> (+84) 90.939.6888 .</p>
           		</div>
        	</div> <!-- End row -->
       	</div> <!-- End container -->
    </div> <!-- End servicepage -->
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