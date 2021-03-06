<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');
 session_start();?>
<?php
// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Load the required classes
require_once('../includes/tor/TOR.php');
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

// Order
$tor_listdomainaccount2 = new TOR_SetOrder($conn_cnn_teamdnt, 'domainaccount', 'ID_domainaccount', 'NUMERIC_TYPE', 'domainaccountorderlist', 'listdomainaccount2_domainaccountorderlist_order');
$tor_listdomainaccount2->Execute();

// Filter
$tfi_listdomainaccount2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listdomainaccount2");
$tfi_listdomainaccount2->addColumn("customer.ID_customer", "NUMERIC_TYPE", "ID_customer", "=");
$tfi_listdomainaccount2->addColumn("domainaccount.domainusername", "STRING_TYPE", "domainusername", "%");
$tfi_listdomainaccount2->addColumn("domainaccount.domainpassword", "STRING_TYPE", "domainpassword", "%");
$tfi_listdomainaccount2->addColumn("supplier.ID_supplier", "NUMERIC_TYPE", "ID_supplier", "=");
$tfi_listdomainaccount2->Execute();

// Sorter
$tso_listdomainaccount2 = new TSO_TableSorter("rsdomainaccount1", "tso_listdomainaccount2");
$tso_listdomainaccount2->addColumn("domainaccount.domainaccountorderlist"); // Order column
$tso_listdomainaccount2->setDefault("domainaccount.domainaccountorderlist");
$tso_listdomainaccount2->Execute();

