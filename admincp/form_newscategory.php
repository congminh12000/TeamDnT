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

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_SetOrderColumn trigger
//remove this line if you want to edit the code by hand 
function Trigger_SetOrderColumn(&$tNG) {
  $orderFieldObj = new tNG_SetOrderField($tNG);
  $orderFieldObj->setFieldName("newscategoryorderlist");
  return $orderFieldObj->Execute();
}
//end Trigger_SetOrderColumn trigger

// Make an insert transaction instance
$ins_newscategory = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_newscategory);
// Register triggers
$ins_newscategory->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_newscategory->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_newscategory->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_newscategory->registerTrigger("BEFORE", "Trigger_SetOrderColumn", 50);
// Add columns
$ins_newscategory->setTable("newscategory");
$ins_newscategory->addColumn("newscategoryname", "STRING_TYPE", "POST", "newscategoryname");
$ins_newscategory->addColumn("newscategoryvisible", "CHECKBOX_1_0_TYPE", "POST", "newscategoryvisible", "0");
$ins_newscategory->setPrimaryKey("ID_newscategory", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_newscategory = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_newscategory);
// Register triggers
$upd_newscategory->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_newscategory->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_newscategory->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$upd_newscategory->setTable("newscategory");
$upd_newscategory->addColumn("newscategoryname", "STRING_TYPE", "POST", "newscategoryname");
$upd_newscategory->addColumn("newscategoryvisible", "CHECKBOX_1_0_TYPE", "POST", "newscategoryvisible");
$upd_newscategory->setPrimaryKey("ID_newscategory", "NUMERIC_TYPE", "GET", "ID_newscategory");

// Make an instance of the transaction object
$del_newscategory = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_newscategory);
// Register triggers
$del_newscategory->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_newscategory->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
// Add columns
$del_newscategory->setTable("newscategory");
$del_newscategory->setPrimaryKey("ID_newscategory", "NUMERIC_TYPE", "GET", "ID_newscategory");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsnewscategory = $tNGs->getRecordset("newscategory");
$row_rsnewscategory = mysql_fetch_assoc($rsnewscategory);
$totalRows_rsnewscategory = mysql_num_rows($rsnewscategory);
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
if (@$_GET['ID_newscategory'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            NEWS CATEGORY DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsnewscategory > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td class="KT_th"><label for="newscategoryname_<?php echo $cnt1; ?>">Category:</label></td>
                    <td><input type="text" name="newscategoryname_<?php echo $cnt1; ?>" id="newscategoryname_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnewscategory['newscategoryname']); ?>" size="36" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("newscategoryname");?> <?php echo $tNGs->displayFieldError("newscategory", "newscategoryname", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="newscategoryvisible_<?php echo $cnt1; ?>">Visible:</label></td>
                    <td><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsnewscategory['newscategoryvisible']),"1"))) {echo "checked";} ?> type="checkbox" name="newscategoryvisible_<?php echo $cnt1; ?>" id="newscategoryvisible_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("newscategory", "newscategoryvisible", $cnt1); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_newscategory_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsnewscategory['kt_pk_newscategory']); ?>" />
                <?php } while ($row_rsnewscategory = mysql_fetch_assoc($rsnewscategory)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_newscategory'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onclick="nxt_form_insertasnew(this, 'ID_newscategory')" />
                    </div>
                    <input type="submit" name="KT_Update1" value="<?php echo NXT_getResource("Update_FB"); ?>" />
                    <input type="submit" name="KT_Delete1" value="<?php echo NXT_getResource("Delete_FB"); ?>" onclick="return confirm('<?php echo NXT_getResource("Are you sure?"); ?>');" />
                    <?php }
      // endif Conditional region1
      ?>
                  <input type="button" name="KT_Cancel1" value="<?php echo NXT_getResource("Cancel_FB"); ?>" onclick="return UNI_navigateCancel(event, '../includes/nxt/back.php')" />
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