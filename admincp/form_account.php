<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
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

//start Trigger_CheckPasswords trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckPasswords(&$tNG) {
  $myThrowError = new tNG_ThrowError($tNG);
  $myThrowError->setErrorMsg("Could not create account.");
  $myThrowError->setField("password");
  $myThrowError->setFieldErrorMsg("The two passwords do not match.");
  return $myThrowError->Execute();
}
//end Trigger_CheckPasswords trigger

//start Trigger_CheckUnique trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckUnique(&$tNG) {
  $tblFldObj = new tNG_CheckUnique($tNG);
  $tblFldObj->setTable("account");
  $tblFldObj->addFieldName("email");
  $tblFldObj->setErrorMsg("This email was registered in system!");
  return $tblFldObj->Execute();
}
//end Trigger_CheckUnique trigger

//start Trigger_FileDelete trigger
//remove this line if you want to edit the code by hand 
function Trigger_FileDelete(&$tNG) {
  $deleteObj = new tNG_FileDelete($tNG);
  $deleteObj->setFolder("../images/");
  $deleteObj->setDbFieldName("avatar");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("avatar");
  $uploadObj->setDbFieldName("avatar");
  $uploadObj->setFolder("../images/");
  $uploadObj->setMaxSize(2600);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Start trigger
$formValidation = new tNG_FormValidation();
$formValidation->addField("email", true, "text", "email", "", "", "");
$formValidation->addField("username", true, "text", "", "", "", "");
$formValidation->addField("password", true, "text", "", "", "", "");
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_CheckOldPassword trigger
//remove this line if you want to edit the code by hand
function Trigger_CheckOldPassword(&$tNG) {
  return Trigger_UpdatePassword_CheckOldPassword($tNG);
}
//end Trigger_CheckOldPassword trigger

// Make an insert transaction instance
$ins_account = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_account);
// Register triggers
$ins_account->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_account->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_account->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_account->registerConditionalTrigger("{POST.password} != {POST.re_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$ins_account->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_account->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$ins_account->setTable("account");
$ins_account->addColumn("fullname", "STRING_TYPE", "POST", "fullname");
$ins_account->addColumn("email", "STRING_TYPE", "POST", "email");
$ins_account->addColumn("avatar", "FILE_TYPE", "FILES", "avatar");
$ins_account->addColumn("accesslevel", "NUMERIC_TYPE", "POST", "accesslevel");
$ins_account->addColumn("username", "STRING_TYPE", "POST", "username");
$ins_account->addColumn("password", "STRING_TYPE", "POST", "password");
$ins_account->addColumn("registereddate", "DATE_TYPE", "POST", "registereddate", "{NOW_DT}");
$ins_account->setPrimaryKey("ID_account", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_account = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_account);
// Register triggers
$upd_account->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_account->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_account->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_account->registerConditionalTrigger("{POST.password} != {POST.re_password}", "BEFORE", "Trigger_CheckPasswords", 50);
$upd_account->registerTrigger("BEFORE", "Trigger_CheckOldPassword", 60);
$upd_account->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$upd_account->registerTrigger("BEFORE", "Trigger_CheckUnique", 30);
// Add columns
$upd_account->setTable("account");
$upd_account->addColumn("fullname", "STRING_TYPE", "POST", "fullname");
$upd_account->addColumn("email", "STRING_TYPE", "POST", "email");
$upd_account->addColumn("avatar", "FILE_TYPE", "FILES", "avatar");
$upd_account->addColumn("accesslevel", "NUMERIC_TYPE", "POST", "accesslevel");
$upd_account->addColumn("username", "STRING_TYPE", "POST", "username");
$upd_account->addColumn("password", "STRING_TYPE", "POST", "password");
$upd_account->addColumn("registereddate", "DATE_TYPE", "POST", "registereddate");
$upd_account->setPrimaryKey("ID_account", "NUMERIC_TYPE", "GET", "ID_account");

// Make an instance of the transaction object
$del_account = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_account);
// Register triggers
$del_account->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_account->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_account->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_account->setTable("account");
$del_account->setPrimaryKey("ID_account", "NUMERIC_TYPE", "GET", "ID_account");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsaccount = $tNGs->getRecordset("account");
$row_rsaccount = mysql_fetch_assoc($rsaccount);
$totalRows_rsaccount = mysql_num_rows($rsaccount);
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
if (@$_GET['ID_account'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            ACCOUNT DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsaccount > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td width="26%" class="KT_th"><label for="fullname_<?php echo $cnt1; ?>">Full name:</label></td>
                    <td colspan="2"><input type="text" name="fullname_<?php echo $cnt1; ?>" id="fullname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsaccount['fullname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("fullname");?> <?php echo $tNGs->displayFieldError("account", "fullname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="email_<?php echo $cnt1; ?>">Email:</label></td>
                    <td colspan="2"><input type="text" name="email_<?php echo $cnt1; ?>" id="email_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsaccount['email']); ?>" size="48" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("email");?> <?php echo $tNGs->displayFieldError("account", "email", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="avatar_<?php echo $cnt1; ?>">Avatar:<br>(Size: 150x150 pixels)</label></td>
                    <td width="27%"><input type="file" name="avatar_<?php echo $cnt1; ?>" id="avatar_<?php echo $cnt1; ?>" size="32" />
                      <?php echo $tNGs->displayFieldError("account", "avatar", $cnt1); ?></td>
                    <td width="47%"><?php 
						// Show If File Exists (region5)
						if (tNG_fileExists("../images/", "{rsaccount.avatar}")) {
						?>
												<img src="<?php echo tNG_showDynamicImage("../", "../images/", "{rsaccount.avatar}");?>" width="350px;" />
												<?php 
						// else File Exists (region5)
						} else { ?>
						  						<img src="../images/avatar-sample.png" width="150" height="150">
												<?php } 
						// EndIf File Exists (region5)
						?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="accesslevel_<?php echo $cnt1; ?>">Access Level:</label></td>
                    <td colspan="2"><select name="accesslevel_<?php echo $cnt1; ?>" id="accesslevel_<?php echo $cnt1; ?>">
                      <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute($row_rsaccount['accesslevel'])))) {echo "SELECTED";} ?>>Guess</option>
                      <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute($row_rsaccount['accesslevel'])))) {echo "SELECTED";} ?>>Admin</option>
                      <option value="3" <?php if (!(strcmp(3, KT_escapeAttribute($row_rsaccount['accesslevel'])))) {echo "SELECTED";} ?>>Sales Manager</option>
                      <option value="4" <?php if (!(strcmp(4, KT_escapeAttribute($row_rsaccount['accesslevel'])))) {echo "SELECTED";} ?>>Editor</option>
                      <option value="5" <?php if (!(strcmp(5, KT_escapeAttribute($row_rsaccount['accesslevel'])))) {echo "SELECTED";} ?>>Trainee</option>
                    </select>
                      <?php echo $tNGs->displayFieldError("account", "accesslevel", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="username_<?php echo $cnt1; ?>">User Name:</label></td>
                    <td colspan="2"><input type="text" name="username_<?php echo $cnt1; ?>" id="username_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsaccount['username']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("username");?> <?php echo $tNGs->displayFieldError("account", "username", $cnt1); ?></td>
                  </tr>
                  <?php 
// Show IF Conditional show_old_password_on_update_only 
if (@$_GET['ID_account'] != "") {
?>
                    <tr>
                      <td class="KT_th"><label for="old_password_<?php echo $cnt1; ?>">Old Password:</label></td>
                      <td colspan="2"><input type="password" name="old_password_<?php echo $cnt1; ?>" id="old_password_<?php echo $cnt1; ?>" value="" size="36" maxlength="68" />
                        <?php echo $tNGs->displayFieldError("account", "old_password", $cnt1); ?></td>
                    </tr>
                    <?php } 
// endif Conditional show_old_password_on_update_only
?>
                  <tr>
                    <td class="KT_th"><label for="password_<?php echo $cnt1; ?>">Password:</label></td>
                    <td colspan="2"><input type="password" name="password_<?php echo $cnt1; ?>" id="password_<?php echo $cnt1; ?>" value="" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("password");?> <?php echo $tNGs->displayFieldError("account", "password", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="re_password_<?php echo $cnt1; ?>">Re-type Password:</label></td>
                    <td colspan="2"><input type="password" name="re_password_<?php echo $cnt1; ?>" id="re_password_<?php echo $cnt1; ?>" value="" size="36" maxlength="68" /></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_account_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsaccount['kt_pk_account']); ?>" />
                <input type="hidden" name="registereddate_<?php echo $cnt1; ?>" id="registereddate_<?php echo $cnt1; ?>" value="<?php echo KT_formatDate($row_rsaccount['registereddate']); ?>" />
                <?php } while ($row_rsaccount = mysql_fetch_assoc($rsaccount)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_account'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_account')" />
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