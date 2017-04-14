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
$query_rs_sortagency = "SELECT ID_agency, agencyname FROM agency ORDER BY agencyname ASC";
$rs_sortagency = mysql_query($query_rs_sortagency, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortagency = mysql_fetch_assoc($rs_sortagency);
$totalRows_rs_sortagency = mysql_num_rows($rs_sortagency);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT agencyname, ID_agency FROM agency ORDER BY agencyname";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

// Make an insert transaction instance
$ins_server = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_server);
// Register triggers
$ins_server->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_server->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_server->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_server->setTable("server");
$ins_server->addColumn("servername", "STRING_TYPE", "POST", "servername");
$ins_server->addColumn("ID_agency", "STRING_TYPE", "POST", "ID_agency");
$ins_server->addColumn("serverexpirydate", "DATE_TYPE", "POST", "serverexpirydate");
$ins_server->addColumn("serverip", "STRING_TYPE", "POST", "serverip");
$ins_server->addColumn("serveradminusername", "STRING_TYPE", "POST", "serveradminusername");
$ins_server->addColumn("serveradminpassword", "STRING_TYPE", "POST", "serveradminpassword");
$ins_server->setPrimaryKey("ID_server", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_server = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_server);
// Register triggers
$upd_server->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_server->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_server->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_server->setTable("server");
$upd_server->addColumn("servername", "STRING_TYPE", "POST", "servername");
$upd_server->addColumn("ID_agency", "STRING_TYPE", "POST", "ID_agency");
$upd_server->addColumn("serverexpirydate", "DATE_TYPE", "POST", "serverexpirydate");
$upd_server->addColumn("serverip", "STRING_TYPE", "POST", "serverip");
$upd_server->addColumn("serveradminusername", "STRING_TYPE", "POST", "serveradminusername");
$upd_server->addColumn("serveradminpassword", "STRING_TYPE", "POST", "serveradminpassword");
$upd_server->setPrimaryKey("ID_server", "NUMERIC_TYPE", "GET", "ID_server");

// Make an instance of the transaction object
$del_server = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_server);
// Register triggers
$del_server->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_server->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_server->setTable("server");
$del_server->setPrimaryKey("ID_server", "NUMERIC_TYPE", "GET", "ID_server");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsserver = $tNGs->getRecordset("server");
$row_rsserver = mysql_fetch_assoc($rsserver);
$totalRows_rsserver = mysql_num_rows($rsserver);
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
if (@$_GET['ID_server'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            SERVER / VPS DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsserver > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="servername_<?php echo $cnt1; ?>">Server Name:</label></td>
                    <td><input type="text" name="servername_<?php echo $cnt1; ?>" id="servername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsserver['servername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("servername");?> <?php echo $tNGs->displayFieldError("server", "servername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_agency_<?php echo $cnt1; ?>">Paid:</label></td>
                    <td><select name="ID_agency_<?php echo $cnt1; ?>" id="ID_agency_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortagency['ID_agency']?>"<?php if (!(strcmp($row_rs_sortagency['ID_agency'], $row_rsserver['ID_agency']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortagency['agencyname']?></option>
                      <?php
} while ($row_rs_sortagency = mysql_fetch_assoc($rs_sortagency));
  $rows = mysql_num_rows($rs_sortagency);
  if($rows > 0) {
      mysql_data_seek($rs_sortagency, 0);
	  $row_rs_sortagency = mysql_fetch_assoc($rs_sortagency);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("server", "ID_agency", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="serverexpirydate_<?php echo $cnt1; ?>">Expiry Date:</label></td>
                    <td><input name="serverexpirydate_<?php echo $cnt1; ?>" id="serverexpirydate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsserver['serverexpirydate']); ?>" size="10" maxlength="22" wdg:mondayfirst="true" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="false" wdg:restricttomask="no" wdg:readonly="true" />
                      <?php echo $tNGs->displayFieldHint("serverexpirydate");?> <?php echo $tNGs->displayFieldError("server", "serverexpirydate", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="serverip_<?php echo $cnt1; ?>">IP:</label></td>
                    <td><input type="text" name="serverip_<?php echo $cnt1; ?>" id="serverip_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsserver['serverip']); ?>" size="26" maxlength="26" />
                      <?php echo $tNGs->displayFieldHint("serverip");?> <?php echo $tNGs->displayFieldError("server", "serverip", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="serveradminusername_<?php echo $cnt1; ?>">Username:</label></td>
                    <td><input type="text" name="serveradminusername_<?php echo $cnt1; ?>" id="serveradminusername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsserver['serveradminusername']); ?>" size="48" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("serveradminusername");?> <?php echo $tNGs->displayFieldError("server", "serveradminusername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="serveradminpassword_<?php echo $cnt1; ?>">Password:</label></td>
                    <td><input type="text" name="serveradminpassword_<?php echo $cnt1; ?>" id="serveradminpassword_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsserver['serveradminpassword']); ?>" size="48" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("serveradminpassword");?> <?php echo $tNGs->displayFieldError("server", "serveradminpassword", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_server_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsserver['kt_pk_server']); ?>" />
                <?php } while ($row_rsserver = mysql_fetch_assoc($rsserver)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_server'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_server')" />
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
mysql_free_result($rs_sortagency);
mysql_free_result($Recordset1);
?>