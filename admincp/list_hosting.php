<?php require_once('../Connections/cnn_teamdnt.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Require the MXI classes
require_once ('../includes/mxi/MXI.php');

// Load the required classes
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

// Filter
$tfi_listhosting3 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listhosting3");
$tfi_listhosting3->addColumn("project.ID_project", "NUMERIC_TYPE", "ID_project", "=");
$tfi_listhosting3->addColumn("hosting.hostingip", "STRING_TYPE", "hostingip", "%");
$tfi_listhosting3->addColumn("hosting.datastorage", "NUMERIC_TYPE", "datastorage", "=");
$tfi_listhosting3->addColumn("hosting.ftpusername", "STRING_TYPE", "ftpusername", "%");
$tfi_listhosting3->addColumn("hosting.ftppassword", "STRING_TYPE", "ftppassword", "%");
$tfi_listhosting3->addColumn("hosting.webmasterusername", "STRING_TYPE", "webmasterusername", "%");
$tfi_listhosting3->addColumn("hosting.webmasterpassword", "STRING_TYPE", "webmasterpassword", "%");
$tfi_listhosting3->addColumn("server.ID_server", "NUMERIC_TYPE", "ID_server", "=");
$tfi_listhosting3->addColumn("services.ID_services", "NUMERIC_TYPE", "ID_services", "=");
$tfi_listhosting3->addColumn("hosting.hostingexpirydate", "DATE_TYPE", "hostingexpirydate", "=");
$tfi_listhosting3->Execute();

// Sorter
$tso_listhosting3 = new TSO_TableSorter("rshosting1", "tso_listhosting3");
$tso_listhosting3->addColumn("project.projectname");
$tso_listhosting3->addColumn("hosting.hostingip");
$tso_listhosting3->addColumn("hosting.datastorage");
$tso_listhosting3->addColumn("hosting.ftpusername");
$tso_listhosting3->addColumn("hosting.ftppassword");
$tso_listhosting3->addColumn("hosting.webmasterusername");
$tso_listhosting3->addColumn("hosting.webmasterpassword");
$tso_listhosting3->addColumn("server.servername");
$tso_listhosting3->addColumn("services.servicecode");
$tso_listhosting3->addColumn("hosting.hostingexpirydate");
$tso_listhosting3->setDefault("hosting.hostingexpirydate");
$tso_listhosting3->Execute();

// Navigation
$nav_listhosting3 = new NAV_Regular("nav_listhosting3", "rshosting1", "../", $_SERVER['PHP_SELF'], 28);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortproject = "SELECT ID_project, projectname FROM project ORDER BY projectname ASC";
$rs_sortproject = mysql_query($query_rs_sortproject, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
$totalRows_rs_sortproject = mysql_num_rows($rs_sortproject);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortserver = "SELECT ID_server, servername, ID_agency FROM server ORDER BY servername ASC";
$rs_sortserver = mysql_query($query_rs_sortserver, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
$totalRows_rs_sortserver = mysql_num_rows($rs_sortserver);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_rs_sortservice = "SELECT ID_services, servicename, servicecode FROM services ORDER BY servicecode ASC";
$rs_sortservice = mysql_query($query_rs_sortservice, $cnn_teamdnt) or die(mysql_error());
$row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
$totalRows_rs_sortservice = mysql_num_rows($rs_sortservice);

//NeXTenesio3 Special List Recordset
$maxRows_rshosting1 = $_SESSION['max_rows_nav_listhosting3'];
$pageNum_rshosting1 = 0;
if (isset($_GET['pageNum_rshosting1'])) {
  $pageNum_rshosting1 = $_GET['pageNum_rshosting1'];
}
$startRow_rshosting1 = $pageNum_rshosting1 * $maxRows_rshosting1;

// Defining List Recordset variable
$NXTFilter_rshosting1 = "1=1";
if (isset($_SESSION['filter_tfi_listhosting3'])) {
  $NXTFilter_rshosting1 = $_SESSION['filter_tfi_listhosting3'];
}
// Defining List Recordset variable
$NXTSort_rshosting1 = "hosting.hostingexpirydate";
if (isset($_SESSION['sorter_tso_listhosting3'])) {
  $NXTSort_rshosting1 = $_SESSION['sorter_tso_listhosting3'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rshosting1 = "SELECT project.projectname AS ID_project, hosting.hostingip, hosting.datastorage, hosting.ftpusername, hosting.ftppassword, hosting.webmasterusername, hosting.webmasterpassword, server.servername AS ID_server, services.servicecode AS ID_services, hosting.hostingexpirydate, hosting.ID_hosting FROM ((hosting LEFT JOIN project ON hosting.ID_project = project.ID_project) LEFT JOIN server ON hosting.ID_server = server.ID_server) LEFT JOIN services ON hosting.ID_services = services.ID_services WHERE {$NXTFilter_rshosting1} ORDER BY {$NXTSort_rshosting1}";
$query_limit_rshosting1 = sprintf("%s LIMIT %d, %d", $query_rshosting1, $startRow_rshosting1, $maxRows_rshosting1);
$rshosting1 = mysql_query($query_limit_rshosting1, $cnn_teamdnt) or die(mysql_error());
$row_rshosting1 = mysql_fetch_assoc($rshosting1);

if (isset($_GET['totalRows_rshosting1'])) {
  $totalRows_rshosting1 = $_GET['totalRows_rshosting1'];
} else {
  $all_rshosting1 = mysql_query($query_rshosting1);
  $totalRows_rshosting1 = mysql_num_rows($all_rshosting1);
}
$totalPages_rshosting1 = ceil($totalRows_rshosting1/$maxRows_rshosting1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listhosting3->checkBoundries();
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
  .KT_col_hostingip {width:100%; overflow:hidden;}
  .KT_col_datastorage {width:100%; overflow:hidden;}
  .KT_col_ftpusername {width:100%; overflow:hidden;}
  .KT_col_ftppassword {width:100%; overflow:hidden;}
  .KT_col_webmasterusername {width:100%; overflow:hidden;}
  .KT_col_webmasterpassword {width:100%; overflow:hidden;}
  .KT_col_ID_server {width:100%; overflow:hidden;}
  .KT_col_ID_services {width:100%; overflow:hidden;}
  .KT_col_hostingexpirydate {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listhosting3">
          <h1><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp; HOSTING MANAGEMENT
            <?php
  $nav_listhosting3->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listhosting3->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listhosting3'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listhosting3']; ?>
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
  if (@$_SESSION['has_filter_tfi_listhosting3'] == 1) {
?>
                  <a href="<?php echo $tfi_listhosting3->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listhosting3->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="ID_project" class="KT_sorter KT_col_ID_project <?php echo $tso_listhosting3->getSortIcon('project.projectname'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('project.projectname'); ?>">Project</a> </th>
                    <th id="hostingip" class="KT_sorter KT_col_hostingip <?php echo $tso_listhosting3->getSortIcon('hosting.hostingip'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.hostingip'); ?>">IP</a> </th>
                    <th id="datastorage" class="KT_sorter KT_col_datastorage <?php echo $tso_listhosting3->getSortIcon('hosting.datastorage'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.datastorage'); ?>">Storage</a> </th>
                    <th id="ftpusername" class="KT_sorter KT_col_ftpusername <?php echo $tso_listhosting3->getSortIcon('hosting.ftpusername'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.ftpusername'); ?>">FTP User</a> </th>
                    <th id="ftppassword" class="KT_sorter KT_col_ftppassword <?php echo $tso_listhosting3->getSortIcon('hosting.ftppassword'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.ftppassword'); ?>">FTP Pass</a> </th>
                    <th id="webmasterusername" class="KT_sorter KT_col_webmasterusername <?php echo $tso_listhosting3->getSortIcon('hosting.webmasterusername'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.webmasterusername'); ?>">Admin User</a> </th>
                    <th id="webmasterpassword" class="KT_sorter KT_col_webmasterpassword <?php echo $tso_listhosting3->getSortIcon('hosting.webmasterpassword'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.webmasterpassword'); ?>">Admin Pass</a> </th>
                    <th id="ID_server" class="KT_sorter KT_col_ID_server <?php echo $tso_listhosting3->getSortIcon('server.servername'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('server.servername'); ?>">Server</a> </th>
                    <th id="ID_services" class="KT_sorter KT_col_ID_services <?php echo $tso_listhosting3->getSortIcon('services.servicecode'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('services.servicecode'); ?>">Service</a> </th>
                    <th id="hostingexpirydate" class="KT_sorter KT_col_hostingexpirydate <?php echo $tso_listhosting3->getSortIcon('hosting.hostingexpirydate'); ?>"> <a href="<?php echo $tso_listhosting3->getSortLink('hosting.hostingexpirydate'); ?>">Expiry Date</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listhosting3'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><select name="tfi_listhosting3_ID_project" id="tfi_listhosting3_ID_project">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listhosting3_ID_project']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortproject['ID_project']?>"<?php if (!(strcmp($row_rs_sortproject['ID_project'], @$_SESSION['tfi_listhosting3_ID_project']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortproject['projectname']?></option>
                        <?php
} while ($row_rs_sortproject = mysql_fetch_assoc($rs_sortproject));
  $rows = mysql_num_rows($rs_sortproject);
  if($rows > 0) {
      mysql_data_seek($rs_sortproject, 0);
	  $row_rs_sortproject = mysql_fetch_assoc($rs_sortproject);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listhosting3_hostingip" id="tfi_listhosting3_hostingip" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_hostingip']); ?>" size="26" maxlength="26" /></td>
                      <td><input type="text" name="tfi_listhosting3_datastorage" id="tfi_listhosting3_datastorage" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_datastorage']); ?>" size="26" maxlength="100" /></td>
                      <td><input type="text" name="tfi_listhosting3_ftpusername" id="tfi_listhosting3_ftpusername" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_ftpusername']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listhosting3_ftppassword" id="tfi_listhosting3_ftppassword" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_ftppassword']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listhosting3_webmasterusername" id="tfi_listhosting3_webmasterusername" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_webmasterusername']); ?>" size="36" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listhosting3_webmasterpassword" id="tfi_listhosting3_webmasterpassword" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listhosting3_webmasterpassword']); ?>" size="36" maxlength="68" /></td>
                      <td><select name="tfi_listhosting3_ID_server" id="tfi_listhosting3_ID_server">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listhosting3_ID_server']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortserver['ID_server']?>"<?php if (!(strcmp($row_rs_sortserver['ID_server'], @$_SESSION['tfi_listhosting3_ID_server']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortserver['servername']?></option>
                        <?php
} while ($row_rs_sortserver = mysql_fetch_assoc($rs_sortserver));
  $rows = mysql_num_rows($rs_sortserver);
  if($rows > 0) {
      mysql_data_seek($rs_sortserver, 0);
	  $row_rs_sortserver = mysql_fetch_assoc($rs_sortserver);
  }
?>
                      </select></td>
                      <td><select name="tfi_listhosting3_ID_services" id="tfi_listhosting3_ID_services">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listhosting3_ID_services']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_rs_sortservice['ID_services']?>"<?php if (!(strcmp($row_rs_sortservice['ID_services'], @$_SESSION['tfi_listhosting3_ID_services']))) {echo "SELECTED";} ?>><?php echo $row_rs_sortservice['servicecode']?></option>
                        <?php
} while ($row_rs_sortservice = mysql_fetch_assoc($rs_sortservice));
  $rows = mysql_num_rows($rs_sortservice);
  if($rows > 0) {
      mysql_data_seek($rs_sortservice, 0);
	  $row_rs_sortservice = mysql_fetch_assoc($rs_sortservice);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listhosting3_hostingexpirydate" id="tfi_listhosting3_hostingexpirydate" value="<?php echo @$_SESSION['tfi_listhosting3_hostingexpirydate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="submit" name="tfi_listhosting3" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rshosting1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="12"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rshosting1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_hosting" class="id_checkbox" value="<?php echo $row_rshosting1['ID_hosting']; ?>" />
                          <input type="hidden" name="ID_hosting" class="id_field" value="<?php echo $row_rshosting1['ID_hosting']; ?>" /></td>
                        <td><div class="KT_col_ID_project"><?php echo KT_FormatForList($row_rshosting1['ID_project'], 12); ?></div></td>
                        <td><div class="KT_col_hostingip"><?php echo KT_FormatForList($row_rshosting1['hostingip'], 26); ?></div></td>
                        <td><div class="KT_col_datastorage"><?php echo KT_FormatForList($row_rshosting1['datastorage'], 26); ?> Mb</div></td>
                        <td><div class="KT_col_ftpusername"><?php echo KT_FormatForList($row_rshosting1['ftpusername'], 26); ?></div></td>
                        <td><div class="KT_col_ftppassword"><?php echo KT_FormatForList($row_rshosting1['ftppassword'], 26); ?></div></td>
                        <td><div class="KT_col_webmasterusername"><?php echo KT_FormatForList($row_rshosting1['webmasterusername'], 26); ?></div></td>
                        <td><div class="KT_col_webmasterpassword"><?php echo KT_FormatForList($row_rshosting1['webmasterpassword'], 26); ?></div></td>
                        <td><div class="KT_col_ID_server"><?php echo KT_FormatForList($row_rshosting1['ID_server'], 26); ?></div></td>
                        <td><div class="KT_col_ID_services"><?php echo KT_FormatForList($row_rshosting1['ID_services'], 26); ?></div></td>
                        <td><div class="KT_col_hostingexpirydate"><?php echo KT_formatDate($row_rshosting1['hostingexpirydate']); ?></div></td>
                        <td><a class="KT_edit_link" href="form_hosting.php?ID_hosting=<?php echo $row_rshosting1['ID_hosting']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rshosting1 = mysql_fetch_assoc($rshosting1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listhosting3->Prepare();
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
                <a class="KT_additem_op_link" href="form_hosting.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rs_sortproject);
mysql_free_result($rs_sortserver);
mysql_free_result($rs_sortservice);
mysql_free_result($rshosting1);
?>