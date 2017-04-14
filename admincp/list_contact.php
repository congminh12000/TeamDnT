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
$tfi_listcontact2 = new TFI_TableFilter($conn_cnn_teamdnt, "tfi_listcontact2");
$tfi_listcontact2->addColumn("contact.contactgroup", "NUMERIC_TYPE", "contactgroup", "=");
$tfi_listcontact2->addColumn("contact.contactfullname", "STRING_TYPE", "contactfullname", "%");
$tfi_listcontact2->addColumn("services.ID_services", "NUMERIC_TYPE", "contactservice", "=");
$tfi_listcontact2->addColumn("contact.contactemail", "STRING_TYPE", "contactemail", "%");
$tfi_listcontact2->addColumn("contact.contactphonenumber", "STRING_TYPE", "contactphonenumber", "%");
$tfi_listcontact2->addColumn("contact.contacttitle", "STRING_TYPE", "contacttitle", "%");
$tfi_listcontact2->addColumn("contact.contactdate", "DATE_TYPE", "contactdate", "=");
$tfi_listcontact2->Execute();

// Sorter
$tso_listcontact2 = new TSO_TableSorter("rscontact1", "tso_listcontact2");
$tso_listcontact2->addColumn("contact.contactgroup");
$tso_listcontact2->addColumn("contact.contactfullname");
$tso_listcontact2->addColumn("services.servicecode");
$tso_listcontact2->addColumn("contact.contactemail");
$tso_listcontact2->addColumn("contact.contactphonenumber");
$tso_listcontact2->addColumn("contact.contacttitle");
$tso_listcontact2->addColumn("contact.contactdate");
$tso_listcontact2->setDefault("contact.contactdate DESC");
$tso_listcontact2->Execute();

// Navigation
$nav_listcontact2 = new NAV_Regular("nav_listcontact2", "rscontact1", "../", $_SERVER['PHP_SELF'], 12);

mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);
$query_Recordset1 = "SELECT servicecode, ID_services FROM services ORDER BY servicecode";
$Recordset1 = mysql_query($query_Recordset1, $cnn_teamdnt) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

//NeXTenesio3 Special List Recordset
$maxRows_rscontact1 = $_SESSION['max_rows_nav_listcontact2'];
$pageNum_rscontact1 = 0;
if (isset($_GET['pageNum_rscontact1'])) {
  $pageNum_rscontact1 = $_GET['pageNum_rscontact1'];
}
$startRow_rscontact1 = $pageNum_rscontact1 * $maxRows_rscontact1;

// Defining List Recordset variable
$NXTFilter_rscontact1 = "1=1";
if (isset($_SESSION['filter_tfi_listcontact2'])) {
  $NXTFilter_rscontact1 = $_SESSION['filter_tfi_listcontact2'];
}
// Defining List Recordset variable
$NXTSort_rscontact1 = "contact.contactdate DESC";
if (isset($_SESSION['sorter_tso_listcontact2'])) {
  $NXTSort_rscontact1 = $_SESSION['sorter_tso_listcontact2'];
}
mysql_select_db($database_cnn_teamdnt, $cnn_teamdnt);

$query_rscontact1 = "SELECT contact.contactgroup, contact.contactfullname, services.servicecode AS contactservice, contact.contactemail, contact.contactphonenumber, contact.contacttitle, contact.contactdate, contact.ID_contact FROM contact LEFT JOIN services ON contact.contactservice = services.ID_services WHERE {$NXTFilter_rscontact1} ORDER BY {$NXTSort_rscontact1}";
$query_limit_rscontact1 = sprintf("%s LIMIT %d, %d", $query_rscontact1, $startRow_rscontact1, $maxRows_rscontact1);
$rscontact1 = mysql_query($query_limit_rscontact1, $cnn_teamdnt) or die(mysql_error());
$row_rscontact1 = mysql_fetch_assoc($rscontact1);

if (isset($_GET['totalRows_rscontact1'])) {
  $totalRows_rscontact1 = $_GET['totalRows_rscontact1'];
} else {
  $all_rscontact1 = mysql_query($query_rscontact1);
  $totalRows_rscontact1 = mysql_num_rows($all_rscontact1);
}
$totalPages_rscontact1 = ceil($totalRows_rscontact1/$maxRows_rscontact1)-1;
//End NeXTenesio3 Special List Recordset

