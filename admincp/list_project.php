<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

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
$tor_listproject1 = new TOR_SetOrder($conn_cnn_teamdnt, 'project', 'ID_project', 'NUMERIC_TYPE', 'projectorderlist', 'listproject1_projectorderlist_order');
$tor_listproject1->Execute();

// Filter
$tfi_listproject1 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listproject1");
$tfi_listproject1->addColumn("project.projectname", "STRING_TYPE", "projectname", "%");
$tfi_listproject1->addColumn("customer.ID_customer", "NUMERIC_TYPE", "ID_customer", "=");
$tfi_listproject1->addColumn("project.webdesign", "NUMERIC_TYPE", "webdesign", "=");
$tfi_listproject1->addColumn("project.graphicdesign", "NUMERIC_TYPE", "graphicdesign", "=");
$tfi_listproject1->addColumn("project.hosting", "NUMERIC_TYPE", "hosting", "=");
$tfi_listproject1->addColumn("project.emailhosting", "NUMERIC_TYPE", "emailhosting", "=");
$tfi_listproject1->addColumn("project.startdate", "DATE_TYPE", "startdate", "=");
$tfi_listproject1->addColumn("project.enddate", "DATE_TYPE", "enddate", "=");
$tfi_listproject1->Execute();

// Sorter
$tso_listproject1 = new TSO_TableSorter("rsproject1", "tso_listproject1");
$tso_listproject1->addColumn("project.projectorderlist"); // Order column
$tso_listproject1->setDefault("project.projectorderlist");
$tso_listproject1->Execute();

// Navigation
$nav_listproject1 = new NAV_Regular("nav_listproject1", "rsproject1", "../", $_SERVER['PHP_SELF'], 28);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT customerfullname, ID_customer FROM customer ORDER BY customerfullname";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

//NeXTenesio3 Special List Recordset
$maxRows_rsproject1 = $_SESSION['max_rows_nav_listproject1'];
$pageNum_rsproject1 = 0;
if (isset($_GET['pageNum_rsproject1'])) {
  $pageNum_rsproject1 = $_GET['pageNum_rsproject1'];
}
$startRow_rsproject1 = $pageNum_rsproject1 * $maxRows_rsproject1;

