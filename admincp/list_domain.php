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
$tfi_list_domain_2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_list_domain_2");
$tfi_list_domain_2->addColumn("`domain`.domainname", "STRING_TYPE", "domainname", "%");
$tfi_list_domain_2->addColumn("supplier.ID_supplier", "NUMERIC_TYPE", "ID_supplier", "=");
$tfi_list_domain_2->addColumn("domainaccount.ID_domainaccount", "NUMERIC_TYPE", "ID_domainaccount", "=");
$tfi_list_domain_2->addColumn("`domain`.domainlocation", "NUMERIC_TYPE", "domainlocation", "=");
$tfi_list_domain_2->addColumn("`domain`.domainexpirydate", "DATE_TYPE", "domainexpirydate", "=");
$tfi_list_domain_2->Execute();

// Sorter
$tso_list_domain_2 = new TSO_TableSorter("rs_domain_1", "tso_list_domain_2");
$tso_list_domain_2->addColumn("`domain`.domainname");
$tso_list_domain_2->addColumn("supplier.suppliername");
$tso_list_domain_2->addColumn("domainaccount.domainusername");
$tso_list_domain_2->addColumn("`domain`.domainlocation");
$tso_list_domain_2->addColumn("`domain`.domainexpirydate");
$tso_list_domain_2->setDefault("`domain`.domainexpirydate");
$tso_list_domain_2->Execute();

