<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the required classes
require_once('../includes/tfi/TFI.php');
require_once('../includes/tso/TSO.php');
require_once('../includes/nav/NAV.php');

// Make unified connection variable
$conn_cnn_teamdnt = new KT_connection($cnn_teamdnt, $database_cnn_teamdnt);

//Start Restrict Access To Page
$restrict = new tNG_RestrictAccess($conn_cnn_teamdnt, "../");
//Grand Levels: Level
$restrict->addLevel("2");
$restrict->Execute();
//End Restrict Access To Page

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

// Filter
$tfi_listnews2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listnews2");
$tfi_listnews2->addColumn("news.newstitle", "STRING_TYPE", "newstitle", "%");
$tfi_listnews2->addColumn("newscategory.ID_newscategory", "NUMERIC_TYPE", "ID_newscategory", "=");
$tfi_listnews2->addColumn("news.newsimage", "STRING_TYPE", "newsimage", "%");
$tfi_listnews2->addColumn("news.newsview", "NUMERIC_TYPE", "newsview", "=");
$tfi_listnews2->addColumn("news.checked", "NUMERIC_TYPE", "checked", "=");
$tfi_listnews2->addColumn("account.ID_account", "NUMERIC_TYPE", "ID_account", "=");
$tfi_listnews2->addColumn("news.newsdate", "DATE_TYPE", "newsdate", "=");
$tfi_listnews2->Execute();

// Sorter
$tso_listnews2 = new TSO_TableSorter("rsnews1", "tso_listnews2");
$tso_listnews2->addColumn("news.newstitle");
$tso_listnews2->addColumn("newscategory.newscategoryname");
$tso_listnews2->addColumn("news.newsimage");
$tso_listnews2->addColumn("news.newsview");
$tso_listnews2->addColumn("news.checked");
$tso_listnews2->addColumn("account.username");
$tso_listnews2->addColumn("news.newsdate");
$tso_listnews2->setDefault("news.newsdate DESC");
$tso_listnews2->Execute();

// Navigation
$nav_listnews2 = new NAV_Regular("nav_listnews2", "rsnews1", "../", $_SERVER['PHP_SELF'], 28);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT username, ID_account FROM account ORDER BY username";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset2 = "SELECT username, ID_account FROM account ORDER BY username";
$Recordset2 = mysql_query($query_Recordset2, $cnn_teamdnt) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

//NeXTenesio3 Special List Recordset
$maxRows_rsnews1 = $_SESSION['max_rows_nav_listnews2'];
$pageNum_rsnews1 = 0;
if (isset($_GET['pageNum_rsnews1'])) {
  $pageNum_rsnews1 = $_GET['pageNum_rsnews1'];
}
$startRow_rsnews1 = $pageNum_rsnews1 * $maxRows_rsnews1;

