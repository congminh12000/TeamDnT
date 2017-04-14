<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

// Load the common classes
require_once('../includes/common/KT_common.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_cnn_teamdnt = new KT_connection($cnn_teamdnt, $database_cnn_teamdnt);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_cnn_teamdnt, "../");
//Grand Levels: Level
$restrict->addLevel("2");
$restrict->Execute();
//End Restrict Access To Page

// Start trigger
$formValidation = new tNG_FormValidation();
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
$query_rs_sortdomainaccount = "SELECT ID_domainaccount, domainusername FROM domainaccount ORDER BY domainusername ASC";
$rs_sortdomainaccount = mysql_query($query_rs_sortdomainaccount, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortdomainaccount = mysql_fetch_assoc($rs_sortdomainaccount);
$totalRows_rs_sortdomainaccount = mysql_num_rows($rs_sortdomainaccount);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortsupplier = "SELECT ID_supplier, suppliername FROM supplier ORDER BY suppliername ASC";
$rs_sortsupplier = mysql_query($query_rs_sortsupplier, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
$totalRows_rs_sortsupplier = mysql_num_rows($rs_sortsupplier);

// Make an insert transaction instance
$ins__domain_ = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins__domain_);
// Register triggers
$ins__domain_->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins__domain_->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins__domain_->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins__domain_->setTable("`domain`");
$ins__domain_->addColumn("domainname", "STRING_TYPE", "POST", "domainname");
$ins__domain_->addColumn("ID_domainaccount", "NUMERIC_TYPE", "POST", "ID_domainaccount");
$ins__domain_->addColumn("ID_supplier", "NUMERIC_TYPE", "POST", "ID_supplier");
$ins__domain_->addColumn("domainexpirydate", "DATE_TYPE", "POST", "domainexpirydate");
$ins__domain_->addColumn("domainlocation", "NUMERIC_TYPE", "POST", "domainlocation");
$ins__domain_->setPrimaryKey("ID_domain", "NUMERIC_TYPE");

// Make an update transaction instance
$upd__domain_ = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd__domain_);
// Register triggers
$upd__domain_->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd__domain_->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd__domain_->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd__domain_->setTable("`domain`");
$upd__domain_->addColumn("domainname", "STRING_TYPE", "POST", "domainname");
$upd__domain_->addColumn("ID_domainaccount", "NUMERIC_TYPE", "POST", "ID_domainaccount");
$upd__domain_->addColumn("ID_supplier", "NUMERIC_TYPE", "POST", "ID_supplier");
$upd__domain_->addColumn("domainexpirydate", "DATE_TYPE", "POST", "domainexpirydate");
$upd__domain_->addColumn("domainlocation", "NUMERIC_TYPE", "POST", "domainlocation");
$upd__domain_->setPrimaryKey("ID_domain", "NUMERIC_TYPE", "GET", "ID_domain");

// Make an instance of the transaction object
$del__domain_ = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del__domain_);
// Register triggers
$del__domain_->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del__domain_->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del__domain_->setTable("`domain`");
$del__domain_->setPrimaryKey("ID_domain", "NUMERIC_TYPE", "GET", "ID_domain");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rs_domain_ = $tNGs->getRecordset("`domain`");
$row_rs_domain_ = mysql_fetch_assoc($rs_domain_);
$totalRows_rs_domain_ = mysql_num_rows($rs_domain_);
?>
<!doctype html>
<html xmlns:wdg="http://ns.adobe.com/addt">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width">
<title>TeamDnT - WebDesign : Admin Control Panel</title>
<script type="text/javascript" src="p7ehc/p7EHCscripts.js"></script>
<link href="p7csspbm2/p7csspbm2_12.css" rel="stylesheet" type="text/css">
<link href="p7csspbm2/p7csspbm2_print.css" rel="stylesheet" type="text/css" media="print">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome.css">
<link rel="stylesheet" href="../css/boostrap.css">
<link rel="stylesheet" href="../js/boostrap.js">
<link rel="shortcut icon" href="../images/favicon-teamdnt.ico">
<!--[if lte IE 7]>
<style>
.menutop li {display: inline;}
div, .menuside a {zoom: 1;}
.masthead .banner, .masthead .banner img {width: 100%;}
.sidebar2 {width: 19%;}
</style>
<![endif]-->
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<script src="../includes/nxt/scripts/form.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/form.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
<script type="text/javascript" src="../includes/common/js/sigslot_core.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/MXWidgets.js.php"></script>
<script type="text/javascript" src="../includes/wdg/classes/Calendar.js"></script>
<script type="text/javascript" src="../includes/wdg/classes/SmartDate.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar_stripped.js"></script>
<script type="text/javascript" src="../includes/wdg/calendar/calendar-setup_stripped.js"></script>
<script src="../includes/resources/calendar.js"></script>
</head>

