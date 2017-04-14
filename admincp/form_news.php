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
  $deleteObj->setFolder("../images/news/");
  $deleteObj->setDbFieldName("newsimage");
  return $deleteObj->Execute();
}
//end Trigger_FileDelete trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("newsimage");
  $uploadObj->setDbFieldName("newsimage");
  $uploadObj->setFolder("../images/news/");
  $uploadObj->setResize("true", 800, 0);
  $uploadObj->setMaxSize(2600);
  $uploadObj->setAllowedExtensions("jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

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
$query_rs_sortcategory = "SELECT ID_newscategory, newscategoryname FROM newscategory WHERE newscategoryvisible = 1 ORDER BY newscategoryname ASC";
$rs_sortcategory = mysql_query($query_rs_sortcategory, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortcategory = mysql_fetch_assoc($rs_sortcategory);
$totalRows_rs_sortcategory = mysql_num_rows($rs_sortcategory);

// Make an insert transaction instance
$ins_news = new tNG_multipleInsert($conn_cnn_teamdnt);
$tNGs->addTransaction($ins_news);
// Register triggers
$ins_news->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_news->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_news->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$ins_news->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_news->setTable("news");
$ins_news->addColumn("newstitle", "STRING_TYPE", "POST", "newstitle");
$ins_news->addColumn("ID_newscategory", "NUMERIC_TYPE", "POST", "ID_newscategory");
$ins_news->addColumn("newsimage", "FILE_TYPE", "FILES", "newsimage");
$ins_news->addColumn("newsshortdes", "STRING_TYPE", "POST", "newsshortdes");
$ins_news->addColumn("newscontent", "STRING_TYPE", "POST", "newscontent");
$ins_news->addColumn("newsview", "NUMERIC_TYPE", "POST", "newsview");
$ins_news->addColumn("checked", "CHECKBOX_1_0_TYPE", "POST", "checked", "0");
$ins_news->addColumn("newsdate", "DATE_TYPE", "VALUE", "{NOW_DT}");
$ins_news->addColumn("ID_account", "NUMERIC_TYPE", "POST", "ID_account", "{SESSION.kt_login_id}");
$ins_news->setPrimaryKey("ID_news", "NUMERIC_TYPE");

// Make an update transaction instance
$upd_news = new tNG_multipleUpdate($conn_cnn_teamdnt);
$tNGs->addTransaction($upd_news);
// Register triggers
$upd_news->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Update1");
$upd_news->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$upd_news->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$upd_news->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$upd_news->setTable("news");
$upd_news->addColumn("newstitle", "STRING_TYPE", "POST", "newstitle");
$upd_news->addColumn("ID_newscategory", "NUMERIC_TYPE", "POST", "ID_newscategory");
$upd_news->addColumn("newsimage", "FILE_TYPE", "FILES", "newsimage");
$upd_news->addColumn("newsshortdes", "STRING_TYPE", "POST", "newsshortdes");
$upd_news->addColumn("newscontent", "STRING_TYPE", "POST", "newscontent");
$upd_news->addColumn("newsview", "NUMERIC_TYPE", "POST", "newsview");
$upd_news->addColumn("checked", "CHECKBOX_1_0_TYPE", "POST", "checked");
$upd_news->addColumn("newsdate", "DATE_TYPE", "CURRVAL", "");
$upd_news->addColumn("ID_account", "NUMERIC_TYPE", "POST", "ID_account");
$upd_news->setPrimaryKey("ID_news", "NUMERIC_TYPE", "GET", "ID_news");

// Make an instance of the transaction object
$del_news = new tNG_multipleDelete($conn_cnn_teamdnt);
$tNGs->addTransaction($del_news);
// Register triggers
$del_news->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Delete1");
$del_news->registerTrigger("END", "Trigger_Default_Redirect", 99, "../includes/nxt/back.php");
$del_news->registerTrigger("AFTER", "Trigger_FileDelete", 98);
// Add columns
$del_news->setTable("news");
$del_news->setPrimaryKey("ID_news", "NUMERIC_TYPE", "GET", "ID_news");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Execute all the registered transactions
$tNGs->executeTransactions();

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsnews = $tNGs->getRecordset("news");
$row_rsnews = mysql_fetch_assoc($rsnews);
$totalRows_rsnews = mysql_num_rows($rsnews);
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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
$NXT_FORM_SETTINGS = {
  duplicate_buttons: true,
  show_as_grid: true,
  merge_down_value: true
}
</script>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
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
if (@$_GET['ID_news'] == "") {
?>
              <?php echo NXT_getResource("Insert_FH"); ?>
              <?php 
// else Conditional region1
} else { ?>
              <?php echo NXT_getResource("Update_FH"); ?>
              <?php } 
// endif Conditional region1
?>
            NEWS DETAIL </h1>
          <div class="KT_tngform">
            <form method="post" id="form1" action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" enctype="multipart/form-data">
              <?php $cnt1 = 0; ?>
              <?php do { ?>
                <?php $cnt1++; ?>
                <?php 
// Show IF Conditional region1 
if (@$totalRows_rsnews > 1) {
?>
                  <h2><?php echo NXT_getResource("Record_FH"); ?> <?php echo $cnt1; ?></h2>
                  <?php } 
// endif Conditional region1
?>
                <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                  <tr>
                    <td width="20%" class="KT_th"><label for="newstitle_<?php echo $cnt1; ?>">Title:</label></td>
                    <td colspan="2"><input type="text" name="newstitle_<?php echo $cnt1; ?>" id="newstitle_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnews['newstitle']); ?>" size="48" maxlength="68" />
                      <?php echo $tNGs->displayFieldHint("newstitle");?> <?php echo $tNGs->displayFieldError("news", "newstitle", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="ID_newscategory_<?php echo $cnt1; ?>">Category:</label></td>
                    <td colspan="2"><select name="ID_newscategory_<?php echo $cnt1; ?>" id="ID_newscategory_<?php echo $cnt1; ?>">
                      <option value=""><?php echo NXT_getResource("Select one..."); ?></option>
                      <?php 
do {  
?>
                      <option value="<?php echo $row_rs_sortcategory['ID_newscategory']?>"<?php if (!(strcmp($row_rs_sortcategory['ID_newscategory'], $row_rsnews['ID_newscategory']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortcategory['newscategoryname']?></option>
                      <?php
} while ($row_rs_sortcategory = mysql_fetch_assoc($rs_sortcategory));
  $rows = mysql_num_rows($rs_sortcategory);
  if($rows > 0) {
      mysql_data_seek($rs_sortcategory, 0);
	  $row_rs_sortcategory = mysql_fetch_assoc($rs_sortcategory);
  }
?>
                    </select>
                      <?php echo $tNGs->displayFieldError("news", "ID_newscategory", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="newsimage_<?php echo $cnt1; ?>">Featured Image:</label></td>
                    <td width="26%"><input type="file" name="newsimage_<?php echo $cnt1; ?>" id="newsimage_<?php echo $cnt1; ?>" size="32" />
                      <?php echo $tNGs->displayFieldError("news", "newsimage", $cnt1); ?></td>
                    <td width="54%"><?php 
						// Show If File Exists (region4)
						if (tNG_fileExists("../images/news/", "{rsnews.newsimage}")) {
						?>
												<img src="<?php echo tNG_showDynamicImage("../", "../images/news/", "{rsnews.newsimage}");?>" width="260px"/>
												<?php 
						// else File Exists (region4)
						} else { ?>
                                                  <img src="../images/image-sample.png" width="330" height="150">
                        <?php } 
						// EndIf File Exists (region4)
						?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="newsshortdes_<?php echo $cnt1; ?>">Short Description:</label></td>
                    <td colspan="2"><textarea name="newsshortdes_<?php echo $cnt1; ?>" id="newsshortdes_<?php echo $cnt1; ?>" cols="50" rows="5"><?php echo KT_escapeAttribute($row_rsnews['newsshortdes']); ?></textarea>
                      <?php echo $tNGs->displayFieldHint("newsshortdes");?> <?php echo $tNGs->displayFieldError("news", "newsshortdes", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="newscontent_<?php echo $cnt1; ?>">Main Content:</label></td>
                    <td colspan="2"><textarea name="newscontent_<?php echo $cnt1; ?>" id="newscontent_<?php echo $cnt1; ?>" cols="50" rows="10"><?php echo KT_escapeAttribute($row_rsnews['newscontent']); ?></textarea>
					<script type="text/javascript">
						CKEDITOR.replace('newscontent_<?php echo $cnt1; ?>', {extraPlugins: 'imageuploader'});
					</script>
                      <?php echo $tNGs->displayFieldHint("newscontent");?> <?php echo $tNGs->displayFieldError("news", "newscontent", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="newsview_<?php echo $cnt1; ?>">View:</label></td>
                    <td colspan="2"><input type="text" name="newsview_<?php echo $cnt1; ?>" id="newsview_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnews['newsview']); ?>" size="10" />
                      <?php echo $tNGs->displayFieldHint("newsview");?> <?php echo $tNGs->displayFieldError("news", "newsview", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th"><label for="checked_<?php echo $cnt1; ?>">Approval:</label></td>
                    <td colspan="2"><input  <?php if (!(strcmp(KT_escapeAttribute($row_rsnews['checked']),"1"))) {echo "checked";} ?> type="checkbox" name="checked_<?php echo $cnt1; ?>" id="checked_<?php echo $cnt1; ?>" value="1" />
                      <?php echo $tNGs->displayFieldError("news", "checked", $cnt1); ?></td>
                  </tr>
                  <tr>
                    <td class="KT_th">Posting Date:</td>
                    <td colspan="2"><?php echo KT_formatDate($row_rsnews['newsdate']); ?></td>
                  </tr>
                </table>
                <input type="hidden" name="kt_pk_news_<?php echo $cnt1; ?>" class="id_field" value="<?php echo KT_escapeAttribute($row_rsnews['kt_pk_news']); ?>" />
                <input type="hidden" name="ID_account_<?php echo $cnt1; ?>" id="ID_account_<?php echo $cnt1; ?>" value="<?php echo KT_escapeAttribute($row_rsnews['ID_account']); ?>" />
                <?php } while ($row_rsnews = mysql_fetch_assoc($rsnews)); ?>
              <div class="KT_bottombuttons">
                <div>
                  <?php 
      // Show IF Conditional region1
      if (@$_GET['ID_news'] == "") {
      ?>
                    <input type="submit" name="KT_Insert1" id="KT_Insert1" value="<?php echo NXT_getResource("Insert_FB"); ?>" />
                    <?php 
      // else Conditional region1
      } else { ?>
                    <div class="KT_operations">
                      <input type="submit" name="KT_Insert1" value="<?php echo NXT_getResource("Insert as new_FB"); ?>" onClick="nxt_form_insertasnew(this, 'ID_news')" />
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
mysql_free_result($rs_sortcategory);
?>