// Defining List Recordset variable
$NXTFilter_rsproject1 = "1=1";
if (isset($_SESSION['filter_tfi_listproject1'])) {
  $NXTFilter_rsproject1 = $_SESSION['filter_tfi_listproject1'];
}
// Defining List Recordset variable
$NXTSort_rsproject1 = "project.projectorderlist";
if (isset($_SESSION['sorter_tso_listproject1'])) {
  $NXTSort_rsproject1 = $_SESSION['sorter_tso_listproject1'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsproject1 = "SELECT project.projectname, customer.customerfullname AS ID_customer, project.webdesign, project.graphicdesign, project.hosting, project.emailhosting, project.startdate, project.enddate, project.ID_project, project.projectorderlist FROM project LEFT JOIN customer ON project.ID_customer = customer.ID_customer WHERE {$NXTFilter_rsproject1} ORDER BY {$NXTSort_rsproject1}";
$query_limit_rsproject1 = sprintf("%s LIMIT %d, %d", $query_rsproject1, $startRow_rsproject1, $maxRows_rsproject1);
$rsproject1 = mysql_query($query_limit_rsproject1, $cnn_teamdnt) or die(mysql_error());
$row_rsproject1 = mysql_fetch_assoc($rsproject1);

if (isset($_GET['totalRows_rsproject1'])) {
  $totalRows_rsproject1 = $_GET['totalRows_rsproject1'];
} else {
  $all_rsproject1 = mysql_query($query_rsproject1);
  $totalRows_rsproject1 = mysql_num_rows($all_rsproject1);
}
$totalPages_rsproject1 = ceil($totalRows_rsproject1/$maxRows_rsproject1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listproject1->checkBoundries();
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
  .KT_col_projectname {width:60%; overflow:hidden;}
  .KT_col_ID_customer {width:100%; overflow:hidden;}
  .KT_col_webdesign {width:100%; overflow:hidden;}
  .KT_col_graphicdesign {width:100%; overflow:hidden;}
  .KT_col_hosting {width:100%; overflow:hidden;}
  .KT_col_emailhosting {width:100%; overflow:hidden;}
  .KT_col_startdate {width:100%; overflow:hidden;}
  .KT_col_enddate {width:100%; overflow:hidden;}
</style>
<?php echo $tor_listproject1->scriptDefinition(); ?>
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
        <div class="KT_tng" id="listproject1">
          <h1><i class="fa fa-suitcase" aria-hidden="true"></i>&nbsp;&nbsp; PROJECT MANAGEMENT
            <?php
  $nav_listproject1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listproject1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listproject1'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listproject1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listproject1'] == 1) {
?>
                  <a href="<?php echo $tfi_listproject1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listproject1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="projectname" class="KT_col_projectname">Project</th>
                    <th id="ID_customer" class="KT_col_ID_customer">Customer</th>
                    <th id="webdesign" class="KT_col_webdesign">Web Design</th>
                    <th id="graphicdesign" class="KT_col_graphicdesign">Graphic Design</th>
                    <th id="hosting" class="KT_col_hosting">Hosting</th>
                    <th id="emailhosting" class="KT_col_emailhosting">Email Hosting</th>
                    <th id="startdate" class="KT_col_startdate">Start</th>
                    <th id="enddate" class="KT_col_enddate">End</th>
                    <th id="projectorderlist" class="KT_sorter <?php echo $tso_listproject1->getSortIcon('project.projectorderlist'); ?> KT_order"> <a href="<?php echo $tso_listproject1->getSortLink('project.projectorderlist'); ?>"><?php echo NXT_getResource("Order"); ?></a> <a class="KT_move_op_link" href="#" onClick="nxt_list_move_link_form(this); return false;"><?php echo NXT_getResource("save"); ?></a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listproject1'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listproject1_projectname" id="tfi_listproject1_projectname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproject1_projectname']); ?>" size="36" maxlength="68" /></td>
                      <td><select name="tfi_listproject1_ID_customer" id="tfi_listproject1_ID_customer">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listproject1_ID_customer']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset1['ID_customer']?>"<?php if (!(strcmp($row_Recordset1['ID_customer'], @$_SESSION['tfi_listproject1_ID_customer']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['customerfullname']?></option>
                        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listproject1_webdesign" id="tfi_listproject1_webdesign" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproject1_webdesign']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listproject1_graphicdesign" id="tfi_listproject1_graphicdesign" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproject1_graphicdesign']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listproject1_hosting" id="tfi_listproject1_hosting" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproject1_hosting']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listproject1_emailhosting" id="tfi_listproject1_emailhosting" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listproject1_emailhosting']); ?>" size="20" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listproject1_startdate" id="tfi_listproject1_startdate" value="<?php echo @$_SESSION['tfi_listproject1_startdate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="text" name="tfi_listproject1_enddate" id="tfi_listproject1_enddate" value="<?php echo @$_SESSION['tfi_listproject1_enddate']; ?>" size="10" maxlength="22" /></td>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="tfi_listproject1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsproject1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="11"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsproject1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_project" class="id_checkbox" value="<?php echo $row_rsproject1['ID_project']; ?>" />
                          <input type="hidden" name="ID_project" class="id_field" value="<?php echo $row_rsproject1['ID_project']; ?>" /></td>
                        <td><div class="KT_col_projectname"><?php echo KT_FormatForList($row_rsproject1['projectname'], 16); ?></div></td>
                        <td><div class="KT_col_ID_customer"><?php echo KT_FormatForList($row_rsproject1['ID_customer'], 24); ?></div></td>
                        <td><?php 
							// Show IF Conditional region4 
							if (@$row_rsproject1['webdesign'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region4
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
					    <?php } 
							// endif Conditional region4
							?></td>
                        <td><?php 
							// Show IF Conditional region5 
							if (@$row_rsproject1['graphicdesign'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region5
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
					    <?php } 
							// endif Conditional region5
							?></td>
                        <td><?php 
							// Show IF Conditional region6 
							if (@$row_rsproject1['hosting'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region6
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
							  <?php } 
							// endif Conditional region6
							?></td>
                        <td><?php 
							// Show IF Conditional region7 
							if (@$row_rsproject1['emailhosting'] == 1) {
							?>
														<img src="../images/icon-yes.png" width="28" height="28">
														<?php 
							// else Conditional region7
							} else { ?>
														<img src="../images/icon-no.png" width="28" height="28">
							  <?php } 
							// endif Conditional region7
							?></td>
                        <td><div class="KT_col_startdate"><?php echo KT_formatDate($row_rsproject1['startdate']); ?></div></td>
                        <td><div class="KT_col_enddate"><?php echo KT_formatDate($row_rsproject1['enddate']); ?></div></td>
                        <td class="KT_order"><input type="hidden" class="KT_orderhidden" name="<?php echo $tor_listproject1->getOrderFieldName() ?>" value="<?php echo $tor_listproject1->getOrderFieldValue($row_rsproject1) ?>" />
                          <a class="KT_movedown_link" href="#move_down">v</a> <a class="KT_moveup_link" href="#move_up">^</a></td>
<td><a class="KT_edit_link" href="form_project.php?ID_project=<?php echo $row_rsproject1['ID_project']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsproject1 = mysql_fetch_assoc($rsproject1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listproject1->Prepare();
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
                <a class="KT_additem_op_link" href="form_project.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rsproject1);
?>
