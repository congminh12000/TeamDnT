<?php require_once('Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('includes/common/KT_common.php');

// Load the tNG classes
require_once('includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("");

// Make unified connection variable
$conn_cnn_teamdnt = new KT_connection($cnn_teamdnt, $database_cnn_teamdnt);

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("kt_login_user", true, "text", "", "", "", "");
$formValidation->addField("kt_login_password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

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

// Make a login transaction instance
$loginTransaction = new tNG_login($conn_cnn_teamdnt);
$tNGs->addTransaction($loginTransaction);
// Register triggers
$loginTransaction->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "kt_login1");
$loginTransaction->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$loginTransaction->registerTrigger("END", "Trigger_Default_Redirect", 99, "{kt_login_redirect}");
// Add columns
$loginTransaction->addColumn("kt_login_user", "STRING_TYPE", "POST", "kt_login_user");
$loginTransaction->addColumn("kt_login_password", "STRING_TYPE", "POST", "kt_login_password");
$loginTransaction->addColumn("kt_login_rememberme", "CHECKBOX_1_0_TYPE", "POST", "kt_login_rememberme", "0");
// End of login transaction instance

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustom = $tNGs->getRecordset("custom");
$row_rscustom = mysql_fetch_assoc($rscustom);
$totalRows_rscustom = mysql_num_rows($rscustom);
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
              <span class="breadcrumb-item active">Đăng nhập</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="dntgate">
    	<div class="container">
        	<div class="row">
            	<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 text-center">
           	    	<img src="images/logo-teamdnt-ori.png" alt="<?php echo $row_rs_copyright['businessname']; ?>" width="140" height="140"></div>
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 text-center">
                	<img src="images/logo-dnt-gate.png" alt="<?php echo $row_rs_copyright['businessname']; ?>" width="140" height="140"></div>
                </div>
                <div class="hidden-xs hidden-sm col-md-4 col-lg-4">
                </div>
            </div> <!-- End row -->
        	<div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                	<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
                	<span class="dntgate_username"><input type="text" name="kt_login_user" id="kt_login_user" value="<?php echo KT_escapeAttribute($row_rscustom['kt_login_user']); ?>" size="24" placeholder="Username" />
        <?php echo $tNGs->displayFieldHint("kt_login_user");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_user");?></span><br>
        			<span class="dntgate_password"><input type="password" name="kt_login_password" id="kt_login_password" value="" size="24" placeholder="Password"/>
        <?php echo $tNGs->displayFieldHint("kt_login_password");?> <?php echo $tNGs->displayFieldError("custom", "kt_login_password"); ?></span><br><br>
        			<span class="dntgate_login"><input type="submit" name="kt_login1" id="kt_login1" value="Đăng nhập" /></span><br><br>
                    <a href="<?php echo $url ?>registration.html">Đăng ký tài khoản.</a>&nbsp;&nbsp;&nbsp;<a href="forgot_password.php">Quên mật khẩu?</a>
                    <br><br><br><br><br><br><br><br><br>
                   	</form>
                </div>
            </div> <!-- End row -->
        </div>
    </div> <!-- End dntgate -->
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
