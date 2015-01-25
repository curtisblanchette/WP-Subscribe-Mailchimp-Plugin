<div class="wrap">
	<h2>Curts Modal Overlay Settings</h2>
	<span>Define the modal content here.</span>
	<form method="post" action="options.php">
		<?php @settings_fields('curts_modal_overlay-group'); ?>
		<?php @do_settings_fields('curts_modal_overlay-group'); ?>
		
		<h3></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="modal_heading">Heading</label></th>
				<td><input type="text" size="100" name="modal_heading" id="modal_heading" value="<?php echo get_option('modal_heading'); ?>"/></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="modal_content">Content</label></th>
				<td><textarea rows="10" name="modal_content" id="modal_content"><?php echo get_option('modal_content'); ?></textarea></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc_api_key">MailChimp API Key</label></th>
				<td><input type="text" size="100" name="mc_api_key" id="mc_api_key" value="<?php echo get_option('mc_api_key'); ?>"/></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc_api_key">MailChimp List ID</label></th>
				<td><input type="text" size="100" name="mc_list_id" id="mc_list_id" value="<?php echo get_option('mc_list_id'); ?>"/></td>
			</tr>
		</table>
		<?php @submit_button(); ?>
	</form>
</div>