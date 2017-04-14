<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');
?>
<?php
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

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("domainaccountorderlist");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

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
$query_rs_sortcustomer = "SELECT ID_customer, customerfullname FROM customer ORDER BY customerfullname ASC";
$rs_sortcustomer = mysql_query($query_rs_sortcustomer, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
$totalRows_rs_sortcustomer = mysql_num_rows($rs_sortcustomer);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortsupplier = "SELECT ID_supplier, suppliername FROM supplier ORDER BY suppliername ASC";
$rs_sortsupplier = mysql_query($query_rs_sortsupplier, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
$totalRows_rs_sortsupplier = mysql_num_rows($rs_sortsupplier);

// Make an insert transaction instance
$ins_domainaccount = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_domainaccount);
// Register triggers
$ins_domainaccount->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_domainaccount->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_domainaccount->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_domainaccount->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_domainaccount->setTable("domainaccount");
$ins_domainaccount->addColumn("ID_customer", "NUMERIC_TYPE", "POST", "ID_customer");
$ins_domainaccount->addColumn("domainusername", "STRING_TYPE", "POST", "domainusername");
$ins_domainaccount->addColumn("domainpassword", "STRING_TYPE", "POST", "domainpassword");
$ins_domainaccount->addColumn("ID_supplier", "NUMERIC_TYPE", "POST", "ID_supplier");
$ins_domainaccount->addColumn("domainlink", "STRING_TYPE", "POST", "domainlink");
$ins_domainaccount->addColumn("domainemailregistration", "STRING_TYPE", "POST", "domainemailregistration");
$ins_domainaccount->setPrimaryKey("ID_domainaccount", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_domainaccount = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_domainaccount);
// Register triggers
$upd_domainaccount->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_domainaccount->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_domainaccount->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_domainaccount->setTable("domainaccount");
$upd_domainaccount->addColumn("ID_customer", "NUMERIC_TYPE", "POST", "ID_customer");
$upd_domainaccount->addColumn("domainusername", "STRING_TYPE", "POST", "domainusername");
$upd_domainaccount->addColumn("domainpassword", "STRING_TYPE", "POST", "domainpassword");
$upd_domainaccount->addColumn("ID_supplier", "NUMERIC_TYPE", "POST", "ID_supplier");
$upd_domainaccount->addColumn("domainlink", "STRING_TYPE", "POST", "domainlink");
$upd_domainaccount->addColumn("domainemailregistration", "STRING_TYPE", "POST", "domainemailregistration");
$upd_domainaccount->setPrimaryKey("ID_domainaccount", "NUMERIC_TYPE", "GET", "ID_domainaccount");

// Make an instance of the transaction object
$del_domainaccount = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_domainaccount);
// Register triggers
$del_domainaccount->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_domainaccount->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_domainaccount->setTable("domainaccount");
$del_domainaccount->setPrimaryKey("ID_domainaccount", "NUMERIC_TYPE", "GET", "ID_domainaccount");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsdomainaccount = $tNGs->getRecordset("domainaccount");
$row_rsdomainaccount = mysql_fetch_assoc($rsdomainaccount);
$totalRows_rsdomainaccount = mysql_num_rows($rsdomainaccount);
?>
<!doctype html>
<html>
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
if (@$_GET['ID_domainaccount'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            DOMAIN ACCOUNT DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsdomainaccount > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="ID_customer_<?php echo $cnt1; ?>">Customer:</label></td>
                    <td><select name="ID_customer_<?php echo $cnt1; ?>" id="ID_customer_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortcustomer['ID_customer']?>"<?php if (!(strcmp($row_rs_sortcustomer['ID_customer'], $row_rsdomainaccount['ID_customer']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortcustomer['customerfullname']?></option>
                      <?php
} while ($row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer));
  $rows = mysql_num_rows($rs_sortcustomer);
  if($rows > 0) {
      mysql_data_seek($rs_sortcustomer, 0);
	  $row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("domainaccount", "ID_customer", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainusername_<?php echo $cnt1; ?>">Username:</label></td>
                    <td><input type="text" name="domainusername_<?php echo $cnt1; ?>" id="domainusername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsdomainaccount['domainusername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("domainusername");?> <?php echo $tNGs->displayFieldError("domainaccount", "domainusername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainpassword_<?php echo $cnt1; ?>">Password:</label></td>
                    <td><input type="text" name="domainpassword_<?php echo $cnt1; ?>" id="domainpassword_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsdomainaccount['domainpassword']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("domainpassword");?> <?php echo $tNGs->displayFieldError("domainaccount", "domainpassword", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_supplier_<?php echo $cnt1; ?>">Supplier:</label></td>
                    <td><select name="ID_supplier_<?php echo $cnt1; ?>" id="ID_supplier_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortsupplier['ID_supplier']?>"<?php if (!(strcmp($row_rs_sortsupplier['ID_supplier'], $row_rsdomainaccount['ID_supplier']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortsupplier['suppliername']?></option>
                      <?php
} while ($row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier));
  $rows = mysql_num_rows($rs_sortsupplier);
  if($rows > 0) {
      mysql_data_seek($rs_sortsupplier, 0);
	  $row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("domainaccount", "ID_supplier", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainlink_<?php echo $cnt1; ?>">Login Page:</label></td>
                    <td><input type="text" name="domainlink_<?php echo $cnt1; ?>" id="domainlink_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsdomainaccount['domainlink']); ?>" size="56" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("domainlink");?> <?php echo $tNGs->displayFieldError("domainaccount", "domainlink", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="domainemailregistration_<?php echo $cnt1; ?>">E-Registration:</label></td>
                    <td><input type="text" name="domainemailregistration_<?php echo $cnt1; ?>" id="domainemailregistration_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsdomainaccount['domainemailregistration']); ?>" size="48" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("domainemailregistration");?> <?php echo $tNGs->displayFieldError("domainaccount", "domainemailregistration", $cnt1); ?></td>
                  </tr>
                  
                </table>
                <input type="hidden" name="kt_pk_domainaccount_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsdomainaccount['kt_pk_domainaccount']); ?>" />
                <?php } while ($row_rsdomainaccount = mysql_fetch_assoc($rsdomainaccount)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_domainaccount'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'ID_domainaccount')" />
                    </div>
                    <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
                    <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
                    <?php }
      // endif Conditional region1
      ?>
                  <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
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
mysql_free_result($rs_sortcustomer);
mysql_free_result($rs_sortsupplier);
?>