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
$tfi_listemailhosting1 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listemailhosting1");
$tfi_listemailhosting1->addColumn("project.ID_project", "NUMERIC_TYPE", "ID_project", "=");
$tfi_listemailhosting1->addColumn("services.ID_services", "NUMERIC_TYPE", "ID_services", "=");
$tfi_listemailhosting1->addColumn("emailhosting.emailhostingcount", "NUMERIC_TYPE", "emailhostingcount", "=");
$tfi_listemailhosting1->addColumn("server.ID_server", "NUMERIC_TYPE", "ID_server", "=");
$tfi_listemailhosting1->addColumn("emailhosting.emailhostingexpirydate", "DATE_TYPE", "emailhostingexpirydate", "=");
$tfi_listemailhosting1->Execute();

// Sorter
$tso_listemailhosting1 = new TSO_TableSorter("rsemailhosting1", "tso_listemailhosting1");
$tso_listemailhosting1->addColumn("project.projectname");
$tso_listemailhosting1->addColumn("services.servicecode");
$tso_listemailhosting1->addColumn("emailhosting.emailhostingcount");
$tso_listemailhosting1->addColumn("server.servername");
$tso_listemailhosting1->addColumn("emailhosting.emailhostingexpirydate");
$tso_listemailhosting1->setDefault("emailhosting.emailhostingexpirydate");
$tso_listemailhosting1->Execute();

// Navigation
$nav_listemailhosting1 = new NAV_Regular("nav_listemailhosting1", "rsemailhosting1", "../", $_SERVER['PHP_SELF'], 28);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT projectname, ID_project FROM project ORDER BY projectname";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset2 = "SELECT servicecode, ID_services FROM services ORDER BY servicecode";
$Recordset2 = mysql_query($query_Recordset2, $cnn_teamdnt) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset3 = "SELECT servername, ID_server FROM server ORDER BY servername";
$Recordset3 = mysql_query($query_Recordset3, $cnn_teamdnt) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

//NeXTenesio3 Special List Recordset
$maxRows_rsemailhosting1 = $_SESSION['max_rows_nav_listemailhosting1'];
$pageNum_rsemailhosting1 = 0;
if (isset($_GET['pageNum_rsemailhosting1'])) {
  $pageNum_rsemailhosting1 = $_GET['pageNum_rsemailhosting1'];
}
$startRow_rsemailhosting1 = $pageNum_rsemailhosting1 * $maxRows_rsemailhosting1;

