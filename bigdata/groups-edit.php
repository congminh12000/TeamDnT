<?php
/**
 * Show the form to edit an existing group.
 *
 * @package		ProjectSend
 * @subpackage	Groups
 *
 */
$multiselect = 1;
$allowed_levels = array(9,8);
require_once('sys.includes.php');

$active_nav = 'groups';

$page_title = __('Edit group','cftp_admin');

include('header.php');

$database->MySQLDB();

/** Create the object */
$edit_group = new GroupActions();

/** Check if the id parameter is on the URI. */
if (isset($_GET['id'])) {
	$group_id = $_GET['id'];
	/**
	 * Check if the id corresponds to a real group.
	 * Return 1 if true, 2 if false.
	 **/
	$page_status = (group_exists_id($group_id)) ? 1 : 2;
}
else {
	/**
	 * Return 0 if the id is not set.
	 */
	$page_status = 0;
}

/**
 * Get the group information from the database to use on the form.
 */
if ($page_status === 1) {
	$editing = $database->query("SELECT * FROM tbl_groups WHERE id=$group_id");
	while($data = mysql_fetch_array($editing)) {
		$add_group_data_name = $data['name'];
		$add_group_data_description = $data['description'];
	}

	/**
	 * Make an array of members to use on the select field
	 */
	$current_members = array();
	$members_sql = $database->query("SELECT client_id FROM tbl_members WHERE group_id = '$group_id'");
	if (mysql_num_rows($members_sql) > 0) {
		while($member_data = mysql_fetch_array($members_sql)) {
			$current_members[] = $member_data['client_id'];
		}
	}
}

if ($_POST) {
	/**
	 * Clean the posted form values to be used on the groups actions,
	 * and again on the form if validation failed.
	 * Also, overwrites the values gotten from the database so if
	 * validation failed, the new unsaved values are shown to avoid
	 * having to type them again.
	 */
	$add_group_data_name = mysql_real_escape_string($_POST['add_group_form_name']);
	$add_group_data_description = mysql_real_escape_string($_POST['add_group_form_description']);
	$add_group_data_members = (!empty($_POST['add_group_form_members']) ? $_POST['add_group_form_members'] : '');

	/** Arguments used on validation and group creation. */
	$edit_arguments = array(
							'id' => $group_id,
							'name' => $add_group_data_name,
							'description' => $add_group_data_description,
							'members' => $add_group_data_members
						);

	/** Validate the information from the posted form. */
	$edit_validate = $edit_group->validate_group($edit_arguments);
	
	/** Create the group if validation is correct. */
	if ($edit_validate == 1) {
		$edit_response = $edit_group->edit_group($edit_arguments);
	}
}
?>

<div id="main">
	<h2><?php echo $page_title; ?></h2>
	
	<div class="whiteform whitebox">
		
		<?php
			/**
			 * If the form was submited with errors, show them here.
			 */
			$valid_me->list_errors();
		?>
		
		<?php
			if (isset($edit_response)) {
				/**
				 * Get the process state and show the corresponding ok or error message.
				 */
				switch ($edit_response['query']) {
					case 1:
						$msg = __('Group edited correctly.','cftp_admin');
						echo system_message('ok',$msg);

						/** Record the action log */
						$new_log_action = new LogActions();
						$log_action_args = array(
												'action' => 15,
												'owner_id' => $global_id,
												'affected_account' => $group_id,
												'affected_account_name' => $add_group_data_name
											);
						$new_record_action = $new_log_action->log_action_save($log_action_args);
					break;
					case 0:
						$msg = __('There was an error. Please try again.','cftp_admin');
						echo system_message('error',$msg);
					break;
				}
			}
			else {
			/**
			 * If not $edit_response is set, it means we are just entering for the first time.
			 */
			 	$direct_access_error = __('This page is not intended to be accessed directly.','cftp_admin');
			 	if ($page_status === 0) {
					$msg = __('No group was selected.','cftp_admin');
					echo system_message('error',$msg);
					echo '<p>'.$direct_access_error.'</p>';
				}
				else if ($page_status === 2) {
					$msg = __('There is no group with that ID number.','cftp_admin');
					echo system_message('error',$msg);
					echo '<p>'.$direct_access_error.'</p>';
				}
				else {
					/**
					 * Include the form.
					 */
					$groups_form_type = 'edit_group';
					include('groups-form.php');
				}
			}
		?>

	</div>
</div>

<?php
	$database->Close();
	include('footer.php');
?>