// Defining List Recordset variable
$NXTFilter_rsnews1 = "1=1";
if (isset($_SESSION['filter_tfi_listnews2'])) {
  $NXTFilter_rsnews1 = $_SESSION['filter_tfi_listnews2'];
}
// Defining List Recordset variable
$NXTSort_rsnews1 = "news.newsdate DESC";
if (isset($_SESSION['sorter_tso_listnews2'])) {
  $NXTSort_rsnews1 = $_SESSION['sorter_tso_listnews2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsnews1 = "SELECT news.newstitle, newscategory.newscategoryname AS ID_newscategory, news.newsimage, news.newsview, news.checked, account.username AS ID_account, news.newsdate, news.ID_news FROM (news LEFT JOIN newscategory ON news.ID_newscategory = newscategory.ID_newscategory) LEFT JOIN account ON news.ID_account = account.ID_account WHERE {$NXTFilter_rsnews1} ORDER BY {$NXTSort_rsnews1}";
$query_limit_rsnews1 = sprintf("%s LIMIT %d, %d", $query_rsnews1, $startRow_rsnews1, $maxRows_rsnews1);
$rsnews1 = mysql_query($query_limit_rsnews1, $cnn_teamdnt) or die(mysql_error());
$row_rsnews1 = mysql_fetch_assoc($rsnews1);

if (isset($_GET['totalRows_rsnews1'])) {
  $totalRows_rsnews1 = $_GET['totalRows_rsnews1'];
} else {
  $all_rsnews1 = mysql_query($query_rsnews1);
  $totalRows_rsnews1 = mysql_num_rows($all_rsnews1);
}
$totalPages_rsnews1 = ceil($totalRows_rsnews1/$maxRows_rsnews1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listnews2->checkBoundries();
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
<script src="../includes/nxt/scripts/list.js" type="text/javascript"></script>
<script src="../includes/nxt/scripts/list.js.php" type="text/javascript"></script>
<script type="text/javascript">
$NXT_LIST_SETTINGS = {
  duplicate_buttons: true,
  duplicate_navigation: true,
  row_effects: true,
  show_as_buttons: true,
  record_counter: false
}
</script>
<style type="text/css">
  /* Dynamic List row settings */
  .KT_col_newstitle {width:100%; overflow:hidden;}
  .KT_col_ID_newscategory {width:100%; overflow:hidden;}
  .KT_col_newsimage {width:100%; overflow:hidden;}
  .KT_col_newsview {width:100%; overflow:hidden;}
  .KT_col_checked {width:100%; overflow:hidden;}
  .KT_col_ID_account {width:100%; overflow:hidden;}
  .KT_col_newsdate {width:100%; overflow:hidden;}
</style>
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
        <div class="KT_tng" id="listnews2">
          <h1><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;&nbsp; NEWS MANAGEMENT
            <?php
  $nav_listnews2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listnews2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listnews2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listnews2']; ?>
                  <?php 
  // else Conditional region1
  } else { ?>
                  <?php echo NXT_getResource("all"); ?>
                  <?php } 
  // endif Conditional region1
?>
<?php echo NXT_getResource("records"); ?></a> &nbsp;
                &nbsp;
                <?php 
  // Show IF Conditional region2
  if (@$_SESSION['has_filter_tfi_listnews2'] == 1) {
?>
                  <a href="<?php echo $tfi_listnews2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listnews2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="newstitle" class="KT_sorter KT_col_newstitle <?php echo $tso_listnews2->getSortIcon('news.newstitle'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('news.newstitle'); ?>">Title</a> </th>
                    
                    <th id="newsimage" class="KT_sorter KT_col_newsimage <?php echo $tso_listnews2->getSortIcon('news.newsimage'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('news.newsimage'); ?>">Featured Image</a> </th>
                    <th id="newsview" class="KT_sorter KT_col_newsview <?php echo $tso_listnews2->getSortIcon('news.newsview'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('news.newsview'); ?>">View</a> </th>
                    <th id="checked" class="KT_sorter KT_col_checked <?php echo $tso_listnews2->getSortIcon('news.checked'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('news.checked'); ?>">Approval</a> </th>
                    <th id="ID_account" class="KT_sorter KT_col_ID_account <?php echo $tso_listnews2->getSortIcon('account.username'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('account.username'); ?>">Editor</a> </th>
                    <th id="newsdate" class="KT_sorter KT_col_newsdate <?php echo $tso_listnews2->getSortIcon('news.newsdate'); ?>"> <a href="<?php echo $tso_listnews2->getSortLink('news.newsdate'); ?>">Posting Date</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listnews2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listnews2_newstitle" id="tfi_listnews2_newstitle" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listnews2_newstitle']); ?>" size="48" maxlength="68" /></td>
                      
                      <td><input type="text" name="tfi_listnews2_newsimage" id="tfi_listnews2_newsimage" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listnews2_newsimage']); ?>" size="20" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listnews2_newsview" id="tfi_listnews2_newsview" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listnews2_newsview']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listnews2_checked" id="tfi_listnews2_checked" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listnews2_checked']); ?>" size="20" maxlength="100" /></td>
                      <td><select name="tfi_listnews2_ID_account" id="tfi_listnews2_ID_account">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listnews2_ID_account']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset2['ID_account']?>"<?php if (!(strcmp($row_Recordset2['ID_account'], @$_SESSION['tfi_listnews2_ID_account']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['username']?></option>
                        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listnews2_newsdate" id="tfi_listnews2_newsdate" value="<?php echo @$_SESSION['tfi_listnews2_newsdate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="submit" name="tfi_listnews2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsnews1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="9"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsnews1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_news" class="id_checkbox" value="<?php echo $row_rsnews1['ID_news']; ?>" />
                          <input type="hidden" name="ID_news" class="id_field" value="<?php echo $row_rsnews1['ID_news']; ?>" /></td>
                        <td><div class="KT_col_newstitle"><?php echo KT_FormatForList($row_rsnews1['newstitle'], 48); ?><br><b>Chuyên mục:</b> <?php echo KT_FormatForList($row_rsnews1['ID_newscategory'], 36); ?></div></td>
                        <td><?php 
						// Show If File Exists (region4)
						if (tNG_fileExists("../images/news/", "{rsnews1.newsimage}")) {
						?>
							<img src="<?php echo tNG_showDynamicImage("../", "../images/news/", "{rsnews1.newsimage}");?>" width="180px" />
													<?php 
						// else File Exists (region4)
						} else { ?>
													<img src="../images/image-sample.png" width="330" height="150">
<?php } 
						// EndIf File Exists (region4)
						?></td>
                        <td><div class="KT_col_newsview"><?php echo KT_FormatForList($row_rsnews1['newsview'], 20); ?></div></td>
                        <td><?php 
							// Show IF Conditional region5 
							if (@$row_rsnews1['checked'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region5
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
							  <?php } 
							// endif Conditional region5
							?></td>
                        <td><div class="KT_col_ID_account"><?php echo KT_FormatForList($row_rsnews1['ID_account'], 36); ?></div></td>
                        <td><div class="KT_col_newsdate"><?php echo KT_formatDate($row_rsnews1['newsdate']); ?></div></td>
<td><a class="KT_edit_link" href="form_news.php?ID_news=<?php echo $row_rsnews1['ID_news']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsnews1 = mysql_fetch_assoc($rsnews1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listnews2->Prepare();
            require("../includes/nav/NAV_Text_Navigation.inc.php");
          ?>
                </div>
              </div>
              <div class="KT_bottombuttons">
                <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onClick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onClick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
                <span>&nbsp;</span>
                <select name="no_new" id="no_new">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <a class="KT_additem_op_link" href="form_news.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
mysql_free_result($rsnews1);
?>