// Defining List Recordset variable
$NXTFilter_rsemailhosting1 = "1=1";
if (isset($_SESSION['filter_tfi_listemailhosting1'])) {
  $NXTFilter_rsemailhosting1 = $_SESSION['filter_tfi_listemailhosting1'];
}
// Defining List Recordset variable
$NXTSort_rsemailhosting1 = "emailhosting.emailhostingexpirydate";
if (isset($_SESSION['sorter_tso_listemailhosting1'])) {
  $NXTSort_rsemailhosting1 = $_SESSION['sorter_tso_listemailhosting1'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsemailhosting1 = "SELECT project.projectname AS ID_project, services.servicecode AS ID_services, emailhosting.emailhostingcount, server.servername AS ID_server, emailhosting.emailhostingexpirydate, emailhosting.ID_emailhosting FROM ((emailhosting LEFT JOIN project ON emailhosting.ID_project = project.ID_project) LEFT JOIN services ON emailhosting.ID_services = services.ID_services) LEFT JOIN server ON emailhosting.ID_server = server.ID_server WHERE {$NXTFilter_rsemailhosting1} ORDER BY {$NXTSort_rsemailhosting1}";
$query_limit_rsemailhosting1 = sprintf("%s LIMIT %d, %d", $query_rsemailhosting1, $startRow_rsemailhosting1, $maxRows_rsemailhosting1);
$rsemailhosting1 = mysql_query($query_limit_rsemailhosting1, $cnn_teamdnt) or die(mysql_error());
$row_rsemailhosting1 = mysql_fetch_assoc($rsemailhosting1);

if (isset($_GET['totalRows_rsemailhosting1'])) {
  $totalRows_rsemailhosting1 = $_GET['totalRows_rsemailhosting1'];
} else {
  $all_rsemailhosting1 = mysql_query($query_rsemailhosting1);
  $totalRows_rsemailhosting1 = mysql_num_rows($all_rsemailhosting1);
}
$totalPages_rsemailhosting1 = ceil($totalRows_rsemailhosting1/$maxRows_rsemailhosting1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listemailhosting1->checkBoundries();
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
  .KT_col_ID_project {width:100%; overflow:hidden;}
  .KT_col_ID_services {width:100%; overflow:hidden;}
  .KT_col_emailhostingcount {width:100%; overflow:hidden;}
  .KT_col_ID_server {width:100%; overflow:hidden;}
  .KT_col_emailhostingexpirydate {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listemailhosting1">
          <h1><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp; EMAIL HOSTING MANAGEMENT
            <?php
  $nav_listemailhosting1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listemailhosting1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listemailhosting1'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listemailhosting1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listemailhosting1'] == 1) {
?>
                  <a href="<?php echo $tfi_listemailhosting1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listemailhosting1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="ID_project" class="KT_sorter KT_col_ID_project <?php echo $tso_listemailhosting1->getSortIcon('project.projectname'); ?>"> <a href="<?php echo $tso_listemailhosting1->getSortLink('project.projectname'); ?>">Project</a> </th>
                    <th id="ID_services" class="KT_sorter KT_col_ID_services <?php echo $tso_listemailhosting1->getSortIcon('services.servicecode'); ?>"> <a href="<?php echo $tso_listemailhosting1->getSortLink('services.servicecode'); ?>">Service</a> </th>
                    <th id="emailhostingcount" class="KT_sorter KT_col_emailhostingcount <?php echo $tso_listemailhosting1->getSortIcon('emailhosting.emailhostingcount'); ?>"> <a href="<?php echo $tso_listemailhosting1->getSortLink('emailhosting.emailhostingcount'); ?>">Amount</a> </th>
                    <th id="ID_server" class="KT_sorter KT_col_ID_server <?php echo $tso_listemailhosting1->getSortIcon('server.servername'); ?>"> <a href="<?php echo $tso_listemailhosting1->getSortLink('server.servername'); ?>">Server</a> </th>
                    <th id="emailhostingexpirydate" class="KT_sorter KT_col_emailhostingexpirydate <?php echo $tso_listemailhosting1->getSortIcon('emailhosting.emailhostingexpirydate'); ?>"> <a href="<?php echo $tso_listemailhosting1->getSortLink('emailhosting.emailhostingexpirydate'); ?>">Expiry Date</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listemailhosting1'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><select name="tfi_listemailhosting1_ID_project" id="tfi_listemailhosting1_ID_project">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listemailhosting1_ID_project']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset1['ID_project']?>"<?php if (!(strcmp($row_Recordset1['ID_project'], @$_SESSION['tfi_listemailhosting1_ID_project']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['projectname']?></option>
                        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                      </select></td>
                      <td><select name="tfi_listemailhosting1_ID_services" id="tfi_listemailhosting1_ID_services">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listemailhosting1_ID_services']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset2['ID_services']?>"<?php if (!(strcmp($row_Recordset2['ID_services'], @$_SESSION['tfi_listemailhosting1_ID_services']))) {echo "SELECTED";} ?>><?php echo $row_Recordset2['servicecode']?></option>
                        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listemailhosting1_emailhostingcount" id="tfi_listemailhosting1_emailhostingcount" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listemailhosting1_emailhostingcount']); ?>" size="26" maxlength="100" /></td>
                      <td><select name="tfi_listemailhosting1_ID_server" id="tfi_listemailhosting1_ID_server">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listemailhosting1_ID_server']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset3['ID_server']?>"<?php if (!(strcmp($row_Recordset3['ID_server'], @$_SESSION['tfi_listemailhosting1_ID_server']))) {echo "SELECTED";} ?>><?php echo $row_Recordset3['servername']?></option>
                        <?php
} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3));
  $rows = mysql_num_rows($Recordset3);
  if($rows > 0) {
      mysql_data_seek($Recordset3, 0);
	  $row_Recordset3 = mysql_fetch_assoc($Recordset3);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listemailhosting1_emailhostingexpirydate" id="tfi_listemailhosting1_emailhostingexpirydate" value="<?php echo @$_SESSION['tfi_listemailhosting1_emailhostingexpirydate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="submit" name="tfi_listemailhosting1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsemailhosting1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="7"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsemailhosting1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_emailhosting" class="id_checkbox" value="<?php echo $row_rsemailhosting1['ID_emailhosting']; ?>" />
                          <input type="hidden" name="ID_emailhosting" class="id_field" value="<?php echo $row_rsemailhosting1['ID_emailhosting']; ?>" /></td>
                        <td><div class="KT_col_ID_project"><?php echo KT_FormatForList($row_rsemailhosting1['ID_project'], 36); ?></div></td>
                        <td><div class="KT_col_ID_services"><?php echo KT_FormatForList($row_rsemailhosting1['ID_services'], 26); ?></div></td>
                        <td><div class="KT_col_emailhostingcount"><?php echo KT_FormatForList($row_rsemailhosting1['emailhostingcount'], 26); ?></div></td>
                        <td><div class="KT_col_ID_server"><?php echo KT_FormatForList($row_rsemailhosting1['ID_server'], 36); ?></div></td>
                        <td><div class="KT_col_emailhostingexpirydate"><?php echo KT_formatDate($row_rsemailhosting1['emailhostingexpirydate']); ?></div></td>
                        <td><a class="KT_edit_link" href="form_emailhosting.php?ID_emailhosting=<?php echo $row_rsemailhosting1['ID_emailhosting']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsemailhosting1 = mysql_fetch_assoc($rsemailhosting1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listemailhosting1->Prepare();
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
                <a class="KT_additem_op_link" href="form_emailhosting.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($Recordset3);
mysql_free_result($rsemailhosting1);
?>