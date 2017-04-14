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
$tfi_listagency1 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listagency1");
$tfi_listagency1->addColumn("agency.agencyname", "STRING_TYPE", "agencyname", "%");
$tfi_listagency1->addColumn("agency.agencylogo", "STRING_TYPE", "agencylogo", "%");
$tfi_listagency1->addColumn("agency.agencyemail", "STRING_TYPE", "agencyemail", "%");
$tfi_listagency1->addColumn("agency.agencyphonenumber1", "STRING_TYPE", "agencyphonenumber1", "%");
$tfi_listagency1->Execute();

// Sorter
$tso_listagency1 = new TSO_TableSorter("rsagency1", "tso_listagency1");
$tso_listagency1->addColumn("agency.agencyname");
$tso_listagency1->addColumn("agency.agencylogo");
$tso_listagency1->addColumn("agency.agencyemail");
$tso_listagency1->addColumn("agency.agencyphonenumber1");
$tso_listagency1->setDefault("agency.agencyname");
$tso_listagency1->Execute();

// Navigation
$nav_listagency1 = new NAV_Regular("nav_listagency1", "rsagency1", "../", $_SERVER['PHP_SELF'], 12);

//NeXTenesio3 Special List Recordset
$maxRows_rsagency1 = $_SESSION['max_rows_nav_listagency1'];
$pageNum_rsagency1 = 0;
if (isset($_GET['pageNum_rsagency1'])) {
  $pageNum_rsagency1 = $_GET['pageNum_rsagency1'];
}
$startRow_rsagency1 = $pageNum_rsagency1 * $maxRows_rsagency1;

// Defining List Recordset variable
$NXTFilter_rsagency1 = "1=1";
if (isset($_SESSION['filter_tfi_listagency1'])) {
  $NXTFilter_rsagency1 = $_SESSION['filter_tfi_listagency1'];
}
// Defining List Recordset variable
$NXTSort_rsagency1 = "agency.agencyname";
if (isset($_SESSION['sorter_tso_listagency1'])) {
  $NXTSort_rsagency1 = $_SESSION['sorter_tso_listagency1'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rsagency1 = "SELECT agency.agencyname, agency.agencylogo, agency.agencyemail, agency.agencyphonenumber1, agency.ID_agency FROM agency WHERE {$NXTFilter_rsagency1} ORDER BY {$NXTSort_rsagency1}";
$query_limit_rsagency1 = sprintf("%s LIMIT %d, %d", $query_rsagency1, $startRow_rsagency1, $maxRows_rsagency1);
$rsagency1 = mysql_query($query_limit_rsagency1, $cnn_teamdnt) or die(mysql_error());
$row_rsagency1 = mysql_fetch_assoc($rsagency1);

if (isset($_GET['totalRows_rsagency1'])) {
  $totalRows_rsagency1 = $_GET['totalRows_rsagency1'];
} else {
  $all_rsagency1 = mysql_query($query_rsagency1);
  $totalRows_rsagency1 = mysql_num_rows($all_rsagency1);
}
$totalPages_rsagency1 = ceil($totalRows_rsagency1/$maxRows_rsagency1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listagency1->checkBoundries();
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
  .KT_col_agencyname {width:100%; overflow:hidden;}
  .KT_col_agencylogo {width:100%; overflow:hidden;}
  .KT_col_agencyemail {width:100%; overflow:hidden;}
  .KT_col_agencyphonenumber1 {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listagency1">
          <h1><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;&nbsp; AGENCY MANAGEMNENT
            <?php
  $nav_listagency1->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listagency1->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listagency1'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listagency1']; ?>
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
  if (@$_SESSION['has_filter_tfi_listagency1'] == 1) {
?>
                  <a href="<?php echo $tfi_listagency1->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listagency1->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="agencyname" class="KT_sorter KT_col_agencyname <?php echo $tso_listagency1->getSortIcon('agency.agencyname'); ?>"> <a href="<?php echo $tso_listagency1->getSortLink('agency.agencyname'); ?>">Name</a> </th>
                    <th id="agencylogo" class="KT_sorter KT_col_agencylogo <?php echo $tso_listagency1->getSortIcon('agency.agencylogo'); ?>"> <a href="<?php echo $tso_listagency1->getSortLink('agency.agencylogo'); ?>">Logo</a> </th>
                    <th id="agencyemail" class="KT_sorter KT_col_agencyemail <?php echo $tso_listagency1->getSortIcon('agency.agencyemail'); ?>"> <a href="<?php echo $tso_listagency1->getSortLink('agency.agencyemail'); ?>">Email</a> </th>
                    <th id="agencyphonenumber1" class="KT_sorter KT_col_agencyphonenumber1 <?php echo $tso_listagency1->getSortIcon('agency.agencyphonenumber1'); ?>"> <a href="<?php echo $tso_listagency1->getSortLink('agency.agencyphonenumber1'); ?>">Phone</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listagency1'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><input type="text" name="tfi_listagency1_agencyname" id="tfi_listagency1_agencyname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listagency1_agencyname']); ?>" size="38" maxlength="68" /></td>
                      <td><input type="text" name="tfi_listagency1_agencylogo" id="tfi_listagency1_agencylogo" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listagency1_agencylogo']); ?>" size="20" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listagency1_agencyemail" id="tfi_listagency1_agencyemail" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listagency1_agencyemail']); ?>" size="38" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listagency1_agencyphonenumber1" id="tfi_listagency1_agencyphonenumber1" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listagency1_agencyphonenumber1']); ?>" size="30" maxlength="16" /></td>
                      <td><input type="submit" name="tfi_listagency1" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rsagency1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="6"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rsagency1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_agency" class="id_checkbox" value="<?php echo $row_rsagency1['ID_agency']; ?>" />
                          <input type="hidden" name="ID_agency" class="id_field" value="<?php echo $row_rsagency1['ID_agency']; ?>" /></td>
                        <td><div class="KT_col_agencyname"><?php echo KT_FormatForList($row_rsagency1['agencyname'], 48); ?></div></td>
                        <td><?php 
						// Show If File Exists (region4)
						if (tNG_fileExists("../images/logopartners/", "{rsagency1.agencylogo}")) {
						?>
													<img src="<?php echo tNG_showDynamicImage("../", "../images/logopartners/", "{rsagency1.agencylogo}");?>" />
													<?php 
						// else File Exists (region4)
						} else { ?>
													<img src="../images/logo-sample.png" alt="TeamDnT-WebDesign NoLogo">
													<?php } 
						// EndIf File Exists (region4)
						?></td>
                        <td><div class="KT_col_agencyemail"><?php echo KT_FormatForList($row_rsagency1['agencyemail'], 12); ?></div></td>
                        <td><div class="KT_col_agencyphonenumber1"><?php echo KT_FormatForList($row_rsagency1['agencyphonenumber1'], 48); ?></div></td>
                        <td><a class="KT_edit_link" href="form_agency.php?ID_agency=<?php echo $row_rsagency1['ID_agency']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rsagency1 = mysql_fetch_assoc($rsagency1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listagency1->Prepare();
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
                <a class="KT_additem_op_link" href="form_agency.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rsagency1);
?>
