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
$ins_customer = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_customer);
// Register triggers
$ins_customer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_customer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_customer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_customer->setTable("customer");
$ins_customer->addColumn("customergender", "NUMERIC_TYPE", "POST", "customergender");
$ins_customer->addColumn("customerfullname", "STRING_TYPE", "POST", "customerfullname");
$ins_customer->addColumn("customergroup", "NUMERIC_TYPE", "POST", "customergroup");
$ins_customer->addColumn("customeremail", "STRING_TYPE", "POST", "customeremail");
$ins_customer->addColumn("customerphonenumber", "STRING_TYPE", "POST", "customerphonenumber");
$ins_customer->addColumn("customercompany", "STRING_TYPE", "POST", "customercompany");
$ins_customer->addColumn("customerstatus", "CHECKBOX_1_0_TYPE", "POST", "customerstatus", "0");
$ins_customer->setPrimaryKey("ID_customer", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_customer = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_customer);
// Register triggers
$upd_customer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_customer->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_customer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_customer->setTable("customer");
$upd_customer->addColumn("customergender", "NUMERIC_TYPE", "POST", "customergender");
$upd_customer->addColumn("customerfullname", "STRING_TYPE", "POST", "customerfullname");
$upd_customer->addColumn("customergroup", "NUMERIC_TYPE", "POST", "customergroup");
$upd_customer->addColumn("customeremail", "STRING_TYPE", "POST", "customeremail");
$upd_customer->addColumn("customerphonenumber", "STRING_TYPE", "POST", "customerphonenumber");
$upd_customer->addColumn("customercompany", "STRING_TYPE", "POST", "customercompany");
$upd_customer->addColumn("customerstatus", "CHECKBOX_1_0_TYPE", "POST", "customerstatus");
$upd_customer->setPrimaryKey("ID_customer", "NUMERIC_TYPE", "GET", "ID_customer");

// Make an instance of the transaction object
$del_customer = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_customer);
// Register triggers
$del_customer->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_customer->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_customer->setTable("customer");
$del_customer->setPrimaryKey("ID_customer", "NUMERIC_TYPE", "GET", "ID_customer");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscustomer = $tNGs->getRecordset("customer");
$row_rscustomer = mysql_fetch_assoc($rscustomer);
$totalRows_rscustomer = mysql_num_rows($rscustomer);
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
if (@$_GET['ID_customer'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            CUSTOMER DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rscustomer > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="customergender_<?php echo $cnt1; ?>">Gender:</label></td>
                    <td><select name="customergender_<?php echo $cnt1; ?>" id="customergender_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscustomer['customergender'])))) {echo "SELECTED";} ?>>Mr</option>
                      <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute($row_rscustomer['customergender'])))) {echo "SELECTED";} ?>>Ms</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("customer", "customergender", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customerfullname_<?php echo $cnt1; ?>">Full name:</label></td>
                    <td><input type="text" name="customerfullname_<?php echo $cnt1; ?>" id="customerfullname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer['customerfullname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("customerfullname");?> <?php echo $tNGs->displayFieldError("customer", "customerfullname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customergroup_<?php echo $cnt1; ?>">Group:</label></td>
                    <td><select name="customergroup_<?php echo $cnt1; ?>" id="customergroup_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscustomer['customergroup'])))) {echo "SELECTED";} ?>>Company</option>
                      <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rscustomer['customergroup'])))) {echo "SELECTED";} ?>>Individual</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("customer", "customergroup", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customeremail_<?php echo $cnt1; ?>">Email:</label></td>
                    <td><input type="text" name="customeremail_<?php echo $cnt1; ?>" id="customeremail_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer['customeremail']); ?>" size="36" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("customeremail");?> <?php echo $tNGs->displayFieldError("customer", "customeremail", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customerphonenumber_<?php echo $cnt1; ?>">Phone:</label></td>
                    <td><input type="text" name="customerphonenumber_<?php echo $cnt1; ?>" id="customerphonenumber_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer['customerphonenumber']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("customerphonenumber");?> <?php echo $tNGs->displayFieldError("customer", "customerphonenumber", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customercompany_<?php echo $cnt1; ?>">Company:</label></td>
                    <td><input type="text" name="customercompany_<?php echo $cnt1; ?>" id="customercompany_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscustomer['customercompany']); ?>" size="38" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("customercompany");?> <?php echo $tNGs->displayFieldError("customer", "customercompany", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="customerstatus_<?php echo $cnt1; ?>">Status:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rscustomer['customerstatus']),"1"))) {echo "checked";} ?> type="checkbox" name="customerstatus_<?php echo $cnt1; ?>" id="customerstatus_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("customer", "customerstatus", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_customer_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscustomer['kt_pk_customer']); ?>" />
                <?php } while ($row_rscustomer = mysql_fetch_assoc($rscustomer)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_customer'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_customer')" />
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