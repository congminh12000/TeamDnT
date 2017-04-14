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
$tfi_listcustomer2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listcustomer2");
$tfi_listcustomer2->addColumn("customer.customergender", "NUMERIC_TYPE", "customergender", "=");
$tfi_listcustomer2->addColumn("customer.customerfullname", "STRING_TYPE", "customerfullname", "%");
$tfi_listcustomer2->addColumn("customer.customergroup", "NUMERIC_TYPE", "customergroup", "=");
$tfi_listcustomer2->addColumn("customer.customeremail", "STRING_TYPE", "customeremail", "%");
$tfi_listcustomer2->addColumn("customer.customerphonenumber", "STRING_TYPE", "customerphonenumber", "%");
$tfi_listcustomer2->addColumn("customer.customerstatus", "NUMERIC_TYPE", "customerstatus", "=");
$tfi_listcustomer2->Execute();

// Sorter
$tso_listcustomer2 = new TSO_TableSorter("rscustomer1", "tso_listcustomer2");
$tso_listcustomer2->addColumn("customer.customergender");
$tso_listcustomer2->addColumn("customer.customerfullname");
$tso_listcustomer2->addColumn("customer.customergroup");
$tso_listcustomer2->addColumn("customer.customeremail");
$tso_listcustomer2->addColumn("customer.customerphonenumber");
$tso_listcustomer2->addColumn("customer.customerstatus");
$tso_listcustomer2->setDefault("customer.customerstatus DESC");
$tso_listcustomer2->Execute();

