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
$tfi_listsupplier2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listsupplier2");
$tfi_listsupplier2->addColumn("supplier.suppliername", "STRING_TYPE", "suppliername", "%");
$tfi_listsupplier2->addColumn("supplier.suppliercontactname", "STRING_TYPE", "suppliercontactname", "%");
$tfi_listsupplier2->addColumn("supplier.supplierlogo", "STRING_TYPE", "supplierlogo", "%");
$tfi_listsupplier2->addColumn("supplier.supplieremail", "STRING_TYPE", "supplieremail", "%");
$tfi_listsupplier2->addColumn("supplier.supplierphonenumber1", "STRING_TYPE", "supplierphonenumber1", "%");
$tfi_listsupplier2->Execute();

// Sorter
$tso_listsupplier2 = new TSO_TableSorter("rssupplier1", "tso_listsupplier2");
$tso_listsupplier2->addColumn("supplier.suppliername");
$tso_listsupplier2->addColumn("supplier.suppliercontactname");
$tso_listsupplier2->addColumn("supplier.supplierlogo");
$tso_listsupplier2->addColumn("supplier.supplieremail");
$tso_listsupplier2->addColumn("supplier.supplierphonenumber1");
$tso_listsupplier2->setDefault("supplier.suppliername");
$tso_listsupplier2->Execute();

