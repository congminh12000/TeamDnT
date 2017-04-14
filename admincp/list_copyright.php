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
$tfi_listcopyright1 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listcopyright1");
$tfi_listcopyright1->addColumn("copyright.businessname", "STRING_TYPE", "businessname", "%");
$tfi_listcopyright1->addColumn("copyright.businessemail", "STRING_TYPE", "businessemail", "%");
$tfi_listcopyright1->addColumn("copyright.businesslogo", "STRING_TYPE", "businesslogo", "%");
$tfi_listcopyright1->Execute();

// Sorter
$tso_listcopyright1 = new TSO_TableSorter("rscopyright1", "tso_listcopyright1");
$tso_listcopyright1->addColumn("copyright.businessname");
$tso_listcopyright1->addColumn("copyright.businessemail");
$tso_listcopyright1->addColumn("copyright.businesslogo");
$tso_listcopyright1->setDefault("copyright.businessname");
$tso_listcopyright1->Execute();

// Navigation
$nav_listcopyright1 = new NAV_Regular("nav_listcopyright1", "rscopyright1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rscopyright1 = $_SESSION['max_rows_nav_listcopyright1'];
$pageNum_rscopyright1 = 0;
if (isset($_GET['pageNum_rscopyright1'])) {
  $pageNum_rscopyright1 = $_GET['pageNum_rscopyright1'];
}
$startRow_rscopyright1 = $pageNum_rscopyright1 * $maxRows_rscopyright1;

// Defining List Recordset variable
$NXTFilter_rscopyright1 = "1=1";
if (isset($_SESSION['filter_tfi_listcopyright1'])) {
  $NXTFilter_rscopyright1 = $_SESSION['filter_tfi_listcopyright1'];
}
// Defining List Recordset variable
$NXTSort_rscopyright1 = "copyright.businessname";
if (isset($_SESSION['sorter_tso_listcopyright1'])) {
  $NXTSort_rscopyright1 = $_SESSION['sorter_tso_listcopyright1'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rscopyright1 = "SELECT copyright.businessname, copyright.businessemail, copyright.businesslogo, copyright.ID_copyright FROM copyright WHERE {$NXTFilter_rscopyright1} ORDER BY {$NXTSort_rscopyright1}";
$query_limit_rscopyright1 = sprintf("%s LIMIT %d, %d", $query_rscopyright1, $startRow_rscopyright1, $maxRows_rscopyright1);
$rscopyright1 = mysql_query($query_limit_rscopyright1, $cnn_teamdnt) or die(mysql_error());
$row_rscopyright1 = mysql_fetch_assoc($rscopyright1);

if (isset($_GET['totalRows_rscopyright1'])) {
  $totalRows_rscopyright1 = $_GET['totalRows_rscopyright1'];
} else {
  $all_rscopyright1 = mysql_query($query_rscopyright1);
  $totalRows_rscopyright1 = mysql_num_rows($all_rscopyright1);
}
$totalPages_rscopyright1 = ceil($totalRows_rscopyright1/$maxRows_rscopyright1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcopyright1->checkBoundries();
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
  .KT_col_businessname {width:100%; overflow:hidden;}
  .KT_col_businessemail {width:100%; overflow:hidden;}
  .KT_col_businesslogo {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listcopyright1">
          <h1><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp; COPYRIGHT MANAGEMENT
            <?php
  $nav_listcopyright1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listcopyright1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcopyright1'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listcopyright1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcopyright1'] == 1) {
?>
                  <a href="<?php echo $tfi_listcopyright1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listcopyright1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="businessname" class="KT_sorter KT_col_businessname <?php echo $tso_listcopyright1->getSortIcon('copyright.businessname'); ?>"> <a href="<?php echo $tso_listcopyright1->getSortLink('copyright.businessname'); ?>">Name</a> </th>
                    <th id="businessemail" class="KT_sorter KT_col_businessemail <?php echo $tso_listcopyright1->getSortIcon('copyright.businessemail'); ?>"> <a href="<?php echo $tso_listcopyright1->getSortLink('copyright.businessemail'); ?>">Email</a> </th>
                    <th id="businesslogo" class="KT_sorter KT_col_businesslogo <?php echo $tso_listcopyright1->getSortIcon('copyright.businesslogo'); ?>"> <a href="<?php echo $tso_listcopyright1->getSortLink('copyright.businesslogo'); ?>">Logo</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcopyright1'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listcopyright1_businessname" id="tfi_listcopyright1_businessname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcopyright1_businessname']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listcopyright1_businessemail" id="tfi_listcopyright1_businessemail" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcopyright1_businessemail']); ?>" size="48" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listcopyright1_businesslogo" id="tfi_listcopyright1_businesslogo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcopyright1_businesslogo']); ?>" size="20" maxlength="168" /></td>
                      <td><input type="submit" name="tfi_listcopyright1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rscopyright1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rscopyright1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_copyright" class="id_checkbox" value="<?php echo $row_rscopyright1['ID_copyright']; ?>" />
                          <input type="hidden" name="ID_copyright" class="id_field" value="<?php echo $row_rscopyright1['ID_copyright']; ?>" /></td>
                        <td><div class="KT_col_businessname"><?php echo KT_FormatForList($row_rscopyright1['businessname'], 36); ?></div></td>
                        <td><div class="KT_col_businessemail"><?php echo KT_FormatForList($row_rscopyright1['businessemail'], 12); ?></div></td>
                        <td><div class="KT_col_businesslogo">
                          <?php 
							// Show If File Exists (region4)
							if (tNG_fileExists("../images/", "{rscopyright1.businesslogo}")) {
							?>
														<img src="<?php echo tNG_showDynamicImage("../", "../images/", "{rscopyright1.businesslogo}");?>" />
														<?php 
							// else File Exists (region4)
							} else { ?>
														<img src="../images/logo-sample.png" width="330" height="150">
<?php } 
							// EndIf File Exists (region4)
							?>
                        </div></td>
                        <td><a class="KT_edit_link" href="form_copyright.php?ID_copyright=<?php echo $row_rscopyright1['ID_copyright']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rscopyright1 = mysql_fetch_assoc($rscopyright1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listcopyright1->Prepare();
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
                <a class="KT_additem_op_link" href="form_copyright.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rscopyright1);
?>