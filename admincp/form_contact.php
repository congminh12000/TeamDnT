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
$ins_contact = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_contact);
// Register triggers
$ins_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$ins_contact->setTable("contact");
$ins_contact->addColumn("contactfullname", "STRING_TYPE", "POST", "contactfullname");
$ins_contact->addColumn("contactgroup", "NUMERIC_TYPE", "POST", "contactgroup");
$ins_contact->addColumn("contactservice", "NUMERIC_TYPE", "POST", "contactservice");
$ins_contact->addColumn("contactemail", "STRING_TYPE", "POST", "contactemail");
$ins_contact->addColumn("contactphonenumber", "STRING_TYPE", "POST", "contactphonenumber");
$ins_contact->addColumn("contacttitle", "STRING_TYPE", "POST", "contacttitle");
$ins_contact->addColumn("contactnotes", "STRING_TYPE", "POST", "contactnotes");
$ins_contact->addColumn("contactdate", "DATE_TYPE", "VALUE", "");
$ins_contact->setPrimaryKey("ID_contact", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_contact = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_contact);
// Register triggers
$upd_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_contact->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_contact->setTable("contact");
$upd_contact->addColumn("contactfullname", "STRING_TYPE", "POST", "contactfullname");
$upd_contact->addColumn("contactgroup", "NUMERIC_TYPE", "POST", "contactgroup");
$upd_contact->addColumn("contactservice", "NUMERIC_TYPE", "POST", "contactservice");
$upd_contact->addColumn("contactemail", "STRING_TYPE", "POST", "contactemail");
$upd_contact->addColumn("contactphonenumber", "STRING_TYPE", "POST", "contactphonenumber");
$upd_contact->addColumn("contacttitle", "STRING_TYPE", "POST", "contacttitle");
$upd_contact->addColumn("contactnotes", "STRING_TYPE", "POST", "contactnotes");
$upd_contact->addColumn("contactdate", "DATE_TYPE", "CURRVAL", "");
$upd_contact->setPrimaryKey("ID_contact", "NUMERIC_TYPE", "GET", "ID_contact");

// Make an instance of the transaction object
$del_contact = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_contact);
// Register triggers
$del_contact->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_contact->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_contact->setTable("contact");
$del_contact->setPrimaryKey("ID_contact", "NUMERIC_TYPE", "GET", "ID_contact");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rscontact = $tNGs->getRecordset("contact");
$row_rscontact = mysql_fetch_assoc($rscontact);
$totalRows_rscontact = mysql_num_rows($rscontact);
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
if (@$_GET['ID_contact'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            CONTACT DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rscontact > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="contactfullname_<?php echo $cnt1; ?>">Fullname:</label></td>
                    <td><input type="text" name="contactfullname_<?php echo $cnt1; ?>" id="contactfullname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact['contactfullname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("contactfullname");?> <?php echo $tNGs->displayFieldError("contact", "contactfullname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contactgroup_<?php echo $cnt1; ?>">Contactgroup:</label></td>
                    <td><select name="contactgroup_<?php echo $cnt1; ?>" id="contactgroup_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscontact['contactgroup'])))) {echo "SELECTED";} ?>>Company</option>
                      <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rscontact['contactgroup'])))) {echo "SELECTED";} ?>>Individual</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("contact", "contactgroup", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contactservice_<?php echo $cnt1; ?>">Service:</label></td>
                    <td><select name="contactservice_<?php echo $cnt1; ?>" id="contactservice_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Web Design</option>
                      <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Graphic Design</option>
                      <option value="3" <?php if (!(strcmp(3, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Hosting</option>
                      <option value="4" <?php if (!(strcmp(4, KT_escapeAttribute($row_rscontact['contactservice'])))) {echo "SELECTED";} ?>>Email Hosting</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("contact", "contactservice", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contactemail_<?php echo $cnt1; ?>">Email:</label></td>
                    <td><input type="text" name="contactemail_<?php echo $cnt1; ?>" id="contactemail_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact['contactemail']); ?>" size="46" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("contactemail");?> <?php echo $tNGs->displayFieldError("contact", "contactemail", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contactphonenumber_<?php echo $cnt1; ?>">Phone:</label></td>
                    <td><input type="text" name="contactphonenumber_<?php echo $cnt1; ?>" id="contactphonenumber_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact['contactphonenumber']); ?>" size="20" maxlength="16" />
                      <?php echo $tNGs->displayFieldHint("contactphonenumber");?> <?php echo $tNGs->displayFieldError("contact", "contactphonenumber", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contacttitle_<?php echo $cnt1; ?>">Title:</label></td>
                    <td><input type="text" name="contacttitle_<?php echo $cnt1; ?>" id="contacttitle_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rscontact['contacttitle']); ?>" size="48" maxlength="168" />
                      <?php echo $tNGs->displayFieldHint("contacttitle");?> <?php echo $tNGs->displayFieldError("contact", "contacttitle", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="contactnotes_<?php echo $cnt1; ?>">Content:</label></td>
                    <td><textarea name="contactnotes_<?php echo $cnt1; ?>" id="contactnotes_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rscontact['contactnotes']); ?></textarea>
                      <?php echo $tNGs->displayFieldHint("contactnotes");?> <?php echo $tNGs->displayFieldError("contact", "contactnotes", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th">Date:</td>
                    <td><?php echo KT_formatDate($row_rscontact['contactdate']); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_contact_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rscontact['kt_pk_contact']); ?>" />
                <?php } while ($row_rscontact = mysql_fetch_assoc($rscontact)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_contact'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_contact')" />
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