// Navigation
$nav_listsupplier2 = new NAV_Regular("nav_listsupplier2", "rssupplier1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rssupplier1 = $_SESSION['max_rows_nav_listsupplier2'];
$pageNum_rssupplier1 = 0;
if (isset($_GET['pageNum_rssupplier1'])) {
  $pageNum_rssupplier1 = $_GET['pageNum_rssupplier1'];
}
$startRow_rssupplier1 = $pageNum_rssupplier1 * $maxRows_rssupplier1;

// Defining List Recordset variable
$NXTFilter_rssupplier1 = "1=1";
if (isset($_SESSION['filter_tfi_listsupplier2'])) {
  $NXTFilter_rssupplier1 = $_SESSION['filter_tfi_listsupplier2'];
}
// Defining List Recordset variable
$NXTSort_rssupplier1 = "supplier.suppliername";
if (isset($_SESSION['sorter_tso_listsupplier2'])) {
  $NXTSort_rssupplier1 = $_SESSION['sorter_tso_listsupplier2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rssupplier1 = "SELECT supplier.suppliername, supplier.suppliercontactname, supplier.supplierlogo, supplier.supplieremail, supplier.supplierphonenumber1, supplier.ID_supplier FROM supplier WHERE {$NXTFilter_rssupplier1} ORDER BY {$NXTSort_rssupplier1}";
$query_limit_rssupplier1 = sprintf("%s LIMIT %d, %d", $query_rssupplier1, $startRow_rssupplier1, $maxRows_rssupplier1);
$rssupplier1 = mysql_query($query_limit_rssupplier1, $cnn_teamdnt) or die(mysql_error());
$row_rssupplier1 = mysql_fetch_assoc($rssupplier1);

if (isset($_GET['totalRows_rssupplier1'])) {
  $totalRows_rssupplier1 = $_GET['totalRows_rssupplier1'];
} else {
  $all_rssupplier1 = mysql_query($query_rssupplier1);
  $totalRows_rssupplier1 = mysql_num_rows($all_rssupplier1);
}
$totalPages_rssupplier1 = ceil($totalRows_rssupplier1/$maxRows_rssupplier1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listsupplier2->checkBoundries();
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
  .KT_col_suppliername {width:100%; overflow:hidden;}
  .KT_col_suppliercontactname {width:100%; overflow:hidden;}
  .KT_col_supplierlogo {width:100%; overflow:hidden;}
  .KT_col_supplieremail {width:100%; overflow:hidden;}
  .KT_col_supplierphonenumber1 {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listsupplier2">
          <h1><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp; SUPPLIER MANAGEMENT
            <?php
  $nav_listsupplier2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listsupplier2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listsupplier2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listsupplier2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listsupplier2'] == 1) {
?>
                  <a href="<?php echo $tfi_listsupplier2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listsupplier2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="suppliername" class="KT_sorter KT_col_suppliername <?php echo $tso_listsupplier2->getSortIcon('supplier.suppliername'); ?>"> <a href="<?php echo $tso_listsupplier2->getSortLink('supplier.suppliername'); ?>">Name</a> </th>
                    <th id="suppliercontactname" class="KT_sorter KT_col_suppliercontactname <?php echo $tso_listsupplier2->getSortIcon('supplier.suppliercontactname'); ?>"> <a href="<?php echo $tso_listsupplier2->getSortLink('supplier.suppliercontactname'); ?>">Contact name</a> </th>
                    <th id="supplierlogo" class="KT_sorter KT_col_supplierlogo <?php echo $tso_listsupplier2->getSortIcon('supplier.supplierlogo'); ?>"> <a href="<?php echo $tso_listsupplier2->getSortLink('supplier.supplierlogo'); ?>">Logo</a> </th>
                    <th id="supplieremail" class="KT_sorter KT_col_supplieremail <?php echo $tso_listsupplier2->getSortIcon('supplier.supplieremail'); ?>"> <a href="<?php echo $tso_listsupplier2->getSortLink('supplier.supplieremail'); ?>">Email</a> </th>
                    <th id="supplierphonenumber1" class="KT_sorter KT_col_supplierphonenumber1 <?php echo $tso_listsupplier2->getSortIcon('supplier.supplierphonenumber1'); ?>"> <a href="<?php echo $tso_listsupplier2->getSortLink('supplier.supplierphonenumber1'); ?>">Phone</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listsupplier2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listsupplier2_suppliername" id="tfi_listsupplier2_suppliername" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupplier2_suppliername']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listsupplier2_suppliercontactname" id="tfi_listsupplier2_suppliercontactname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupplier2_suppliercontactname']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listsupplier2_supplierlogo" id="tfi_listsupplier2_supplierlogo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupplier2_supplierlogo']); ?>" size="20" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listsupplier2_supplieremail" id="tfi_listsupplier2_supplieremail" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupplier2_supplieremail']); ?>" size="36" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listsupplier2_supplierphonenumber1" id="tfi_listsupplier2_supplierphonenumber1" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listsupplier2_supplierphonenumber1']); ?>" size="20" maxlength="18" /></td>
                      <td><input type="submit" name="tfi_listsupplier2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rssupplier1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rssupplier1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_supplier" class="id_checkbox" value="<?php echo $row_rssupplier1['ID_supplier']; ?>" />
                          <input type="hidden" name="ID_supplier" class="id_field" value="<?php echo $row_rssupplier1['ID_supplier']; ?>" /></td>
                        <td><div class="KT_col_suppliername"><?php echo KT_FormatForList($row_rssupplier1['suppliername'], 36); ?></div></td>
                        <td><div class="KT_col_suppliercontactname"><?php echo KT_FormatForList($row_rssupplier1['suppliercontactname'], 36); ?></div></td>
                        <td><?php 
						// Show If File Exists (region4)
						if (tNG_fileExists("../images/logopartners/", "{rssupplier1.supplierlogo}")) {
						?>
													<img src="<?php echo tNG_showDynamicImage("../", "../images/logopartners/", "{rssupplier1.supplierlogo}");?>" />
													<?php 
						// else File Exists (region4)
						} else { ?>
													<img src="../images/logo-sample.png" alt="TeamDnT-WebDesign NoLogo">
													<?php } 
						// EndIf File Exists (region4)
						?></td>
                        <td><div class="KT_col_supplieremail"><?php echo KT_FormatForList($row_rssupplier1['supplieremail'], 12); ?></div></td>
                        <td><div class="KT_col_supplierphonenumber1"><?php echo KT_FormatForList($row_rssupplier1['supplierphonenumber1'], 36); ?></div></td>
                        <td><a class="KT_edit_link" href="form_supplier.php?ID_supplier=<?php echo $row_rssupplier1['ID_supplier']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rssupplier1 = mysql_fetch_assoc($rssupplier1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listsupplier2->Prepare();
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
                <a class="KT_additem_op_link" href="form_supplier.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rssupplier1);
?>
