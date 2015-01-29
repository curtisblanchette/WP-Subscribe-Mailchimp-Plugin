<?php 
session_start();
require_once('mailchimp-api/inc/MCAPI.class.php');
?>

<div class="wrap">
	<h2>Curt's MailChimp Modal</h2>
	<h3>Configure Modal Settings</h3>
	<form method="post" action="options.php">
		<?php @settings_fields('curts_modal_overlay-group'); ?>
		<?php @do_settings_fields('curts_modal_overlay-group'); ?>
		<style>
			.form-table th p { font-size:12px; font-weight:100; padding:0; margin:0;}
			.form-table td {
				padding:0;
			}
			.form-table th {
				width:150px;
			}
			.form-table input, .form-table textarea {
				padding:.5em 10px;
			}
		</style>
		<h3></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="modal_heading">Heading: <p>Catchy headline.</p></label></th>
				<td><input type="text" size="100" name="modal_heading" id="modal_heading" value="<?php echo get_option('modal_heading'); ?>"/></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="modal_content">Content: <p>Description of your newsletter.</p></label></th>
				<td><textarea rows="10" cols="100" style="width:auto;" name="modal_content" id="modal_content"><?php echo get_option('modal_content'); ?></textarea></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc_api_key">MailChimp API Key: <p>Learn how to generate an API key <a href="http://kb.mailchimp.com/accounts/management/about-api-keys#Find-or-Generate-Your-API-Key" target="_blank">Click Here</a></p></label></th>
				<td><input type="text" size="50" name="mc_api_key" id="mc_api_key" value="<?php echo get_option('mc_api_key'); ?>"/></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="mc_api_key">MailChimp List ID: <p><a href="http://admin.mailchimp.com/lists/" target="_blank">http://admin.mailchimp.com/lists/</a> to get your Unique ID</p></label></th>
				<td><input type="text" size="15" name="mc_list_id" id="mc_list_id" value="<?php echo get_option('mc_list_id'); ?>"/></td>
			</tr>
			<tr>
				<td><?php @submit_button(); ?></td>
			</tr>
		</table>
		
	</form>
	<?php include('mailchimp-api/inc/get-list.php'); ?>

</div>