// Navigation
$nav_listcustomer2 = new NAV_Regular("nav_listcustomer2", "rscustomer1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rscustomer1 = $_SESSION['max_rows_nav_listcustomer2'];
$pageNum_rscustomer1 = 0;
if (isset($_GET['pageNum_rscustomer1'])) {
  $pageNum_rscustomer1 = $_GET['pageNum_rscustomer1'];
}
$startRow_rscustomer1 = $pageNum_rscustomer1 * $maxRows_rscustomer1;

// Defining List Recordset variable
$NXTFilter_rscustomer1 = "1=1";
if (isset($_SESSION['filter_tfi_listcustomer2'])) {
  $NXTFilter_rscustomer1 = $_SESSION['filter_tfi_listcustomer2'];
}
// Defining List Recordset variable
$NXTSort_rscustomer1 = "customer.customerstatus DESC";
if (isset($_SESSION['sorter_tso_listcustomer2'])) {
  $NXTSort_rscustomer1 = $_SESSION['sorter_tso_listcustomer2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rscustomer1 = "SELECT customer.customergender, customer.customerfullname, customer.customergroup, customer.customeremail, customer.customerphonenumber, customer.customerstatus, customer.ID_customer FROM customer WHERE {$NXTFilter_rscustomer1} ORDER BY {$NXTSort_rscustomer1}";
$query_limit_rscustomer1 = sprintf("%s LIMIT %d, %d", $query_rscustomer1, $startRow_rscustomer1, $maxRows_rscustomer1);
$rscustomer1 = mysql_query($query_limit_rscustomer1, $cnn_teamdnt) or die(mysql_error());
$row_rscustomer1 = mysql_fetch_assoc($rscustomer1);

if (isset($_GET['totalRows_rscustomer1'])) {
  $totalRows_rscustomer1 = $_GET['totalRows_rscustomer1'];
} else {
  $all_rscustomer1 = mysql_query($query_rscustomer1);
  $totalRows_rscustomer1 = mysql_num_rows($all_rscustomer1);
}
$totalPages_rscustomer1 = ceil($totalRows_rscustomer1/$maxRows_rscustomer1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcustomer2->checkBoundries();
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
  .KT_col_customergender {width:100%; overflow:hidden;}
  .KT_col_customerfullname {width:100%; overflow:hidden;}
  .KT_col_customergroup {width:100%; overflow:hidden;}
  .KT_col_customeremail {width:100%; overflow:hidden;}
  .KT_col_customerphonenumber {width:100%; overflow:hidden;}
  .KT_col_customerstatus {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listcustomer2">
          <h1><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp; CUSTOMER MANAGEMENT
            <?php
  $nav_listcustomer2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listcustomer2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcustomer2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listcustomer2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcustomer2'] == 1) {
?>
                  <a href="<?php echo $tfi_listcustomer2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listcustomer2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="customergender" class="KT_sorter KT_col_customergender <?php echo $tso_listcustomer2->getSortIcon('customer.customergender'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customergender'); ?>">Gender</a> </th>
                    <th id="customerfullname" class="KT_sorter KT_col_customerfullname <?php echo $tso_listcustomer2->getSortIcon('customer.customerfullname'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customerfullname'); ?>">Full name</a> </th>
                    <th id="customergroup" class="KT_sorter KT_col_customergroup <?php echo $tso_listcustomer2->getSortIcon('customer.customergroup'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customergroup'); ?>">Group</a> </th>
                    <th id="customeremail" class="KT_sorter KT_col_customeremail <?php echo $tso_listcustomer2->getSortIcon('customer.customeremail'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customeremail'); ?>">Email</a> </th>
                    <th id="customerphonenumber" class="KT_sorter KT_col_customerphonenumber <?php echo $tso_listcustomer2->getSortIcon('customer.customerphonenumber'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customerphonenumber'); ?>">Phone</a> </th>
                    <th id="customerstatus" class="KT_sorter KT_col_customerstatus <?php echo $tso_listcustomer2->getSortIcon('customer.customerstatus'); ?>"> <a href="<?php echo $tso_listcustomer2->getSortLink('customer.customerstatus'); ?>">Status</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcustomer2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><select name="tfi_listcustomer2_customergender" id="tfi_listcustomer2_customergender">
                        <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customergender'])))) {echo "SELECTED";} ?>>Male</option>
                        <option value="0" <?php if (!(strcmp(0, KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customergender'])))) {echo "SELECTED";} ?>>Female</option>
                      </select></td>
                      <td><input type="text" name="tfi_listcustomer2_customerfullname" id="tfi_listcustomer2_customerfullname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customerfullname']); ?>" size="36" maxlength="68" /></td>
                      <td><select name="tfi_listcustomer2_customergroup" id="tfi_listcustomer2_customergroup">
                        <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customergroup'])))) {echo "SELECTED";} ?>>Company</option>
                        <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customergroup'])))) {echo "SELECTED";} ?>>Individual</option>
                      </select></td>
                      <td><input type="text" name="tfi_listcustomer2_customeremail" id="tfi_listcustomer2_customeremail" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customeremail']); ?>" size="48" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listcustomer2_customerphonenumber" id="tfi_listcustomer2_customerphonenumber" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customerphonenumber']); ?>" size="20" maxlength="16" /></td>
                      <td><input type="text" name="tfi_listcustomer2_customerstatus" id="tfi_listcustomer2_customerstatus" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcustomer2_customerstatus']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="submit" name="tfi_listcustomer2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rscustomer1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="8"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rscustomer1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_customer" class="id_checkbox" value="<?php echo $row_rscustomer1['ID_customer']; ?>" />
                          <input type="hidden" name="ID_customer" class="id_field" value="<?php echo $row_rscustomer1['ID_customer']; ?>" /></td>
                        <td><?php 
// Show IF Conditional region5 
if (@$row_rscustomer1['customergender'] == 1) {
?>
                            <img src="../images/icon-male.png" width="28" height="28">
                            <?php 
// else Conditional region5
} else { ?>
                            <img src="../images/icon-female.png" width="28" height="28">
  <?php } 
// endif Conditional region5
?></td>
                        <td><div class="KT_col_customerfullname"><?php echo KT_FormatForList($row_rscustomer1['customerfullname'], 12); ?></div></td>
                        <td><?php 
							// Show IF Conditional region6 
							if (@$row_rscustomer1['customergroup'] == 1) {
							?>
														Company
														<?php 
							// else Conditional region6
							} else { ?>
														Individual
							  <?php } 
							// endif Conditional region6
							?></td>
                        <td><div class="KT_col_customeremail"><?php echo KT_FormatForList($row_rscustomer1['customeremail'], 12); ?></div></td>
                        <td><div class="KT_col_customerphonenumber"><?php echo KT_FormatForList($row_rscustomer1['customerphonenumber'], 20); ?></div></td>
                        <td><div class="KT_col_customerstatus">
                          <?php 
							// Show IF Conditional region4 
							if (@$row_rscustomer1['customerstatus'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region4
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
							  <?php } 
							// endif Conditional region4
							?>
                        </div></td>
<td><a class="KT_edit_link" href="form_customer.php?ID_customer=<?php echo $row_rscustomer1['ID_customer']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rscustomer1 = mysql_fetch_assoc($rscustomer1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listcustomer2->Prepare();
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
                <a class="KT_additem_op_link" href="form_customer.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rscustomer1);
?>