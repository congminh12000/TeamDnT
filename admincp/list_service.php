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
$tfi_listservices1 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listservices1");
$tfi_listservices1->addColumn("services.servicecode", "STRING_TYPE", "servicecode", "%");
$tfi_listservices1->addColumn("services.servicename", "STRING_TYPE", "servicename", "%");
$tfi_listservices1->addColumn("services.servicepublicprice", "NUMERIC_TYPE", "servicepublicprice", "=");
$tfi_listservices1->Execute();

// Sorter
$tso_listservices1 = new TSO_TableSorter("rsservices1", "tso_listservices1");
$tso_listservices1->addColumn("services.servicecode");
$tso_listservices1->addColumn("services.servicename");
$tso_listservices1->addColumn("services.servicepublicprice");
$tso_listservices1->setDefault("services.servicecode");
$tso_listservices1->Execute();

// Navigation
$nav_listservices1 = new NAV_Regular("nav_listservices1", "rsservices1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rsservices1 = $_SESSION['max_rows_nav_listservices1'];
$pageNum_rsservices1 = 0;
if (isset($_GET['pageNum_rsservices1'])) {
  $pageNum_rsservices1 = $_GET['pageNum_rsservices1'];
}
$startRow_rsservices1 = $pageNum_rsservices1 * $maxRows_rsservices1;

// Defining List Recordset variable
$NXTFilter_rsservices1 = "1=1";
if (isset($_SESSION['filter_tfi_listservices1'])) {
  $NXTFilter_rsservices1 = $_SESSION['filter_tfi_listservices1'];
}
// Defining List Recordset variable
$NXTSort_rsservices1 = "services.servicecode";
if (isset($_SESSION['sorter_tso_listservices1'])) {
  $NXTSort_rsservices1 = $_SESSION['sorter_tso_listservices1'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsservices1 = "SELECT services.servicecode, services.servicename, services.servicepublicprice, services.ID_services FROM services WHERE {$NXTFilter_rsservices1} ORDER BY {$NXTSort_rsservices1}";
$query_limit_rsservices1 = sprintf("%s LIMIT %d, %d", $query_rsservices1, $startRow_rsservices1, $maxRows_rsservices1);
$rsservices1 = mysql_query($query_limit_rsservices1, $cnn_teamdnt) or die(mysql_error());
$row_rsservices1 = mysql_fetch_assoc($rsservices1);

if (isset($_GET['totalRows_rsservices1'])) {
  $totalRows_rsservices1 = $_GET['totalRows_rsservices1'];
} else {
  $all_rsservices1 = mysql_query($query_rsservices1);
  $totalRows_rsservices1 = mysql_num_rows($all_rsservices1);
}
$totalPages_rsservices1 = ceil($totalRows_rsservices1/$maxRows_rsservices1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listservices1->checkBoundries();
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
  .KT_col_servicecode {width:100%; overflow:hidden;}
  .KT_col_servicename {width:100%; overflow:hidden;}
  .KT_col_servicepublicprice {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listservices1">
          <h1><i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;&nbsp; SERVICE MANAGEMENT
            <?php
  $nav_listservices1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listservices1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listservices1'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listservices1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listservices1'] == 1) {
?>
                  <a href="<?php echo $tfi_listservices1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listservices1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="servicecode" class="KT_sorter KT_col_servicecode <?php echo $tso_listservices1->getSortIcon('services.servicecode'); ?>"> <a href="<?php echo $tso_listservices1->getSortLink('services.servicecode'); ?>">Code</a> </th>
                    <th id="servicename" class="KT_sorter KT_col_servicename <?php echo $tso_listservices1->getSortIcon('services.servicename'); ?>"> <a href="<?php echo $tso_listservices1->getSortLink('services.servicename'); ?>">Service</a> </th>
                    <th id="servicepublicprice" class="KT_sorter KT_col_servicepublicprice <?php echo $tso_listservices1->getSortIcon('services.servicepublicprice'); ?>"> <a href="<?php echo $tso_listservices1->getSortLink('services.servicepublicprice'); ?>">Price</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listservices1'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listservices1_servicecode" id="tfi_listservices1_servicecode" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices1_servicecode']); ?>" size="20" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listservices1_servicename" id="tfi_listservices1_servicename" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices1_servicename']); ?>" size="20" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listservices1_servicepublicprice" id="tfi_listservices1_servicepublicprice" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listservices1_servicepublicprice']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="submit" name="tfi_listservices1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsservices1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsservices1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_services" class="id_checkbox" value="<?php echo $row_rsservices1['ID_services']; ?>" />
                          <input type="hidden" name="ID_services" class="id_field" value="<?php echo $row_rsservices1['ID_services']; ?>" /></td>
                        <td><div class="KT_col_servicecode"><?php echo KT_FormatForList($row_rsservices1['servicecode'], 36); ?></div></td>
                        <td><div class="KT_col_servicename"><?php echo KT_FormatForList($row_rsservices1['servicename'], 68); ?></div></td>
                        <td><div class="KT_col_servicepublicprice"><?php echo KT_FormatForList($row_rsservices1['servicepublicprice'], 36); ?></div></td>
                        <td><a class="KT_edit_link" href="form_service.php?ID_services=<?php echo $row_rsservices1['ID_services']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsservices1 = mysql_fetch_assoc($rsservices1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listservices1->Prepare();
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
                <a class="KT_additem_op_link" href="form_service.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rsservices1);
?>