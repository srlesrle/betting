
		<?php echo form_open('admin/login/validate_credentials'); ?>
		<table id="myTable" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			<tr>
				<td>user:</td>
				<td><input type="text" name="username" value="<?php echo set_value('username'); ?>" /></td>
			</tr>
			<tr>
				<td>pass:</td>
				<td><input type="password" name="pass" value="<?php echo set_value('pass'); ?>" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" class="button" value="submit" /></td>
			</tr>
		</table>
		<?php echo form_close(); ?>
	