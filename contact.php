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
$formValidation->addField("contactemail", true, "text", "email", "", "", "Vui lòng nhập email liên hệ.");
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

// Make an insert transaction instance
$ins_contact = new tNG_insert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_contact);
// Register triggers
$ins_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "contact_success.php");
// Add columns
$ins_contact->setTable("contact");
$ins_contact->addColumn("contactgroup", "NUMERIC_TYPE", "POST", "contactgroup");
$ins_contact->addColumn("contactfullname", "STRING_TYPE", "POST", "contactfullname");
$ins_contact->addColumn("contactservice", "NUMERIC_TYPE", "POST", "contactservice");
$ins_contact->addColumn("contactemail", "STRING_TYPE", "POST", "contactemail");
$ins_contact->addColumn("contactphonenumber", "STRING_TYPE", "POST", "contactphonenumber");
$ins_contact->addColumn("contacttitle", "STRING_TYPE", "POST", "contacttitle");
$ins_contact->addColumn("contactnotes", "STRING_TYPE", "POST", "contactnotes");
$ins_contact->addColumn("contactdate", "DATE_TYPE", "POST", "contactdate", "{NOW_DT}");
$ins_contact->setPrimaryKey("ID_contact", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscontact = $tNGs->getRecordset("contact");
$row_rscontact = mysql_fetch_assoc($rscontact);
$totalRows_rscontact = mysql_num_rows($rscontact);
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
<?php echo $tNGs->displayValidationRules();?>
</head>

<body>
	<?php include("index_hotnews.php");?>
    <?php include("index_header.php");?>
    <div class="breadcrumb_total">
    	<div class="container">
            <nav class="breadcrumb">
              <a class="breadcrumb-item" href="<?php echo $url ?>index.html"><i class="fa fa-home" aria-hidden="true"></i></a>
              <span class="delimiter"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
              <span class="breadcrumb-item active">Liên hệ</span>
            </nav>
        </div>
    </div> <!-- End Breadcrumb -->
    <div class="registration">
    	<div class="container">
        	<div class="row">
            	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <p class="notes"><i class="fa fa-terminal" aria-hidden="true"></i>&nbsp;&nbsp;Vui lòng gửi nội dung theo mẫu bên dưới cho chúng tôi nếu có bất kỳ thắc mắc nào.</p><br>
                   <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Khách hàng:</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><select name="contactgroup" id="contactgroup">
                              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscontact['contactgroup'])))) {echo "SELECTED";} ?>>Công ty</option>
                              <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rscontact['contactgroup'])))) {echo "SELECTED";} ?>>Cá nhân</option>
                            </select>
                              <?php echo $tNGs->displayFieldError("contact", "contactgroup"); ?></span>
                        </div>
                      </div> <!-- End row -->
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Họ tên (<font style="color: #f9a020">*</font>):</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><input type="text" name="contactfullname" id="contactfullname" value="<?php echo KT_escapeAttribute($row_rscontact['contactfullname']); ?>" size="43" />
                              <?php echo $tNGs->displayFieldHint("contactfullname");?> <?php echo $tNGs->displayFieldError("contact", "contactfullname"); ?></span>
                        </div>
                      </div> <!-- End row -->
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Dịch vụ yêu cầu:</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><select name="contactservice" id="contactservice">
                              <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Thiết kế website</option>
                              <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Thiết kế bộ nhận dạng thương hiệu</option>
                              <option value="3" <?php if (!(strcmp(3, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Lưu trữ dữ liệu (hosting)</option>
                              <option value="4" <?php if (!(strcmp(4, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Lưu trữ email nội bộ (email hosting)</option>
                            </select>
                              <?php echo $tNGs->displayFieldError("contact", "contactservice"); ?></span>
                        </div>
                      </div> <!-- End row -->
                      <div class="row"> 
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Email (<font style="color: #f9a020">*</font>):</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><input type="text" name="contactemail" id="contactemail" value="<?php echo KT_escapeAttribute($row_rscontact['contactemail']); ?>" size="43" />
                              <?php echo $tNGs->displayFieldHint("contactemail");?> <?php echo $tNGs->displayFieldError("contact", "contactemail"); ?></span>
                        </div>
                      </div> <!-- End row -->
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Số điện thoại liên lạc:</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><input type="text" name="contactphonenumber" id="contactphonenumber" value="<?php echo KT_escapeAttribute($row_rscontact['contactphonenumber']); ?>" size="43" />
                              <?php echo $tNGs->displayFieldHint("contactphonenumber");?> <?php echo $tNGs->displayFieldError("contact", "contactphonenumber"); ?></span>
                        </div>
                      </div> <!-- End row -->  
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Yêu cầu về (<font style="color: #f9a020">*</font>):</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><input type="text" name="contacttitle" id="contacttitle" value="<?php echo KT_escapeAttribute($row_rscontact['contacttitle']); ?>" size="43" />
                              <?php echo $tNGs->displayFieldHint("contacttitle");?> <?php echo $tNGs->displayFieldError("contact", "contacttitle"); ?></span>
                        </div>
                      </div> <!-- End row -->  
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <span class="registrationlabel">Nội dung chi tiết:</span>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                            <span class="registrationform"><textarea name="contactnotes" id="contactnotes" cols="44" rows="5"><?php echo KT_escapeAttribute($row_rscontact['contactnotes']); ?></textarea>
                              <?php echo $tNGs->displayFieldHint("contactnotes");?> <?php echo $tNGs->displayFieldError("contact", "contactnotes"); ?></span>
                        </div>
                      </div> <!-- End row -->
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                            <span class="registrationform"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="GỬI" /></span>
                            <?php
                                echo $tNGs->getErrorMsg();
                              ?>
                        </div>
                      </div> <!-- End row -->
                  <input type="hidden" name="contactdate" id="contactdate" value="<?php echo KT_formatDate($row_rscontact['contactdate']); ?>" />
                  </form>
            	</div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                	<h3>hoặc liên hệ trực tiếp</h3><br>
                    <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;Hotline: (+84) 909 396 888</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Email: teamdnt.asia@gmail.com</p>
                    <p><i class="fa fa-facebook-square" aria-hidden="true"></i>&nbsp;&nbsp;Facebook: <a href="https://www.facebook.com/teamdnt.asia/" target="_blank">TeamDnT - WebDesign</a></p>
                    <p><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;&nbsp;Google Map: </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3919.5028962731835!2d106.6766085031804!3d10.772742144690094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x31752f20de064a83%3A0x8729185254a2931d!2zVk5UIE1vYmlsZSwgNDgyIMSQaeG7h24gQmnDqm4gUGjhu6csIFBoxrDhu51uZyAxMSwgUXXhuq1uIDEwLCBUUC5IQ00!3m2!1d10.7726598!2d106.67888359999999!5e0!3m2!1svi!2s!4v1485469575698" width="100%" height="250" frameborder="0" style="border:2px solid #f9a020" allowfullscreen></iframe><br><br>
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                           <img src="images/icon-bankaccount.png" width="26" height="26">&nbsp;&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                           Thông tin chuyển khoản <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                          </h4>
                      </div>
                        <div id="collapse5" class="panel-collapse collapse">
                          <div class="panel-body">
                            Ngân hàng ACB PGD Nguyễn Chí Thanh – Tp. Hồ Chí Minh<br>
                            - Tên tài khoản: Hồ Lữ Thế<br>
                            - Số tài khoản: 137848289<br><br>
                            Ngân hàng Vietcombank PGD Phú Thọ – Tp. Hồ Chí Minh<br>
                            - Tên tài khoản: Hồ Lữ Thế<br>
                            - Số tài khoản: 0421000428095
                           </div>
                        </div>
                     </div> <!-- End panel group -->
                </div>
            </div><!-- End row -->
        </div>
        </div>
    </div> <!-- End contact -->
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