// Navigation
$nav_list_domain_2 = new NAV_Regular("nav_list_domain_2", "rs_domain_1", "../", $_SERVER['PHP_SELF'], 28);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT domainusername, ID_domainaccount FROM domainaccount ORDER BY domainusername";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortsupplier = "SELECT ID_supplier, suppliername FROM supplier ORDER BY suppliername ASC";
$rs_sortsupplier = mysql_query($query_rs_sortsupplier, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
$totalRows_rs_sortsupplier = mysql_num_rows($rs_sortsupplier);

//NeXTenesio3 Special List Recordset
$maxRows_rs_domain_1 = $_SESSION['max_rows_nav_list_domain_2'];
$pageNum_rs_domain_1 = 0;
if (isset($_GET['pageNum_rs_domain_1'])) {
  $pageNum_rs_domain_1 = $_GET['pageNum_rs_domain_1'];
}
$startRow_rs_domain_1 = $pageNum_rs_domain_1 * $maxRows_rs_domain_1;

// Defining List Recordset variable
$NXTFilter_rs_domain_1 = "1=1";
if (isset($_SESSION['filter_tfi_list_domain_2'])) {
  $NXTFilter_rs_domain_1 = $_SESSION['filter_tfi_list_domain_2'];
}
// Defining List Recordset variable
$NXTSort_rs_domain_1 = "`domain`.domainexpirydate";
if (isset($_SESSION['sorter_tso_list_domain_2'])) {
  $NXTSort_rs_domain_1 = $_SESSION['sorter_tso_list_domain_2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rs_domain_1 = "SELECT `domain`.domainname, supplier.suppliername AS ID_supplier, domainaccount.domainusername AS ID_domainaccount, `domain`.domainlocation, `domain`.domainexpirydate, `domain`.ID_domain FROM (`domain` LEFT JOIN supplier ON `domain`.ID_supplier = supplier.ID_supplier) LEFT JOIN domainaccount ON `domain`.ID_domainaccount = domainaccount.ID_domainaccount WHERE {$NXTFilter_rs_domain_1} ORDER BY {$NXTSort_rs_domain_1}";
$query_limit_rs_domain_1 = sprintf("%s LIMIT %d, %d", $query_rs_domain_1, $startRow_rs_domain_1, $maxRows_rs_domain_1);
$rs_domain_1 = mysql_query($query_limit_rs_domain_1, $cnn_teamdnt) or die(mysql_error());
$row_rs_domain_1 = mysql_fetch_assoc($rs_domain_1);

if (isset($_GET['totalRows_rs_domain_1'])) {
  $totalRows_rs_domain_1 = $_GET['totalRows_rs_domain_1'];
} else {
  $all_rs_domain_1 = mysql_query($query_rs_domain_1);
  $totalRows_rs_domain_1 = mysql_num_rows($all_rs_domain_1);
}
$totalPages_rs_domain_1 = ceil($totalRows_rs_domain_1/$maxRows_rs_domain_1)-1;
//End NeXTenesio3 Special List Recordset

$nav_list_domain_2->checkBoundries();
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
  .KT_col_domainname {width:100%; overflow:hidden;}
  .KT_col_ID_supplier {width:100%; overflow:hidden;}
  .KT_col_ID_domainaccount {width:100%; overflow:hidden;}
  .KT_col_domainlocation {width:100%; overflow:hidden;}
  .KT_col_domainexpirydate {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="list_domain_2">
          <h1><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;&nbsp; DOMAIN MANAGEMENT
            <?php
  $nav_list_domain_2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_list_domain_2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_list_domain_2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_list_domain_2']; ?>
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
  if (@$_SESSION['has_filter_tfi_list_domain_2'] == 1) {
?>
                  <a href="<?php echo $tfi_list_domain_2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_list_domain_2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="domainname" class="KT_sorter KT_col_domainname <?php echo $tso_list_domain_2->getSortIcon('`domain`.domainname'); ?>"> <a href="<?php echo $tso_list_domain_2->getSortLink('`domain`.domainname'); ?>">Domain</a> </th>
                    <th id="ID_supplier" class="KT_sorter KT_col_ID_supplier <?php echo $tso_list_domain_2->getSortIcon('supplier.suppliername'); ?>"> <a href="<?php echo $tso_list_domain_2->getSortLink('supplier.suppliername'); ?>">Supplier</a> </th>
                    <th id="ID_domainaccount" class="KT_sorter KT_col_ID_domainaccount <?php echo $tso_list_domain_2->getSortIcon('domainaccount.domainusername'); ?>"> <a href="<?php echo $tso_list_domain_2->getSortLink('domainaccount.domainusername'); ?>">Account</a> </th>
                    <th id="domainlocation" class="KT_sorter KT_col_domainlocation <?php echo $tso_list_domain_2->getSortIcon('`domain`.domainlocation'); ?>"> <a href="<?php echo $tso_list_domain_2->getSortLink('`domain`.domainlocation'); ?>">Location</a> </th>
                    <th id="domainexpirydate" class="KT_sorter KT_col_domainexpirydate <?php echo $tso_list_domain_2->getSortIcon('`domain`.domainexpirydate'); ?>"> <a href="<?php echo $tso_list_domain_2->getSortLink('`domain`.domainexpirydate'); ?>">Expiry Date</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_list_domain_2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_list_domain_2_domainname" id="tfi_list_domain_2_domainname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_list_domain_2_domainname']); ?>" size="36" maxlength="68" /></td>
                      <td><select name="tfi_list_domain_2_ID_supplier" id="tfi_list_domain_2_ID_supplier">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_list_domain_2_ID_supplier']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortsupplier['ID_supplier']?>"<?php if (!(strcmp($row_rs_sortsupplier['ID_supplier'], @$_SESSION['tfi_list_domain_2_ID_supplier']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortsupplier['suppliername']?></option>
                        <?php
} while ($row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier));
  $rows = mysql_num_rows($rs_sortsupplier);
  if($rows > 0) {
      mysql_data_seek($rs_sortsupplier, 0);
	  $row_rs_sortsupplier = mysql_fetch_assoc($rs_sortsupplier);
  }
?>
                      </select></td>
                      <td><select name="tfi_list_domain_2_ID_domainaccount" id="tfi_list_domain_2_ID_domainaccount">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_list_domain_2_ID_domainaccount']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset1['ID_domainaccount']?>"<?php if (!(strcmp($row_Recordset1['ID_domainaccount'], @$_SESSION['tfi_list_domain_2_ID_domainaccount']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['domainusername']?></option>
                        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_list_domain_2_domainlocation" id="tfi_list_domain_2_domainlocation" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_list_domain_2_domainlocation']); ?>" size="26" maxlength="100" /></td>
                      <td><input type="text" name="tfi_list_domain_2_domainexpirydate" id="tfi_list_domain_2_domainexpirydate" value="<?php echo @$_SESSION['tfi_list_domain_2_domainexpirydate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="submit" name="tfi_list_domain_2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rs_domain_1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rs_domain_1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk__domain_" class="id_checkbox" value="<?php echo $row_rs_domain_1['ID_domain']; ?>" />
                          <input type="hidden" name="ID_domain" class="id_field" value="<?php echo $row_rs_domain_1['ID_domain']; ?>" /></td>
                        <td><div class="KT_col_domainname"><?php echo KT_FormatForList($row_rs_domain_1['domainname'], 36); ?></div></td>
                        <td><div class="KT_col_ID_supplier"><?php echo KT_FormatForList($row_rs_domain_1['ID_supplier'], 36); ?></div></td>
                        <td><div class="KT_col_ID_domainaccount"><?php echo KT_FormatForList($row_rs_domain_1['ID_domainaccount'], 36); ?></div></td>
                        <td><div class="KT_col_domainlocation">
                          <?php 
// Show IF Conditional region4 
if (@$row_rs_domain_1['domainlocation'] == 1) {
?>
                            Vietnam
                            <?php 
// else Conditional region4
} if (@$row_rs_domain_1['domainlocation'] == 2) { ?>
                            America
                            <?php 
// else Conditional region4
} if (@$row_rs_domain_1['domainlocation'] == 3) { ?>
							Australia
                             <?php 
// else Conditional region4
} if (@$row_rs_domain_1['domainlocation'] == 4) { ?>
							England
  <?php } 
// endif Conditional region4
?>
                        </div></td>
                        <td><div class="KT_col_domainexpirydate"><?php echo KT_formatDate($row_rs_domain_1['domainexpirydate']); ?></div></td>
<td><a class="KT_edit_link" href="form_domain.php?ID_domain=<?php echo $row_rs_domain_1['ID_domain']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rs_domain_1 = mysql_fetch_assoc($rs_domain_1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_list_domain_2->Prepare();
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
                <a class="KT_additem_op_link" href="form_domain.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rs_sortsupplier);
mysql_free_result($rs_domain_1);
?>