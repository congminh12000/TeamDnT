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

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("projectorderlist");
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
$query_rs_sortcustomer = "SELECT ID_customer, customerfullname FROM customer WHERE customerstatus = 1 ORDER BY customerfullname ASC";
$rs_sortcustomer = mysql_query($query_rs_sortcustomer, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
$totalRows_rs_sortcustomer = mysql_num_rows($rs_sortcustomer);

// Make an insert transaction instance
$ins_project = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_project);
// Register triggers
$ins_project->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_project->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_project->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_project->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_project->setTable("project");
$ins_project->addColumn("projectname", "STRING_TYPE", "POST", "projectname");
$ins_project->addColumn("ID_customer", "NUMERIC_TYPE", "POST", "ID_customer");
$ins_project->addColumn("webdesign", "CHECKBOX_1_0_TYPE", "POST", "webdesign", "0");
$ins_project->addColumn("hosting", "CHECKBOX_1_0_TYPE", "POST", "hosting", "0");
$ins_project->addColumn("graphicdesign", "CHECKBOX_1_0_TYPE", "POST", "graphicdesign", "0");
$ins_project->addColumn("emailhosting", "CHECKBOX_1_0_TYPE", "POST", "emailhosting", "0");
$ins_project->addColumn("startdate", "DATE_TYPE", "POST", "startdate");
$ins_project->addColumn("enddate", "DATE_TYPE", "POST", "enddate");
$ins_project->setPrimaryKey("ID_project", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_project = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_project);
// Register triggers
$upd_project->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_project->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_project->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_project->setTable("project");
$upd_project->addColumn("projectname", "STRING_TYPE", "POST", "projectname");
$upd_project->addColumn("ID_customer", "NUMERIC_TYPE", "POST", "ID_customer");
$upd_project->addColumn("webdesign", "CHECKBOX_1_0_TYPE", "POST", "webdesign");
$upd_project->addColumn("hosting", "CHECKBOX_1_0_TYPE", "POST", "hosting");
$upd_project->addColumn("graphicdesign", "CHECKBOX_1_0_TYPE", "POST", "graphicdesign");
$upd_project->addColumn("emailhosting", "CHECKBOX_1_0_TYPE", "POST", "emailhosting");
$upd_project->addColumn("startdate", "DATE_TYPE", "POST", "startdate");
$upd_project->addColumn("enddate", "DATE_TYPE", "POST", "enddate");
$upd_project->setPrimaryKey("ID_project", "NUMERIC_TYPE", "GET", "ID_project");

// Make an instance of the transaction object
$del_project = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_project);
// Register triggers
$del_project->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_project->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_project->setTable("project");
$del_project->setPrimaryKey("ID_project", "NUMERIC_TYPE", "GET", "ID_project");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsproject = $tNGs->getRecordset("project");
$row_rsproject = mysql_fetch_assoc($rsproject);
$totalRows_rsproject = mysql_num_rows($rsproject);
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
if (@$_GET['ID_project'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            PROJECT DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsproject > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="projectname_<?php echo $cnt1; ?>">Project Name:</label></td>
                    <td><input type="text" name="projectname_<?php echo $cnt1; ?>" id="projectname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsproject['projectname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("projectname");?> <?php echo $tNGs->displayFieldError("project", "projectname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_customer_<?php echo $cnt1; ?>">Customer:</label></td>
                    <td><select name="ID_customer_<?php echo $cnt1; ?>" id="ID_customer_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortcustomer['ID_customer']?>"<?php if (!(strcmp($row_rs_sortcustomer['ID_customer'], $row_rsproject['ID_customer']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortcustomer['customerfullname']?></option>
                      <?php
} while ($row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer));
  $rows = mysql_num_rows($rs_sortcustomer);
  if($rows > 0) {
      mysql_data_seek($rs_sortcustomer, 0);
	  $row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("project", "ID_customer", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="webdesign_<?php echo $cnt1; ?>">Web Design:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproject['webdesign']),"1"))) {echo "checked";} ?> type="checkbox" name="webdesign_<?php echo $cnt1; ?>" id="webdesign_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("project", "webdesign", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="hosting_<?php echo $cnt1; ?>">Hosting:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproject['hosting']),"1"))) {echo "checked";} ?> type="checkbox" name="hosting_<?php echo $cnt1; ?>" id="hosting_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("project", "hosting", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="graphicdesign_<?php echo $cnt1; ?>">Graphic Design:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproject['graphicdesign']),"1"))) {echo "checked";} ?> type="checkbox" name="graphicdesign_<?php echo $cnt1; ?>" id="graphicdesign_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("project", "graphicdesign", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="emailhosting_<?php echo $cnt1; ?>">Email Hosting:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsproject['emailhosting']),"1"))) {echo "checked";} ?> type="checkbox" name="emailhosting_<?php echo $cnt1; ?>" id="emailhosting_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("project", "emailhosting", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="startdate_<?php echo $cnt1; ?>">Start:</label></td>
                    <td><input name="startdate_<?php echo $cnt1; ?>" id="startdate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsproject['startdate']); ?>" size="10" maxlength="22" wdg:mondayfirst="true" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="false" wdg:restricttomask="no" wdg:readonly="true" />
                      <?php echo $tNGs->displayFieldHint("startdate");?> <?php echo $tNGs->displayFieldError("project", "startdate", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="enddate_<?php echo $cnt1; ?>">End:</label></td>
                    <td><input name="enddate_<?php echo $cnt1; ?>" id="enddate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsproject['enddate']); ?>" size="10" maxlength="22" wdg:mondayfirst="true" wdg:subtype="Calendar" wdg:mask="<?php echo $KT_screen_date_format; ?>" wdg:type="widget" wdg:singleclick="false" wdg:restricttomask="no" wdg:readonly="true" />
                      <?php echo $tNGs->displayFieldHint("enddate");?> <?php echo $tNGs->displayFieldError("project", "enddate", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_project_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsproject['kt_pk_project']); ?>" />
                <?php } while ($row_rsproject = mysql_fetch_assoc($rsproject)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_project'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_project')" />
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
mysql_free_result($rs_sortcustomer);
?>