$nav_listcontact2->checkBoundries();
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
  .KT_col_contactgroup {width:100%; overflow:hidden;}
  .KT_col_contactfullname {width:100%; overflow:hidden;}
  .KT_col_contactservice {width:100%; overflow:hidden;}
  .KT_col_contactemail {width:100%; overflow:hidden;}
  .KT_col_contactphonenumber {width:100%; overflow:hidden;}
  .KT_col_contacttitle {width:100%; overflow:hidden;}
  .KT_col_contactdate {width:100%; overflow:hidden;}
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
        <div class="KT_tng" id="listcontact2">
          <h1><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp; CONTACT MANAGEMENT
            <?php
  $nav_listcontact2->Prepare();
  require("../includes/nav/NAV_Text_Statistics.inc.php");
?>
          </h1>
          <div class="KT_tnglist">
            <form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" id="form1">
              <div class="KT_options"> <a href="<?php echo $nav_listcontact2->getShowAllLink(); ?>"><?php echo NXT_getResource("Show"); ?>
                <?php 
  // Show IF Conditional region1
  if (@$_GET['show_all_nav_listcontact2'] == 1) {
?>
                  <?php echo $_SESSION['default_max_rows_nav_listcontact2']; ?>
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
  if (@$_SESSION['has_filter_tfi_listcontact2'] == 1) {
?>
                  <a href="<?php echo $tfi_listcontact2->getResetFilterLink(); ?>"><?php echo NXT_getResource("Reset filter"); ?></a>
                  <?php 
  // else Conditional region2
  } else { ?>
                  <a href="<?php echo $tfi_listcontact2->getShowFilterLink(); ?>"><?php echo NXT_getResource("Show filter"); ?></a>
                  <?php } 
  // endif Conditional region2
?>
              </div>
              <table cellpadding="2" cellspacing="0" class="KT_tngtable">
                <thead>
                  <tr class="KT_row_order">
                    <th> <input type="checkbox" name="KT_selAll" id="KT_selAll"/>
                    </th>
                    <th id="contactgroup" class="KT_sorter KT_col_contactgroup <?php echo $tso_listcontact2->getSortIcon('contact.contactgroup'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contactgroup'); ?>">Group</a> </th>
                    <th id="contactfullname" class="KT_sorter KT_col_contactfullname <?php echo $tso_listcontact2->getSortIcon('contact.contactfullname'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contactfullname'); ?>">Full name</a> </th>
                    <th id="contactservice" class="KT_sorter KT_col_contactservice <?php echo $tso_listcontact2->getSortIcon('services.servicecode'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('services.servicecode'); ?>">Service</a> </th>
                    <th id="contactemail" class="KT_sorter KT_col_contactemail <?php echo $tso_listcontact2->getSortIcon('contact.contactemail'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contactemail'); ?>">Email</a> </th>
                    <th id="contactphonenumber" class="KT_sorter KT_col_contactphonenumber <?php echo $tso_listcontact2->getSortIcon('contact.contactphonenumber'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contactphonenumber'); ?>">Phone</a> </th>
                    <th id="contacttitle" class="KT_sorter KT_col_contacttitle <?php echo $tso_listcontact2->getSortIcon('contact.contacttitle'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contacttitle'); ?>">Title</a> </th>
                    <th id="contactdate" class="KT_sorter KT_col_contactdate <?php echo $tso_listcontact2->getSortIcon('contact.contactdate'); ?>"> <a href="<?php echo $tso_listcontact2->getSortLink('contact.contactdate'); ?>">Date</a> </th>
                    <th>&nbsp;</th>
                  </tr>
                  <?php 
  // Show IF Conditional region3
  if (@$_SESSION['has_filter_tfi_listcontact2'] == 1) {
?>
                    <tr class="KT_row_filter">
                      <td>&nbsp;</td>
                      <td><select name="tfi_listcontact2_contactgroup" id="tfi_listcontact2_contactgroup">
                        <option value="1" <?php if (!(strcmp(1, KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contactgroup'])))) {echo "SELECTED";} ?>>Company</option>
                        <option value="2" <?php if (!(strcmp(2, KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contactgroup'])))) {echo "SELECTED";} ?>>Individual</option>
                      </select></td>
                      <td><input type="text" name="tfi_listcontact2_contactfullname" id="tfi_listcontact2_contactfullname" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contactfullname']); ?>" size="36" maxlength="68" /></td>
                      <td><select name="tfi_listcontact2_contactservice" id="tfi_listcontact2_contactservice">
                        <option value="" <?php if (!(strcmp("", @$_SESSION['tfi_listcontact2_contactservice']))) {echo "SELECTED";} ?>><?php echo NXT_getResource("None"); ?></option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_Recordset1['ID_services']?>"<?php if (!(strcmp($row_Recordset1['ID_services'], @$_SESSION['tfi_listcontact2_contactservice']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['servicecode']?></option>
                        <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
                      </select></td>
                      <td><input type="text" name="tfi_listcontact2_contactemail" id="tfi_listcontact2_contactemail" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contactemail']); ?>" size="36" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listcontact2_contactphonenumber" id="tfi_listcontact2_contactphonenumber" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contactphonenumber']); ?>" size="16" maxlength="16" /></td>
                      <td><input type="text" name="tfi_listcontact2_contacttitle" id="tfi_listcontact2_contacttitle" value="<?php echo KT_escapeAttribute(@$_SESSION['tfi_listcontact2_contacttitle']); ?>" size="48" maxlength="168" /></td>
                      <td><input type="text" name="tfi_listcontact2_contactdate" id="tfi_listcontact2_contactdate" value="<?php echo @$_SESSION['tfi_listcontact2_contactdate']; ?>" size="10" maxlength="22" /></td>
                      <td><input type="submit" name="tfi_listcontact2" value="<?php echo NXT_getResource("Filter"); ?>" /></td>
                    </tr>
                    <?php } 
  // endif Conditional region3
?>
                </thead>
                <tbody>
                  <?php if ($totalRows_rscontact1 == 0) { // Show if recordset empty ?>
                    <tr>
                      <td colspan="9"><?php echo NXT_getResource("The table is empty or the filter you've selected is too restrictive."); ?></td>
                    </tr>
                    <?php } // Show if recordset empty ?>
                  <?php if ($totalRows_rscontact1 > 0) { // Show if recordset not empty ?>
                    <?php do { ?>
                      <tr class="<?php echo @$cnt1++%2==0 ? "" : "KT_even"; ?>">
                        <td><input type="checkbox" name="kt_pk_contact" class="id_checkbox" value="<?php echo $row_rscontact1['ID_contact']; ?>" />
                          <input type="hidden" name="ID_contact" class="id_field" value="<?php echo $row_rscontact1['ID_contact']; ?>" /></td>
                        <td><?php 
							// Show IF Conditional region4 
							if (@$row_rscontact1['contactgroup'] == 1) {
							?>
														Company
														<?php 
							// else Conditional region4
							} else { ?>
														Individual
							  <?php } 
							// endif Conditional region4
							?></td>
                        <td><div class="KT_col_contactfullname"><?php echo KT_FormatForList($row_rscontact1['contactfullname'], 36); ?></div></td>
                        <td><div class="KT_col_contactservice"><?php echo KT_FormatForList($row_rscontact1['contactservice'], 36); ?></div></td>
                        <td><div class="KT_col_contactemail"><?php echo KT_FormatForList($row_rscontact1['contactemail'], 36); ?></div></td>
                        <td><div class="KT_col_contactphonenumber"><?php echo KT_FormatForList($row_rscontact1['contactphonenumber'], 16); ?></div></td>
                        <td><div class="KT_col_contacttitle"><?php echo KT_FormatForList($row_rscontact1['contacttitle'], 48); ?></div></td>
                        <td><div class="KT_col_contactdate"><?php echo KT_formatDate($row_rscontact1['contactdate']); ?></div></td>
<td><a class="KT_edit_link" href="form_contact.php?ID_contact=<?php echo $row_rscontact1['ID_contact']; ?>&amp;KT_back=1"><?php echo NXT_getResource("edit_one"); ?></a> <a class="KT_delete_link" href="#delete"><?php echo NXT_getResource("delete_one"); ?></a></td>
                      </tr>
                      <?php } while ($row_rscontact1 = mysql_fetch_assoc($rscontact1)); ?>
                    <?php } // Show if recordset not empty ?>
                </tbody>
              </table>
              <div class="KT_bottomnav">
                <div>
                  <?php
            $nav_listcontact2->Prepare();
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
                <a class="KT_additem_op_link" href="form_contact.php?KT_back=1" onClick="return nxt_list_additem(this)"><?php echo NXT_getResource("add new"); ?></a> </div>
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
mysql_free_result($rscontact1);
?>