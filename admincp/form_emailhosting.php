<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
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
$query_rs_sortproject = "SELECT ID_project, projectname, emailhosting FROM project WHERE emailhosting = 1 ORDER BY projectname ASC";
$rs_sortproject = mysql_query($query_rs_sortproject, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
$totalRows_rs_sortproject = mysql_num_rows($rs_sortproject);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortservice = "SELECT ID_services, servicename, servicecode FROM services ORDER BY servicename ASC";
$rs_sortservice = mysql_query($query_rs_sortservice, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
$totalRows_rs_sortservice = mysql_num_rows($rs_sortservice);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortserver = "SELECT ID_server, servername FROM server ORDER BY servername ASC";
$rs_sortserver = mysql_query($query_rs_sortserver, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
$totalRows_rs_sortserver = mysql_num_rows($rs_sortserver);

// Make an insert transaction instance
$ins_emailhosting = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_emailhosting);
// Register triggers
$ins_emailhosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_emailhosting->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_emailhosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_emailhosting->setTable("emailhosting");
$ins_emailhosting->addColumn("ID_project", "NUMERIC_TYPE", "POST", "ID_project");
$ins_emailhosting->addColumn("ID_services", "NUMERIC_TYPE", "POST", "ID_services");
$ins_emailhosting->addColumn("ID_server", "NUMERIC_TYPE", "POST", "ID_server");
$ins_emailhosting->addColumn("emailhostingcount", "NUMERIC_TYPE", "POST", "emailhostingcount");
$ins_emailhosting->addColumn("emailhostingexpirydate", "DATE_TYPE", "POST", "emailhostingexpirydate");
$ins_emailhosting->addColumn("emailusernameroot", "STRING_TYPE", "POST", "emailusernameroot");
$ins_emailhosting->addColumn("emailpasswordroot", "STRING_TYPE", "POST", "emailpasswordroot");
$ins_emailhosting->setPrimaryKey("ID_emailhosting", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_emailhosting = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_emailhosting);
// Register triggers
$upd_emailhosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_emailhosting->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_emailhosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_emailhosting->setTable("emailhosting");
$upd_emailhosting->addColumn("ID_project", "NUMERIC_TYPE", "POST", "ID_project");
$upd_emailhosting->addColumn("ID_services", "NUMERIC_TYPE", "POST", "ID_services");
$upd_emailhosting->addColumn("ID_server", "NUMERIC_TYPE", "POST", "ID_server");
$upd_emailhosting->addColumn("emailhostingcount", "NUMERIC_TYPE", "POST", "emailhostingcount");
$upd_emailhosting->addColumn("emailhostingexpirydate", "DATE_TYPE", "POST", "emailhostingexpirydate");
$upd_emailhosting->addColumn("emailusernameroot", "STRING_TYPE", "POST", "emailusernameroot");
$upd_emailhosting->addColumn("emailpasswordroot", "STRING_TYPE", "POST", "emailpasswordroot");
$upd_emailhosting->setPrimaryKey("ID_emailhosting", "NUMERIC_TYPE", "GET", "ID_emailhosting");

// Make an instance of the transaction object
$del_emailhosting = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_emailhosting);
// Register triggers
$del_emailhosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_emailhosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_emailhosting->setTable("emailhosting");
$del_emailhosting->setPrimaryKey("ID_emailhosting", "NUMERIC_TYPE", "GET", "ID_emailhosting");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsemailhosting = $tNGs->getRecordset("emailhosting");
$row_rsemailhosting = mysql_fetch_assoc($rsemailhosting);
$totalRows_rsemailhosting = mysql_num_rows($rsemailhosting);
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
if (@$_GET['ID_emailhosting'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            EMAIL HOSTING DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsemailhosting > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="ID_project_<?php echo $cnt1; ?>">Project:</label></td>
                    <td><select name="ID_project_<?php echo $cnt1; ?>" id="ID_project_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortproject['ID_project']?>"<?php if (!(strcmp($row_rs_sortproject['ID_project'], $row_rsemailhosting['ID_project']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortproject['projectname']?></option>
                      <?php
} while ($row_rs_sortproject = mysql_fetch_assoc($rs_sortproject));
  $rows = mysql_num_rows($rs_sortproject);
  if($rows > 0) {
      mysql_data_seek($rs_sortproject, 0);
	  $row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("emailhosting", "ID_project", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_services_<?php echo $cnt1; ?>">Service:</label></td>
                    <td><select name="ID_services_<?php echo $cnt1; ?>" id="ID_services_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortservice['ID_services']?>"<?php if (!(strcmp($row_rs_sortservice['ID_services'], $row_rsemailhosting['ID_services']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortservice['servicecode']?></option>
                      <?php
} while ($row_rs_sortservice = mysql_fetch_assoc($rs_sortservice));
  $rows = mysql_num_rows($rs_sortservice);
  if($rows > 0) {
      mysql_data_seek($rs_sortservice, 0);
	  $row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("emailhosting", "ID_services", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_server_<?php echo $cnt1; ?>">Server:</label></td>
                    <td><select name="ID_server_<?php echo $cnt1; ?>" id="ID_server_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortserver['ID_server']?>"<?php if (!(strcmp($row_rs_sortserver['ID_server'], $row_rsemailhosting['ID_server']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortserver['servername']?></option>
                      <?php
} while ($row_rs_sortserver = mysql_fetch_assoc($rs_sortserver));
  $rows = mysql_num_rows($rs_sortserver);
  if($rows > 0) {
      mysql_data_seek($rs_sortserver, 0);
	  $row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("emailhosting", "ID_server", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="emailhostingcount_<?php echo $cnt1; ?>">Amount:</label></td>
                    <td><input type="text" name="emailhostingcount_<?php echo $cnt1; ?>" id="emailhostingcount_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsemailhosting['emailhostingcount']); ?>" size="8" />
                      <?php echo $tNGs->displayFieldHint("emailhostingcount");?> <?php echo $tNGs->displayFieldError("emailhosting", "emailhostingcount", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="emailhostingexpirydate_<?php echo $cnt1; ?>">Expiry Date:</label></td>
                    <td><input type="text" name="emailhostingexpirydate_<?php echo $cnt1; ?>" id="emailhostingexpirydate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsemailhosting['emailhostingexpirydate']); ?>" size="10" maxlength="22" />
                      <?php echo $tNGs->displayFieldHint("emailhostingexpirydate");?> <?php echo $tNGs->displayFieldError("emailhosting", "emailhostingexpirydate", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="emailusernameroot_<?php echo $cnt1; ?>">Root Username:</label></td>
                    <td><input type="text" name="emailusernameroot_<?php echo $cnt1; ?>" id="emailusernameroot_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsemailhosting['emailusernameroot']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("emailusernameroot");?> <?php echo $tNGs->displayFieldError("emailhosting", "emailusernameroot", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="emailpasswordroot_<?php echo $cnt1; ?>">Root Password:</label></td>
                    <td><input type="text" name="emailpasswordroot_<?php echo $cnt1; ?>" id="emailpasswordroot_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsemailhosting['emailpasswordroot']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("emailpasswordroot");?> <?php echo $tNGs->displayFieldError("emailhosting", "emailpasswordroot", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_emailhosting_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsemailhosting['kt_pk_emailhosting']); ?>" />
                <?php } while ($row_rsemailhosting = mysql_fetch_assoc($rsemailhosting)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_emailhosting'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_emailhosting')" />
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
        <p>&nbsp;</p>
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
mysql_free_result($rs_sortproject);
mysql_free_result($rs_sortservice);
mysql_free_result($rs_sortserver);
?>