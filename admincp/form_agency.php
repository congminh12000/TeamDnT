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
  $deleteObj->setDbFieldName("agencylogo");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("agencylogo");
  $uploadObj->setDbFieldName("agencylogo");
  $uploadObj->setFolder("../images/logopartners/");
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_agency = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_agency);
// Register triggers
$ins_agency->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_agency->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_agency->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_agency->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_agency->setTable("agency");
$ins_agency->addColumn("agencyname", "STRING_TYPE", "POST", "agencyname");
$ins_agency->addColumn("agencylogo", "FILE_TYPE", "FILES", "agencylogo");
$ins_agency->addColumn("agencyemail", "STRING_TYPE", "POST", "agencyemail");
$ins_agency->addColumn("agencyphonenumber1", "STRING_TYPE", "POST", "agencyphonenumber1");
$ins_agency->addColumn("agencyphonenumber2", "STRING_TYPE", "POST", "agencyphonenumber2");
$ins_agency->addColumn("agencyaddress", "STRING_TYPE", "POST", "agencyaddress");
$ins_agency->addColumn("agencyfacebook", "STRING_TYPE", "POST", "agencyfacebook");
$ins_agency->addColumn("agencygoogle", "STRING_TYPE", "POST", "agencygoogle");
$ins_agency->addColumn("agencyyoutube", "STRING_TYPE", "POST", "agencyyoutube");
$ins_agency->setPrimaryKey("ID_agency", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_agency = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_agency);
// Register triggers
$upd_agency->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_agency->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_agency->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_agency->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_agency->setTable("agency");
$upd_agency->addColumn("agencyname", "STRING_TYPE", "POST", "agencyname");
$upd_agency->addColumn("agencylogo", "FILE_TYPE", "FILES", "agencylogo");
$upd_agency->addColumn("agencyemail", "STRING_TYPE", "POST", "agencyemail");
$upd_agency->addColumn("agencyphonenumber1", "STRING_TYPE", "POST", "agencyphonenumber1");
$upd_agency->addColumn("agencyphonenumber2", "STRING_TYPE", "POST", "agencyphonenumber2");
$upd_agency->addColumn("agencyaddress", "STRING_TYPE", "POST", "agencyaddress");
$upd_agency->addColumn("agencyfacebook", "STRING_TYPE", "POST", "agencyfacebook");
$upd_agency->addColumn("agencygoogle", "STRING_TYPE", "POST", "agencygoogle");
$upd_agency->addColumn("agencyyoutube", "STRING_TYPE", "POST", "agencyyoutube");
$upd_agency->setPrimaryKey("ID_agency", "NUMERIC_TYPE", "GET", "ID_agency");

// Make an instance of the transaction object
$del_agency = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_agency);
// Register triggers
$del_agency->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_agency->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_agency->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_agency->setTable("agency");
$del_agency->setPrimaryKey("ID_agency", "NUMERIC_TYPE", "GET", "ID_agency");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsagency = $tNGs->getRecordset("agency");
$row_rsagency = mysql_fetch_assoc($rsagency);
$totalRows_rsagency = mysql_num_rows($rsagency);
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
if (@$_GET['ID_agency'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            AGENCY DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsagency > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td width="22%" class="KT_th"><label for="agencyname_<?php echo $cnt1; ?>">Name:</label></td>
                    <td colspan="2"><input type="text" name="agencyname_<?php echo $cnt1; ?>" id="agencyname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("agencyname");?> <?php echo $tNGs->displayFieldError("agency", "agencyname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencylogo_<?php echo $cnt1; ?>">Logo:<br>(Size: 330x150 pixels)</label></td>
                    <td width="32%"><input type="file" name="agencylogo_<?php echo $cnt1; ?>" id="agencylogo_<?php echo $cnt1; ?>" size="32" />
                      <?php echo $tNGs->displayFieldError("agency", "agencylogo", $cnt1); ?></td>
                    <td width="46%"><?php 
					// Show If File Exists (region4)
					if (tNG_fileExists("../images/logopartners/", "{rsagency.agencylogo}")) {
					?>
											<img src="<?php echo tNG_showDynamicImage("../", "../images/logopartners/", "{rsagency.agencylogo}");?>" />
											<?php 
					// else File Exists (region4)
					} else { ?>
											<img src="../images/logo-sample.png" alt="TeamDnT-WebDesign NoLogo">
					  <?php } 
					// EndIf File Exists (region4)
					?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyemail_<?php echo $cnt1; ?>">Email:</label></td>
                    <td colspan="2"><input type="text" name="agencyemail_<?php echo $cnt1; ?>" id="agencyemail_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyemail']); ?>" size="36" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("agencyemail");?> <?php echo $tNGs->displayFieldError("agency", "agencyemail", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyphonenumber1_<?php echo $cnt1; ?>">Phone (1):</label></td>
                    <td colspan="2"><input type="text" name="agencyphonenumber1_<?php echo $cnt1; ?>" id="agencyphonenumber1_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyphonenumber1']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("agencyphonenumber1");?> <?php echo $tNGs->displayFieldError("agency", "agencyphonenumber1", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyphonenumber2_<?php echo $cnt1; ?>">Phone (2):</label></td>
                    <td colspan="2"><input type="text" name="agencyphonenumber2_<?php echo $cnt1; ?>" id="agencyphonenumber2_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyphonenumber2']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("agencyphonenumber2");?> <?php echo $tNGs->displayFieldError("agency", "agencyphonenumber2", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyaddress_<?php echo $cnt1; ?>">Address:</label></td>
                    <td colspan="2"><input type="text" name="agencyaddress_<?php echo $cnt1; ?>" id="agencyaddress_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyaddress']); ?>" size="46" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("agencyaddress");?> <?php echo $tNGs->displayFieldError("agency", "agencyaddress", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyfacebook_<?php echo $cnt1; ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i>&nbsp;&nbsp;Facebook link:</label></td>
                    <td colspan="2"><input type="text" name="agencyfacebook_<?php echo $cnt1; ?>" id="agencyfacebook_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyfacebook']); ?>" size="38" maxlength="248" />
                      <?php echo $tNGs->displayFieldHint("agencyfacebook");?> <?php echo $tNGs->displayFieldError("agency", "agencyfacebook", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencygoogle_<?php echo $cnt1; ?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i>&nbsp;&nbsp;Google link:</label></td>
                    <td colspan="2"><input type="text" name="agencygoogle_<?php echo $cnt1; ?>" id="agencygoogle_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencygoogle']); ?>" size="38" maxlength="248" />
                      <?php echo $tNGs->displayFieldHint("agencygoogle");?> <?php echo $tNGs->displayFieldError("agency", "agencygoogle", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="agencyyoutube_<?php echo $cnt1; ?>"><i class="fa fa-youtube-square" aria-hidden="true"></i>&nbsp;&nbsp;Youtube link:</label></td>
                    <td colspan="2"><input type="text" name="agencyyoutube_<?php echo $cnt1; ?>" id="agencyyoutube_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsagency['agencyyoutube']); ?>" size="38" maxlength="248" />
                      <?php echo $tNGs->displayFieldHint("agencyyoutube");?> <?php echo $tNGs->displayFieldError("agency", "agencyyoutube", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_agency_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsagency['kt_pk_agency']); ?>" />
                <?php } while ($row_rsagency = mysql_fetch_assoc($rsagency)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_agency'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_agency')" />
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
