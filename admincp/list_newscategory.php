<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the required classes
require_once('../includes/tor/TOR.php');
require_once('../includes/tfi/TFI.php');
require_once('../includes/tso/TSO.php');
require_once('../includes/nav/NAV.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

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
$tor_listnewscategory2 = new TOR_SetOrder($conn_cnn_teamdnt, 'newscategory', 'ID_newscategory', 'NUMERIC_TYPE', 'newscategoryorderlist', 'listnewscategory2_newscategoryorderlist_order');
$tor_listnewscategory2->Execute();

// Filter
$tfi_listnewscategory2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listnewscategory2");
$tfi_listnewscategory2->addColumn("newscategory.newscategoryname", "STRING_TYPE", "newscategoryname", "%");
$tfi_listnewscategory2->addColumn("newscategory.newscategoryvisible", "CHECKBOX_1_0_TYPE", "newscategoryvisible", "%");
$tfi_listnewscategory2->Execute();

// Sorter
$tso_listnewscategory2 = new TSO_TableSorter("rsnewscategory1", "tso_listnewscategory2");
$tso_listnewscategory2->addColumn("newscategory.newscategoryorderlist"); // Order column
$tso_listnewscategory2->setDefault("newscategory.newscategoryorderlist");
$tso_listnewscategory2->Execute();

// Navigation
$nav_listnewscategory2 = new NAV_Regular("nav_listnewscategory2", "rsnewscategory1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rsnewscategory1 = $_SESSION['max_rows_nav_listnewscategory2'];
$pageNum_rsnewscategory1 = 0;
if (isset($_GET['pageNum_rsnewscategory1'])) {
  $pageNum_rsnewscategory1 = $_GET['pageNum_rsnewscategory1'];
}
$startRow_rsnewscategory1 = $pageNum_rsnewscategory1 * $maxRows_rsnewscategory1;

// Defining List Recordset variable
$NXTFilter_rsnewscategory1 = "1=1";
if (isset($_SESSION['filter_tfi_listnewscategory2'])) {
  $NXTFilter_rsnewscategory1 = $_SESSION['filter_tfi_listnewscategory2'];
}
// Defining List Recordset variable
$NXTSort_rsnewscategory1 = "newscategory.newscategoryorderlist";
if (isset($_SESSION['sorter_tso_listnewscategory2'])) {
  $NXTSort_rsnewscategory1 = $_SESSION['sorter_tso_listnewscategory2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsnewscategory1 = "SELECT newscategory.newscategoryname, newscategory.newscategoryvisible, newscategory.ID_newscategory, newscategory.newscategoryorderlist FROM newscategory WHERE {$NXTFilter_rsnewscategory1} ORDER BY {$NXTSort_rsnewscategory1}";
$query_limit_rsnewscategory1 = sprintf("%s LIMIT %d, %d", $query_rsnewscategory1, $startRow_rsnewscategory1, $maxRows_rsnewscategory1);
$rsnewscategory1 = mysql_query($query_limit_rsnewscategory1, $cnn_teamdnt) or die(mysql_error());
$row_rsnewscategory1 = mysql_fetch_assoc($rsnewscategory1);

if (isset($_GET['totalRows_rsnewscategory1'])) {
  $totalRows_rsnewscategory1 = $_GET['totalRows_rsnewscategory1'];
} else {
  $all_rsnewscategory1 = mysql_query($query_rsnewscategory1);
  $totalRows_rsnewscategory1 = mysql_num_rows($all_rsnewscategory1);
}
$totalPages_rsnewscategory1 = ceil($totalRows_rsnewscategory1/$maxRows_rsnewscategory1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listnewscategory2->checkBoundries();
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
  .KT_col_newscategoryname {width:100%; overflow:hidden;}
  .KT_col_newscategoryvisible {width:100%; overflow:hidden;}
</style>
<?php echo $tor_listnewscategory2->scriptDefinition(); ?>
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
        <div class="KT_tng" id="listnewscategory2">
          <h1><i class="fa fa-tags" aria-hidden="true"></i>&nbsp;&nbsp; NEWS CATEGORY MANAGEMENT
            <?php
  $nav_listnewscategory2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listnewscategory2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listnewscategory2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listnewscategory2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listnewscategory2'] == 1) {
?>
                  <a href="<?php echo $tfi_listnewscategory2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listnewscategory2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="newscategoryname" class="KT_col_newscategoryname">Category</th>
                    <th id="newscategoryvisible" class="KT_col_newscategoryvisible">Visible</th>
                    <th id="newscategoryorderlist" class="KT_sorter <?php echo $tso_listnewscategory2->getSortIcon('newscategory.newscategoryorderlist'); ?> KT_order"> <a href="<?php echo $tso_listnewscategory2->getSortLink('newscategory.newscategoryorderlist'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onclick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listnewscategory2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listnewscategory2_newscategoryname" id="tfi_listnewscategory2_newscategoryname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listnewscategory2_newscategoryname']); ?>" size="36" maxlength="68" /></td>
                      <td><input  <?php if (!(strcmp(KT_escapeAttribute(@$_SESSION['tfi_listnewscategory2_newscategoryvisible']),"1"))) {echo "checked";} ?> type="checkbox" name="tfi_listnewscategory2_newscategoryvisible" id="tfi_listnewscategory2_newscategoryvisible" value="1" /></td>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="tfi_listnewscategory2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsnewscategory1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="5"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsnewscategory1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_newscategory" class="id_checkbox" value="<?php echo $row_rsnewscategory1['ID_newscategory']; ?>" />
                          <input type="hidden" name="ID_newscategory" class="id_field" value="<?php echo $row_rsnewscategory1['ID_newscategory']; ?>" /></td>
                        <td><div class="KT_col_newscategoryname"><?php echo KT_FormatForList($row_rsnewscategory1['newscategoryname'], 36); ?></div></td>
                        <td><?php 
							// Show IF Conditional region4 
							if (@$row_rsnewscategory1['newscategoryvisible'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region4
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
							  <?php } 
							// endif Conditional region4
							?></td>
                        <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listnewscategory2->getOrderFieldName() ?>" value="<?php echo $tor_listnewscategory2->getOrderFieldValue($row_rsnewscategory1) ?>" />
                        <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a></td>
<td><a class="KT_edit_link" href="form_newscategory.php?ID_newscategory=<?php echo $row_rsnewscategory1['ID_newscategory']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsnewscategory1 = mysql_fetch_assoc($rsnewscategory1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listnewscategory2->Prepare();
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
                <a class="KT_additem_op_link" href="form_newscategory.php?KT_back=1" onclick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rsnewscategory1);
?>