<body>
<div class="content-wrapper">
    <div class="masthead">
    <?php
		mxi_includes_start("admincp_header.php");
		require(basename("admincp_header.php"));
		mxi_includes_end();
	?>
  </div>
  <div class="columns-wrapper">
  <div class="sidebar">
      <div class="content p7ehc-1">
        <?php
			  mxi_includes_start("admincp_menu.php");
			  require(basename("admincp_menu.php"));
			  mxi_includes_end();
		?>
      </div>
    </div>
    <div class="main-content">
      <div class="content p7ehc-1">
        <div class="KT_tng">
          <h1>
            <?php 
// Show IF Conditional region1 
if (@$_GET['ID_domain'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            DOMAIN DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rs_domain_ > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="domainname_<?php echo $cnt1; ?>">Domain:</label></td>
                    <td><input type="text" name="domainname_<?php echo $cnt1; ?>" id="domainname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rs_domain_['domainname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("domainname");?> <?php echo $tNGs->displayFieldError("`domain`", "domainname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_domainaccount_<?php echo $cnt1; ?>">Account:</label></td>
                    <td><select name="ID_domainaccount_<?php echo $cnt1; ?>" id="ID_domainaccount_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortdomainaccount['ID_domainaccount']?>"<?php if (!(strcmp($row_rs_sortdomainaccount['ID_domainaccount'], $row_rs_domain_['ID_domainaccount']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortdomainaccount['domainusername']?></option>
                      <?php
} while ($row_rs_sortdomainaccount = mysql_fetch_assoc($rs_sortdomainaccount));
  $rows = mysql_num_rows($rs_sortdomainaccount);
  if($rows > 0) {
      mysql_data_seek($rs_sortdomainaccount, 0);
	  $row_rs_sortdomainaccount = mysql_fetch_assoc($rs_sortdomainaccount);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("`domain`", "ID_domainaccount", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_supplier_<?php echo $cnt1; ?>">Supplier:</label></td>
                    <td><select name="ID_supplier_<?php echo $cnt1; ?>" id="ID_supplier_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortsupplier['ID_supplier']?>"<?php if (!(strcmp($row_rs_sortsupplier['ID_supplier'], $row_rs_domain_['ID_supplier']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortsupplier['suppliername']?></option>
                      <?php
} while ($row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier));
  $rows = mysql_num_rows($rs_sortsupplier);
  if($rows > 0) {
      mysql_data_seek($rs_sortsupplier, 0);
	  $row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("`domain`", "ID_supplier", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainexpirydate_<?php echo $cnt1; ?>">Expiry Date:</label></td>
                    <td><input name="domainexpirydate_<?php echo $cnt1; ?>" id="domainexpirydate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rs_domain_['domainexpirydate']); ?>" size="10" maxlength="22" wdg:mondayfirst="true" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="false" wdg:restricttomask="no" wdg:readonly="true" />
                      <?php echo $tNGs->displayFieldHint("domainexpirydate");?> <?php echo $tNGs->displayFieldError("`domain`", "domainexpirydate", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainlocation_<?php echo $cnt1; ?>">Registered Location:</label></td>
                    <td><select name="domainlocation_<?php echo $cnt1; ?>" id="domainlocation_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rs_domain_['domainlocation'])))) {echo "SELECTED";} ?>>Vietnam</option>
                      <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rs_domain_['domainlocation'])))) {echo "SELECTED";} ?>>America</option>
                      <option value="3" <?php if (!(strcmp(4, KT_escapeAttribute($row_rs_domain_['domainlocation'])))) {echo "SELECTED";} ?>>Australia</option>
                      <option value="4" <?php if (!(strcmp(4, KT_escapeAttribute($row_rs_domain_['domainlocation'])))) {echo "SELECTED";} ?>>England</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("`domain`", "domainlocation", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk__domain__<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rs_domain_['kt_pk__domain_']); ?>" />
                <?php } while ($row_rs_domain_ = mysql_fetch_assoc($rs_domain_)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_domain'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_domain')" />
                    </div>
                    <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
                    <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onClick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
                    <?php }
      // endif Conditional region1
      ?>
<input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onClick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
                </div>
              </div>
            </form>
          </div>
          <br class="clearfixplain" />
        </div>
      </div>
    </div>
</div>
   <?php
		mxi_includes_start("admincp_footer.php");
		require(basename("admincp_footer.php"));
		mxi_includes_end();
	?>
</div>
</body>
</html>
<?php
mysql_free_result($rs_sortdomainaccount);
mysql_free_result($rs_sortsupplier);
?>