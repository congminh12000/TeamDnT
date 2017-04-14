<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
//MX Widgets3 include
require_once('../includes/wdg/WDG.php');

// Load the common classes
require_once('../includes/common/KT_common.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the KT_back class
require_once('../includes/nxt/KT_back.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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
$query_rs_sortproject = "SELECT ID_project, projectname FROM project ORDER BY projectname ASC";
$rs_sortproject = mysql_query($query_rs_sortproject, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
$totalRows_rs_sortproject = mysql_num_rows($rs_sortproject);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortserver = "SELECT ID_server, servername, ID_agency FROM server ORDER BY servername ASC";
$rs_sortserver = mysql_query($query_rs_sortserver, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
$totalRows_rs_sortserver = mysql_num_rows($rs_sortserver);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortservice = "SELECT ID_services, servicename, servicecode FROM services ORDER BY servicecode ASC";
$rs_sortservice = mysql_query($query_rs_sortservice, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
$totalRows_rs_sortservice = mysql_num_rows($rs_sortservice);

// Make an insert transaction instance
$ins_hosting = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_hosting);
// Register triggers
$ins_hosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_hosting->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_hosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_hosting->setTable("hosting");
$ins_hosting->addColumn("ID_project", "NUMERIC_TYPE", "POST", "ID_project");
$ins_hosting->addColumn("ID_server", "NUMERIC_TYPE", "POST", "ID_server");
$ins_hosting->addColumn("datastorage", "NUMERIC_TYPE", "POST", "datastorage");
$ins_hosting->addColumn("ID_services", "NUMERIC_TYPE", "POST", "ID_services");
$ins_hosting->addColumn("hostingip", "STRING_TYPE", "POST", "hostingip");
$ins_hosting->addColumn("hostingport", "STRING_TYPE", "POST", "hostingport");
$ins_hosting->addColumn("maindomain", "STRING_TYPE", "POST", "maindomain");
$ins_hosting->addColumn("aliasdomain", "STRING_TYPE", "POST", "aliasdomain");
$ins_hosting->addColumn("ftpusername", "STRING_TYPE", "POST", "ftpusername");
$ins_hosting->addColumn("ftppassword", "STRING_TYPE", "POST", "ftppassword");
$ins_hosting->addColumn("phpmyadmindatabase", "STRING_TYPE", "POST", "phpmyadmindatabase");
$ins_hosting->addColumn("phpmyadminusername", "STRING_TYPE", "POST", "phpmyadminusername");
$ins_hosting->addColumn("phpmyadminpassword", "STRING_TYPE", "POST", "phpmyadminpassword");
$ins_hosting->addColumn("phpmyadminlink", "STRING_TYPE", "POST", "phpmyadminlink");
$ins_hosting->addColumn("webmasterusername", "STRING_TYPE", "POST", "webmasterusername");
$ins_hosting->addColumn("webmasterpassword", "STRING_TYPE", "POST", "webmasterpassword");
$ins_hosting->addColumn("webmasterlink", "STRING_TYPE", "POST", "webmasterlink");
$ins_hosting->addColumn("hostingexpirydate", "DATE_TYPE", "POST", "hostingexpirydate");
$ins_hosting->setPrimaryKey("ID_hosting", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_hosting = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_hosting);
// Register triggers
$upd_hosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_hosting->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_hosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_hosting->setTable("hosting");
$upd_hosting->addColumn("ID_project", "NUMERIC_TYPE", "POST", "ID_project");
$upd_hosting->addColumn("ID_server", "NUMERIC_TYPE", "POST", "ID_server");
$upd_hosting->addColumn("datastorage", "NUMERIC_TYPE", "POST", "datastorage");
$upd_hosting->addColumn("ID_services", "NUMERIC_TYPE", "POST", "ID_services");
$upd_hosting->addColumn("hostingip", "STRING_TYPE", "POST", "hostingip");
$upd_hosting->addColumn("hostingport", "STRING_TYPE", "POST", "hostingport");
$upd_hosting->addColumn("maindomain", "STRING_TYPE", "POST", "maindomain");
$upd_hosting->addColumn("aliasdomain", "STRING_TYPE", "POST", "aliasdomain");
$upd_hosting->addColumn("ftpusername", "STRING_TYPE", "POST", "ftpusername");
$upd_hosting->addColumn("ftppassword", "STRING_TYPE", "POST", "ftppassword");
$upd_hosting->addColumn("phpmyadmindatabase", "STRING_TYPE", "POST", "phpmyadmindatabase");
$upd_hosting->addColumn("phpmyadminusername", "STRING_TYPE", "POST", "phpmyadminusername");
$upd_hosting->addColumn("phpmyadminpassword", "STRING_TYPE", "POST", "phpmyadminpassword");
$upd_hosting->addColumn("phpmyadminlink", "STRING_TYPE", "POST", "phpmyadminlink");
$upd_hosting->addColumn("webmasterusername", "STRING_TYPE", "POST", "webmasterusername");
$upd_hosting->addColumn("webmasterpassword", "STRING_TYPE", "POST", "webmasterpassword");
$upd_hosting->addColumn("webmasterlink", "STRING_TYPE", "POST", "webmasterlink");
$upd_hosting->addColumn("hostingexpirydate", "DATE_TYPE", "POST", "hostingexpirydate");
$upd_hosting->setPrimaryKey("ID_hosting", "NUMERIC_TYPE", "GET", "ID_hosting");

// Make an instance of the transaction object
$del_hosting = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_hosting);
// Register triggers
$del_hosting->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_hosting->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_hosting->setTable("hosting");
$del_hosting->setPrimaryKey("ID_hosting", "NUMERIC_TYPE", "GET", "ID_hosting");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rshosting = $tNGs->getRecordset("hosting");
$row_rshosting = mysql_fetch_assoc($rshosting);
$totalRows_rshosting = mysql_num_rows($rshosting);
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
if (@$_GET['ID_hosting'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            HOSTING DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rshosting > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td width="25%" class="KT_th"><label for="ID_project_<?php echo $cnt1; ?>">Project:</label></td>
                    <td colspan="2"><select name="ID_project_<?php echo $cnt1; ?>" id="ID_project_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortproject['ID_project']?>"<?php if (!(strcmp($row_rs_sortproject['ID_project'], $row_rshosting['ID_project']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortproject['projectname']?></option>
                      <?php
} while ($row_rs_sortproject = mysql_fetch_assoc($rs_sortproject));
  $rows = mysql_num_rows($rs_sortproject);
  if($rows > 0) {
      mysql_data_seek($rs_sortproject, 0);
	  $row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("hosting", "ID_project", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_server_<?php echo $cnt1; ?>">Server:</label></td>
                    <td width="23%"><select name="ID_server_<?php echo $cnt1; ?>" id="ID_server_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortserver['ID_server']?>"<?php if (!(strcmp($row_rs_sortserver['ID_server'], $row_rshosting['ID_server']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortserver['servername']?></option>
                      <?php
} while ($row_rs_sortserver = mysql_fetch_assoc($rs_sortserver));
  $rows = mysql_num_rows($rs_sortserver);
  if($rows > 0) {
      mysql_data_seek($rs_sortserver, 0);
	  $row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("hosting", "ID_server", $cnt1); ?></td>
                    <td width="52%"><b>Storage:</b>&nbsp;&nbsp;<input type="text" name="datastorage_<?php echo $cnt1; ?>" id="datastorage_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['datastorage']); ?>" size="10" />
                      <?php echo $tNGs->displayFieldHint("datastorage");?> <?php echo $tNGs->displayFieldError("hosting", "datastorage", $cnt1); ?>&nbsp;Mb</td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_services_<?php echo $cnt1; ?>">Service:</label></td>
                    <td colspan="2"><select name="ID_services_<?php echo $cnt1; ?>" id="ID_services_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortservice['ID_services']?>"<?php if (!(strcmp($row_rs_sortservice['ID_services'], $row_rshosting['ID_services']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortservice['servicecode']?></option>
                      <?php
} while ($row_rs_sortservice = mysql_fetch_assoc($rs_sortservice));
  $rows = mysql_num_rows($rs_sortservice);
  if($rows > 0) {
      mysql_data_seek($rs_sortservice, 0);
	  $row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("hosting", "ID_services", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="hostingip_<?php echo $cnt1; ?>">IP:</label></td>
                    <td><input type="text" name="hostingip_<?php echo $cnt1; ?>" id="hostingip_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['hostingip']); ?>" size="26" maxlength="26" />
                      <?php echo $tNGs->displayFieldHint("hostingip");?> <?php echo $tNGs->displayFieldError("hosting", "hostingip", $cnt1); ?></td>
                    <td><b>Port:</b>&nbsp;&nbsp;<input type="text" name="hostingport_<?php echo $cnt1; ?>" id="hostingport_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['hostingport']); ?>" size="10" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("hostingport");?> <?php echo $tNGs->displayFieldError("hosting", "hostingport", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="maindomain_<?php echo $cnt1; ?>">Main Domain:</label></td>
                    <td colspan="2"><input type="text" name="maindomain_<?php echo $cnt1; ?>" id="maindomain_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['maindomain']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("maindomain");?> <?php echo $tNGs->displayFieldError("hosting", "maindomain", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="aliasdomain_<?php echo $cnt1; ?>">Alias Domain:</label></td>
                    <td colspan="2"><textarea name="aliasdomain_<?php echo $cnt1; ?>" id="aliasdomain_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rshosting['aliasdomain']); ?></textarea>
                      <?php echo $tNGs->displayFieldHint("aliasdomain");?> <?php echo $tNGs->displayFieldError("hosting", "aliasdomain", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ftpusername_<?php echo $cnt1; ?>">FTP Username:</label></td>
                    <td colspan="2"><input type="text" name="ftpusername_<?php echo $cnt1; ?>" id="ftpusername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['ftpusername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("ftpusername");?> <?php echo $tNGs->displayFieldError("hosting", "ftpusername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ftppassword_<?php echo $cnt1; ?>">FTP Password:</label></td>
                    <td colspan="2"><input type="text" name="ftppassword_<?php echo $cnt1; ?>" id="ftppassword_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['ftppassword']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("ftppassword");?> <?php echo $tNGs->displayFieldError("hosting", "ftppassword", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="phpmyadmindatabase_<?php echo $cnt1; ?>">PHPMyAdmin Database:</label></td>
                    <td colspan="2"><input type="text" name="phpmyadmindatabase_<?php echo $cnt1; ?>" id="phpmyadmindatabase_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['phpmyadmindatabase']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("phpmyadmindatabase");?> <?php echo $tNGs->displayFieldError("hosting", "phpmyadmindatabase", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="phpmyadminusername_<?php echo $cnt1; ?>">PHPMyAdmin Username:</label></td>
                    <td colspan="2"><input type="text" name="phpmyadminusername_<?php echo $cnt1; ?>" id="phpmyadminusername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['phpmyadminusername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("phpmyadminusername");?> <?php echo $tNGs->displayFieldError("hosting", "phpmyadminusername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="phpmyadminpassword_<?php echo $cnt1; ?>">PHPMyAdmin Password:</label></td>
                    <td colspan="2"><input type="text" name="phpmyadminpassword_<?php echo $cnt1; ?>" id="phpmyadminpassword_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['phpmyadminpassword']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("phpmyadminpassword");?> <?php echo $tNGs->displayFieldError("hosting", "phpmyadminpassword", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="phpmyadminlink_<?php echo $cnt1; ?>">PHPMyAdmin Link:</label></td>
                    <td colspan="2"><input type="text" name="phpmyadminlink_<?php echo $cnt1; ?>" id="phpmyadminlink_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['phpmyadminlink']); ?>" size="48" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("phpmyadminlink");?> <?php echo $tNGs->displayFieldError("hosting", "phpmyadminlink", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="webmasterusername_<?php echo $cnt1; ?>">Admin Username:</label></td>
                    <td colspan="2"><input type="text" name="webmasterusername_<?php echo $cnt1; ?>" id="webmasterusername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['webmasterusername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("webmasterusername");?> <?php echo $tNGs->displayFieldError("hosting", "webmasterusername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="webmasterpassword_<?php echo $cnt1; ?>">Admin Password:</label></td>
                    <td colspan="2"><input type="text" name="webmasterpassword_<?php echo $cnt1; ?>" id="webmasterpassword_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['webmasterpassword']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("webmasterpassword");?> <?php echo $tNGs->displayFieldError("hosting", "webmasterpassword", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="webmasterlink_<?php echo $cnt1; ?>">Admin Website Link:</label></td>
                    <td colspan="2"><input type="text" name="webmasterlink_<?php echo $cnt1; ?>" id="webmasterlink_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rshosting['webmasterlink']); ?>" size="48" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("webmasterlink");?> <?php echo $tNGs->displayFieldError("hosting", "webmasterlink", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="hostingexpirydate_<?php echo $cnt1; ?>">Expiry Date:</label></td>
                    <td colspan="2"><input name="hostingexpirydate_<?php echo $cnt1; ?>" id="hostingexpirydate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rshosting['hostingexpirydate']); ?>" size="10" maxlength="22" wdg:mondayfirst="true" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="false" wdg:restricttomask="no" wdg:readonly="true" />
                      <?php echo $tNGs->displayFieldHint("hostingexpirydate");?> <?php echo $tNGs->displayFieldError("hosting", "hostingexpirydate", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_hosting_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rshosting['kt_pk_hosting']); ?>" />
                <?php } while ($row_rshosting = mysql_fetch_assoc($rshosting)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_hosting'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_hosting')" />
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
mysql_free_result($rs_sortproject);
mysql_free_result($rs_sortserver);
mysql_free_result($rs_sortservice);
?>