// Navigation
$nav_listdomainaccount2 = new NAV_Regular("nav_listdomainaccount2", "rsdomainaccount1", "../", $_SERVER['PHP_SELF'], 10);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortcustomer = "SELECT ID_customer, customerfullname FROM customer ORDER BY customerfullname ASC";
$rs_sortcustomer = mysql_query($query_rs_sortcustomer, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
$totalRows_rs_sortcustomer = mysql_num_rows($rs_sortcustomer);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortsupplier = "SELECT ID_supplier, suppliername FROM supplier ORDER BY suppliername ASC";
$rs_sortsupplier = mysql_query($query_rs_sortsupplier, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
$totalRows_rs_sortsupplier = mysql_num_rows($rs_sortsupplier);

//NeXTenesio3 Special List Recordset
$maxRows_rsdomainaccount1 = $_SESSION['max_rows_nav_listdomainaccount2'];
$pageNum_rsdomainaccount1 = 0;
if (isset($_GET['pageNum_rsdomainaccount1'])) {
  $pageNum_rsdomainaccount1 = $_GET['pageNum_rsdomainaccount1'];
}
$startRow_rsdomainaccount1 = $pageNum_rsdomainaccount1 * $maxRows_rsdomainaccount1;

// Defining List Recordset variable
$NXTFilter_rsdomainaccount1 = "1=1";
if (isset($_SESSION['filter_tfi_listdomainaccount2'])) {
  $NXTFilter_rsdomainaccount1 = $_SESSION['filter_tfi_listdomainaccount2'];
}
// Defining List Recordset variable
$NXTSort_rsdomainaccount1 = "domainaccount.domainaccountorderlist";
if (isset($_SESSION['sorter_tso_listdomainaccount2'])) {
  $NXTSort_rsdomainaccount1 = $_SESSION['sorter_tso_listdomainaccount2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsdomainaccount1 = "SELECT customer.customerfullname AS ID_customer, domainaccount.domainusername, domainaccount.domainpassword, supplier.suppliername AS ID_supplier, domainaccount.ID_domainaccount, domainaccount.domainaccountorderlist FROM (domainaccount LEFT JOIN customer ON domainaccount.ID_customer = customer.ID_customer) LEFT JOIN supplier ON domainaccount.ID_supplier = supplier.ID_supplier WHERE {$NXTFilter_rsdomainaccount1} ORDER BY {$NXTSort_rsdomainaccount1}";
$query_limit_rsdomainaccount1 = sprintf("%s LIMIT %d, %d", $query_rsdomainaccount1, $startRow_rsdomainaccount1, $maxRows_rsdomainaccount1);
$rsdomainaccount1 = mysql_query($query_limit_rsdomainaccount1, $cnn_teamdnt) or die(mysql_error());
$row_rsdomainaccount1 = mysql_fetch_assoc($rsdomainaccount1);

if (isset($_GET['totalRows_rsdomainaccount1'])) {
  $totalRows_rsdomainaccount1 = $_GET['totalRows_rsdomainaccount1'];
} else {
  $all_rsdomainaccount1 = mysql_query($query_rsdomainaccount1);
  $totalRows_rsdomainaccount1 = mysql_num_rows($all_rsdomainaccount1);
}
$totalPages_rsdomainaccount1 = ceil($totalRows_rsdomainaccount1/$maxRows_rsdomainaccount1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listdomainaccount2->checkBoundries();
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
  .KT_col_ID_customer {width:100%; overflow:hidden;}
  .KT_col_domainusername {width:100%; overflow:hidden;}
  .KT_col_domainpassword {width:100%; overflow:hidden;}
  .KT_col_ID_supplier {width:100%; overflow:hidden;}
</style>
<?php echo $tor_listdomainaccount2->scriptDefinition(); ?>
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
        <div class="KT_tng" id="listdomainaccount2">
          <h1> <i class="fa fa-ticket" aria-hidden="true"></i> DOMAIN ACCOUNT MANAGEMENT
            <?php
			  $nav_listdomainaccount2->Prepare();
			  require("../includes/nav/NAV_Text_Statistics.inc.php");
			?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listdomainaccount2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listdomainaccount2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listdomainaccount2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listdomainaccount2'] == 1) {
?>
                  <a href="<?php echo $tfi_listdomainaccount2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listdomainaccount2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="ID_customer" class="KT_col_ID_customer">Customer</th>
                    <th id="domainusername" class="KT_col_domainusername">Username</th>
                    <th id="domainpassword" class="KT_col_domainpassword">Password</th>
                    <th id="ID_supplier" class="KT_col_ID_supplier">Supplier</th>
                    <th id="domainaccountorderlist" class="KT_sorter <?php echo $tso_listdomainaccount2->getSortIcon('domainaccount.domainaccountorderlist'); ?> KT_order"> <a href="<?php echo $tso_listdomainaccount2->getSortLink('domainaccount.domainaccountorderlist'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listdomainaccount2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><select name="tfi_listdomainaccount2_ID_customer" id="tfi_listdomainaccount2_ID_customer">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listdomainaccount2_ID_customer']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortcustomer['ID_customer']?>"<?php if (!(strcmp($row_rs_sortcustomer['ID_customer'], @$_SESSION['tfi_listdomainaccount2_ID_customer']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortcustomer['customerfullname']?></option>
                        <?php
} while ($row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer));
  $rows = mysql_num_rows($rs_sortcustomer);
  if($rows > 0) {
      mysql_data_seek($rs_sortcustomer, 0);
	  $row_rs_sortcustomer = mysql_fetch_assoc($rs_sortcustomer);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listdomainaccount2_domainusername" id="tfi_listdomainaccount2_domainusername" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listdomainaccount2_domainusername']); ?>" size="20" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listdomainaccount2_domainpassword" id="tfi_listdomainaccount2_domainpassword" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listdomainaccount2_domainpassword']); ?>" size="20" maxlength="68" /></td>
                      <td><select name="tfi_listdomainaccount2_ID_supplier" id="tfi_listdomainaccount2_ID_supplier">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listdomainaccount2_ID_supplier']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortsupplier['ID_supplier']?>"<?php if (!(strcmp($row_rs_sortsupplier['ID_supplier'], @$_SESSION['tfi_listdomainaccount2_ID_supplier']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortsupplier['suppliername']?></option>
                        <?php
} while ($row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier));
  $rows = mysql_num_rows($rs_sortsupplier);
  if($rows > 0) {
      mysql_data_seek($rs_sortsupplier, 0);
	  $row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
  }
?>
                      </select></td>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="tfi_listdomainaccount2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsdomainaccount1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsdomainaccount1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_domainaccount" class="id_checkbox" value="<?php echo $row_rsdomainaccount1['ID_domainaccount']; ?>" />
                          <input type="hidden" name="ID_domainaccount" class="id_field" value="<?php echo $row_rsdomainaccount1['ID_domainaccount']; ?>" /></td>
                        <td><div class="KT_col_ID_customer"><?php echo KT_FormatForList($row_rsdomainaccount1['ID_customer'], 18); ?></div></td>
                        <td><div class="KT_col_domainusername"><?php echo KT_FormatForList($row_rsdomainaccount1['domainusername'], 26); ?></div></td>
                        <td><div class="KT_col_domainpassword"><?php echo KT_FormatForList($row_rsdomainaccount1['domainpassword'], 26); ?></div></td>
                        <td><div class="KT_col_ID_supplier"><?php echo KT_FormatForList($row_rsdomainaccount1['ID_supplier'], 20); ?></div></td>
                        <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listdomainaccount2->getOrderFieldName() ?>" value="<?php echo $tor_listdomainaccount2->getOrderFieldValue($row_rsdomainaccount1) ?>" />
                          <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a></td>
                        <td><a class="KT_edit_link" href="form_domainaccount.php?ID_domainaccount=<?php echo $row_rsdomainaccount1['ID_domainaccount']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsdomainaccount1 = mysql_fetch_assoc($rsdomainaccount1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
					$nav_listdomainaccount2->Prepare();
					require("../includes/nav/NAV_Text_Navigation.inc.php");
				  ?>
                </div>
              </div>
              <div class="KT_bottombuttons">
                <div class="KT_operations"> <a class="KT_edit_op_link" href="#" onclick="nxt_list_edit_link_form(this); return false;"><?php echo NXT_getResource("edit_all"); ?></a> <a class="KT_delete_op_link" href="#" onclick="nxt_list_delete_link_form(this); return false;"><?php echo NXT_getResource("delete_all"); ?></a> </div>
                <span>&nbsp;</span>
                <select name="no_new" id="no_new">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
                <a class="KT_additem_op_link" href="form_domainaccount.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rs_sortcustomer);
mysql_free_result($rs_sortsupplier);
mysql_free_result($rsdomainaccount1);
?>