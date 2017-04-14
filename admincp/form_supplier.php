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

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../images/logopartners/");
  $deleteObj->setDbFieldName("supplierlogo");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("supplierlogo");
  $uploadObj->setDbFieldName("supplierlogo");
  $uploadObj->setFolder("../images/logopartners/");
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_supplier = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_supplier);
// Register triggers
$ins_supplier->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_supplier->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_supplier->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_supplier->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_supplier->setTable("supplier");
$ins_supplier->addColumn("suppliername", "STRING_TYPE", "POST", "suppliername");
$ins_supplier->addColumn("suppliercontactname", "STRING_TYPE", "POST", "suppliercontactname");
$ins_supplier->addColumn("supplierlogo", "FILE_TYPE", "FILES", "supplierlogo");
$ins_supplier->addColumn("supplierphonenumber1", "STRING_TYPE", "POST", "supplierphonenumber1");
$ins_supplier->addColumn("supplierphonenumber2", "STRING_TYPE", "POST", "supplierphonenumber2");
$ins_supplier->addColumn("supplieremail", "STRING_TYPE", "POST", "supplieremail");
$ins_supplier->addColumn("supplieraddress", "STRING_TYPE", "POST", "supplieraddress");
$ins_supplier->setPrimaryKey("ID_supplier", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_supplier = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_supplier);
// Register triggers
$upd_supplier->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_supplier->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_supplier->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_supplier->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_supplier->setTable("supplier");
$upd_supplier->addColumn("suppliername", "STRING_TYPE", "POST", "suppliername");
$upd_supplier->addColumn("suppliercontactname", "STRING_TYPE", "POST", "suppliercontactname");
$upd_supplier->addColumn("supplierlogo", "FILE_TYPE", "FILES", "supplierlogo");
$upd_supplier->addColumn("supplierphonenumber1", "STRING_TYPE", "POST", "supplierphonenumber1");
$upd_supplier->addColumn("supplierphonenumber2", "STRING_TYPE", "POST", "supplierphonenumber2");
$upd_supplier->addColumn("supplieremail", "STRING_TYPE", "POST", "supplieremail");
$upd_supplier->addColumn("supplieraddress", "STRING_TYPE", "POST", "supplieraddress");
$upd_supplier->setPrimaryKey("ID_supplier", "NUMERIC_TYPE", "GET", "ID_supplier");

// Make an instance of the transaction object
$del_supplier = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_supplier);
// Register triggers
$del_supplier->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_supplier->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_supplier->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_supplier->setTable("supplier");
$del_supplier->setPrimaryKey("ID_supplier", "NUMERIC_TYPE", "GET", "ID_supplier");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rssupplier = $tNGs->getRecordset("supplier");
$row_rssupplier = mysql_fetch_assoc($rssupplier);
$totalRows_rssupplier = mysql_num_rows($rssupplier);
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
if (@$_GET['ID_supplier'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            SUPPLIER DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rssupplier > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td width="22%" class="KT_th"><label for="suppliername_<?php echo $cnt1; ?>">Name:</label></td>
                    <td colspan="2"><input type="text" name="suppliername_<?php echo $cnt1; ?>" id="suppliername_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['suppliername']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("suppliername");?> <?php echo $tNGs->displayFieldError("supplier", "suppliername", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="suppliercontactname_<?php echo $cnt1; ?>">Contact name:</label></td>
                    <td colspan="2"><input type="text" name="suppliercontactname_<?php echo $cnt1; ?>" id="suppliercontactname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['suppliercontactname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("suppliercontactname");?> <?php echo $tNGs->displayFieldError("supplier", "suppliercontactname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="supplierlogo_<?php echo $cnt1; ?>">Logo:<br>(Size: 330x150 pixels)</label></td>
                    <td width="28%"><input type="file" name="supplierlogo_<?php echo $cnt1; ?>" id="supplierlogo_<?php echo $cnt1; ?>" size="32" />
                      <?php echo $tNGs->displayFieldError("supplier", "supplierlogo", $cnt1); ?></td>
                    <td width="50%"><?php 
					// Show If File Exists (region4)
					if (tNG_fileExists("../images/logopartners/", "{rssupplier.supplierlogo}")) {
					?>
											<img src="<?php echo tNG_showDynamicImage("../", "../images/logopartners/", "{rssupplier.supplierlogo}");?>" />
											<?php 
					// else File Exists (region4)
					} else { ?>
											<img src="../images/logo-sample.png" alt="TeamDnT-WebDesign NoLogo">
					  <?php } 
					// EndIf File Exists (region4)
					?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="supplierphonenumber1_<?php echo $cnt1; ?>">Phone (1):</label></td>
                    <td colspan="2"><input type="text" name="supplierphonenumber1_<?php echo $cnt1; ?>" id="supplierphonenumber1_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['supplierphonenumber1']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("supplierphonenumber1");?> <?php echo $tNGs->displayFieldError("supplier", "supplierphonenumber1", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="supplierphonenumber2_<?php echo $cnt1; ?>">Phone (2):</label></td>
                    <td colspan="2"><input type="text" name="supplierphonenumber2_<?php echo $cnt1; ?>" id="supplierphonenumber2_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['supplierphonenumber2']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("supplierphonenumber2");?> <?php echo $tNGs->displayFieldError("supplier", "supplierphonenumber2", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="supplieremail_<?php echo $cnt1; ?>">Email:</label></td>
                    <td colspan="2"><input type="text" name="supplieremail_<?php echo $cnt1; ?>" id="supplieremail_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['supplieremail']); ?>" size="36" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("supplieremail");?> <?php echo $tNGs->displayFieldError("supplier", "supplieremail", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="supplieraddress_<?php echo $cnt1; ?>">Address:</label></td>
                    <td colspan="2"><input type="text" name="supplieraddress_<?php echo $cnt1; ?>" id="supplieraddress_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rssupplier['supplieraddress']); ?>" size="46" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("supplieraddress");?> <?php echo $tNGs->displayFieldError("supplier", "supplieraddress", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_supplier_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rssupplier['kt_pk_supplier']); ?>" />
                <?php } while ($row_rssupplier = mysql_fetch_assoc($rssupplier)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_supplier'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_supplier')" />
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
