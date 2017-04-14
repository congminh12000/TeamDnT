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

// Make an insert transaction instance
$ins_services = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_services);
// Register triggers
$ins_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_services->setTable("services");
$ins_services->addColumn("servicecode", "STRING_TYPE", "POST", "servicecode");
$ins_services->addColumn("servicename", "STRING_TYPE", "POST", "servicename");
$ins_services->addColumn("servicepublicprice", "NUMERIC_TYPE", "POST", "servicepublicprice");
$ins_services->addColumn("servicenotes", "STRING_TYPE", "POST", "servicenotes");
$ins_services->setPrimaryKey("ID_services", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_services = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_services);
// Register triggers
$upd_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_services->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_services->setTable("services");
$upd_services->addColumn("servicecode", "STRING_TYPE", "POST", "servicecode");
$upd_services->addColumn("servicename", "STRING_TYPE", "POST", "servicename");
$upd_services->addColumn("servicepublicprice", "NUMERIC_TYPE", "POST", "servicepublicprice");
$upd_services->addColumn("servicenotes", "STRING_TYPE", "POST", "servicenotes");
$upd_services->setPrimaryKey("ID_services", "NUMERIC_TYPE", "GET", "ID_services");

// Make an instance of the transaction object
$del_services = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_services);
// Register triggers
$del_services->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_services->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_services->setTable("services");
$del_services->setPrimaryKey("ID_services", "NUMERIC_TYPE", "GET", "ID_services");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsservices = $tNGs->getRecordset("services");
$row_rsservices = mysql_fetch_assoc($rsservices);
$totalRows_rsservices = mysql_num_rows($rsservices);
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
if (@$_GET['ID_services'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            SERVICE DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsservices > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="servicecode_<?php echo $cnt1; ?>">Code:</label></td>
                    <td><input type="text" name="servicecode_<?php echo $cnt1; ?>" id="servicecode_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['servicecode']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("servicecode");?> <?php echo $tNGs->displayFieldError("services", "servicecode", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="servicename_<?php echo $cnt1; ?>">Service:</label></td>
                    <td><input type="text" name="servicename_<?php echo $cnt1; ?>" id="servicename_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['servicename']); ?>" size="48" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("servicename");?> <?php echo $tNGs->displayFieldError("services", "servicename", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="servicepublicprice_<?php echo $cnt1; ?>">Price (VND):</label></td>
                    <td><input type="text" name="servicepublicprice_<?php echo $cnt1; ?>" id="servicepublicprice_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsservices['servicepublicprice']); ?>" size="26" />
                      <?php echo $tNGs->displayFieldHint("servicepublicprice");?> <?php echo $tNGs->displayFieldError("services", "servicepublicprice", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="servicenotes_<?php echo $cnt1; ?>">Notes:</label></td>
                    <td><textarea name="servicenotes_<?php echo $cnt1; ?>" id="servicenotes_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsservices['servicenotes']); ?></textarea>
                      <?php echo $tNGs->displayFieldHint("servicenotes");?> <?php echo $tNGs->displayFieldError("services", "servicenotes", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_services_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsservices['kt_pk_services']); ?>" />
                <?php } while ($row_rsservices = mysql_fetch_assoc($rsservices)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_services'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_services')" />
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