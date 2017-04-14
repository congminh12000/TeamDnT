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

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Passwords do not match.");
  $myThrowError->setField("password");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

//start CheckCaptcha trigger
//remove this line if you want to edit the code by hand
function CheckCaptcha(&$tNG) {
	$captcha = new tNG_Captcha("captcha_id_id", $tNG);
	$captcha->setFormField("POST", "captcha_id");
	$captcha->setErrorMsg("Wrong typing!!!");
	return $captcha->Execute();
}
//end CheckCaptcha trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("avatar");
  $uploadObj->setDbFieldName("avatar");
  $uploadObj->setFolder("images/");
  $uploadObj->setMaxSize(2600);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("account");
  $tblFldObj->addFieldName("email");
  $tblFldObj->setErrorMsg("This email was registered in system!");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("username", true, "text", "", "", "", "");
$formValidation->addField("password", true, "text", "", "", "", "");
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
$query_rs_copyright = "SELECT ID_copyright, businessname, businessaddress, businessphonenumber, businessemail, businesslogo, business_metakey, business_metades, businessfacebook, businessgoogle, businessyoutube, businessfanpageaddon, businessgoogleanalytics FROM copyright WHERE ID_copyright = 1";
$rs_copyright = mysql_query($query_rs_copyright, $cnn_teamdnt) or die(mysql_error());
$row_rs_copyright = mysql_fetch_assoc($rs_copyright);
$totalRows_rs_copyright = mysql_num_rows($rs_copyright);

// Make an insert transaction instance
$userRegistration = new tNG_insert($conn_cnn_teamdnt);
$tNGs->addTransaction($userRegistration);
// Register triggers
$userRegistration->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$userRegistration->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$userRegistration->registerTrigger("END", "Trigger_Default_Redirect", 99, "registration_success.php");
$userRegistration->registerConditionalTrigger("{POST.password} != {POST.re_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$userRegistration->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
$userRegistration->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$userRegistration->registerTrigger("BEFORE", "CheckCaptcha", 10);
// Add columns
$userRegistration->setTable("account");
$userRegistration->addColumn("fullname", "STRING_TYPE", "POST", "fullname");
$userRegistration->addColumn("email", "STRING_TYPE", "POST", "email");
$userRegistration->addColumn("avatar", "FILE_TYPE", "FILES", "avatar");
$userRegistration->addColumn("username", "STRING_TYPE", "POST", "username");
$userRegistration->addColumn("password", "STRING_TYPE", "POST", "password");
$userRegistration->addColumn("registereddate", "DATE_TYPE", "POST", "registereddate", "{NOW_DT}");
$userRegistration->setPrimaryKey("ID_account", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsaccount = $tNGs->getRecordset("account");
$row_rsaccount = mysql_fetch_assoc($rsaccount);
$totalRows_rsaccount = mysql_num_rows($rsaccount);

// Captcha Image
$captcha_id_obj = new KT_CaptchaImage("captcha_id_id");
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
<link href="includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="includes/common/js/base.js" type="text/javascript"></script>
<script src="includes/common/js/utility.js" type="text/javascript"></script>
<script src="includes/skins/style.js" type="text/javascript"></script>
</head>

<body>
	<?php include("index_hotnews.php");?>
	<?php include("index_header.php");?>
     <div class="breadcrumb_total">
    	<div class="container">
            <nav class="breadcrumb">
              <a class="breadcrumb-item" href="<?php echo $url ?>index.html"><i class="fa fa-home" aria-hidden="true"></i></a>
              <span class="delimiter"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
              <span class="breadcrumb-item active">Đăng ký</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="registration">
    	<div class="container">
        	<form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
        	<div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                	<h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ĐĂNG KÝ TÀI KHOẢN</h3>
                    <br><br>
                    <div class="row">
                    	<div class="hidden-xs hidden-sm col-md-2 col-lg-2">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 text-center">
                        	<div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left registration_label">
                                	<span class="registrationlabel">Họ tên:</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="text" name="fullname" id="fullname" value="<?php echo KT_escapeAttribute($row_rsaccount['fullname']); ?>" size="32" /><?php echo $tNGs->displayFieldHint("fullname");?> <?php echo $tNGs->displayFieldError("account", "fullname"); ?></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Email (<font style="color: #f9a020">*</font>):</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="text" name="email" id="email" value="<?php echo KT_escapeAttribute($row_rsaccount['email']); ?>" size="32" /><?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("account", "email"); ?></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Ảnh đại diện:<br>(Size: 150x150 pixels)</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="file" name="avatar" id="avatar" size="32" /><?php echo $tNGs->displayFieldError("account", "avatar"); ?></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Tên đăng nhập (<font style="color: #f9a020">*</font>):</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="text" name="username" id="username" value="<?php echo KT_escapeAttribute($row_rsaccount['username']); ?>" size="32" /><?php echo $tNGs->displayFieldHint("username");?> <?php echo $tNGs->displayFieldError("account", "username"); ?></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Mật khẩu (<font style="color: #f9a020">*</font>):</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="password" name="password" id="password" value="" size="32" /><?php echo $tNGs->displayFieldHint("password");?> <?php echo $tNGs->displayFieldError("account", "password"); ?></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Nhập lại Mật khẩu (<font style="color: #f9a020">*</font>):</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="password" name="re_password" id="re_password" value="" size="32" /></span>
                                </div>
                            </div> <!-- End row -->
                            <div class="row">
                            	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left">
                                	<span class="registrationlabel">Mã bảo mật (<font style="color: #f9a020">*</font>):</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 text-left">
                                	<span class="registrationform"><input type="text" name="captcha_id" id="captcha_id" value="" /></span>
                                    <br />
                                       	Nhập mã bảo mật theo hình bên dưới.<br />
                                        <img src="<?php echo $captcha_id_obj->getImageURL("");?>" border="1px" />
                                </div>
                            </div> <!-- End row -->
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-2">
                        </div>
                    </div> <!-- End row -->
                    <div class="row">
                    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        	<span class="registrationform"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Đăng ký" /></span>
                        </div>
                    </div><!-- End row -->
                   	<input type="hidden" name="registereddate" id="registereddate" value="<?php echo KT_formatDate($row_rsaccount['registereddate']); ?>" />
                    <div class="row">
                    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-push-3 col-lg-push-3 text-center">
                       	  <?php
								echo $tNGs->getErrorMsg();
						  ?>
                        </div>
                    </div><!-- End row -->
                </div>
                </div>
            </div> <!-- End row -->
		</form>
        </div>
    </div> <!-- End registraion -->
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