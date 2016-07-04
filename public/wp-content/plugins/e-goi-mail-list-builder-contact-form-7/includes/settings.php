	<?php $EgoiMailListBuilderContactForm7 = get_option('EgoiMailListBuilderContactForm7Object'); ?>
	<div class='wrap'>
	<div id="icon-egoi-mail-list-builder-contact-form-7-settings" class="icon32"></div>
	<h2>Settings</h2>
	<?php require('donate.php'); ?>
	<?php if($EgoiMailListBuilderContactForm7->isAuthed() && in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))	{
		if(isset($_POST['egoi_mail_list_builder_contact_form_7_settings_save'])) {
			$EgoiMailListBuilderContactForm7->hide_subscribe = (isset($_POST['egoi_mail_list_builder_contact_form_7_settings_hide_subscribe'])) ? true : false;
			$EgoiMailListBuilderContactForm7->subscribe_enable = (isset($_POST['egoi_mail_list_builder_contact_form_7_settings_comments'])) ? true : false;
			$EgoiMailListBuilderContactForm7->subscribe_enable_checkbox = (isset($_POST['egoi_mail_list_builder_contact_form_7_settings_checkbox'])) ? true : false;
			$EgoiMailListBuilderContactForm7->subscribe_text = $_POST['egoi_mail_list_builder_contact_form_7_settings_text'];
			$EgoiMailListBuilderContactForm7->subscribe_list = $_POST['egoi_mail_list_builder_contact_form_7_settings_list'];
			if($_POST['egoi_mail_list_builder_contact_form_7_settings_list'] == -1) {
				$EgoiMailListBuilderContactForm7->subscribe_enable = false;
				$EgoiMailListBuilderContactForm7->subscribe_enable_checkbox = false;
			}
			$EgoiMailListBuilderContactForm7->double_opt_in = (isset($_POST['egoi_mail_list_builder_contact_form_7_settings_double_opt_in'])) ? true : false;
			update_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);
		}
		$result = $EgoiMailListBuilderContactForm7->getLists();
		update_option('EgoiMailListBuilderContactForm7Object',$EgoiMailListBuilderContactForm7);
		egoi_mail_list_builder_contact_form_7_admin_notices();
	?>
	<form name='egoi_mail_list_builder_contact_form_7_settings_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
	<table class="form-table">
		<tr>
			<th colspan="2">
				<h3>"Post comment" section</h3>
			</th>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_comments">Add a "Subscribe" checkbox</label>
			</th>
			<td>
				<input type='checkbox' size='60' name='egoi_mail_list_builder_contact_form_7_settings_comments' <?php if($EgoiMailListBuilderContactForm7->subscribe_enable) echo "checked";?>/>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				<h3>Contact Form 7 Section</h3>
			</th>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_checkbox">Add a "Subscribe" checkbox</label>
			</th>
			<td>
				<input type='checkbox' size='60' name='egoi_mail_list_builder_contact_form_7_settings_checkbox' <?php if($EgoiMailListBuilderContactForm7->subscribe_enable_checkbox) echo "checked";?>/>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_hide_subscribe">Hide Subscribe Check Box</label>
			</th>
			<td>
				<input type='checkbox' size='60' name='egoi_mail_list_builder_contact_form_7_settings_hide_subscribe' <?php if($EgoiMailListBuilderContactForm7->hide_subscribe == 1) echo "checked";?>/>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				<h3>Shortcode section</h3>
			</th>
		</tr>
		<tr>
			<td colspan="2">
				<p>Select the widget you want starting on the index 1, top to bottom, from the new sidebar called <a href="<?php echo admin_url('widgets.php'); ?>">'Egoi Widget Shortcode Area'</a></p>
				<i>shortcode use case: [egoi_subscribe widget_index="1"]</i>
			</td>
		</tr>
		<tr>
			<th colspan="2">
				<h3>General Settings</h3>
			</th>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_text">Subscribe Text</label>
			</th>
			<td>
				<input type='text' size='60' name='egoi_mail_list_builder_contact_form_7_settings_text'  value='<?php echo $EgoiMailListBuilderContactForm7->subscribe_text; ?>'/>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_list">Mailing list</label>
			</th>
			<td>
				<select name='egoi_mail_list_builder_contact_form_7_settings_list'>
					<option value="-1" selected>Select a List</option>
					<?php
					for($x = 0;$x < count($result); $x++) {	?>
						<option value='<?php echo $result[$x]['listnum']; ?>' <?php if($result[$x]['listnum'] == $EgoiMailListBuilderContactForm7->subscribe_list){ echo "selected"; } ?>><?php echo $result[$x]['title']; ?></option>
					<?php }	?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_contact_form_7_settings_double_opt_in">Enable Single Opt-In</label>
			</th>
			<td>
				<input type='checkbox' size='60' name='egoi_mail_list_builder_contact_form_7_settings_double_opt_in' <?php if($EgoiMailListBuilderContactForm7->double_opt_in == 1) echo "checked";?>/>
			</td>
		</tr>
		<tr>
			<th>
				<input type="submit" class='button-primary' name="egoi_mail_list_builder_contact_form_7_settings_save" id="egoi_mail_list_builder_contact_form_7_settings_save" value="Save" />
			</th>
		</tr>
	</table>
	</form>
	<?php }	?>