<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/views/view_change_password.php
 *
 * Main part of /login/Change_password webpage - used for forgotten password recovery
 *---------------------------------------------------------------
 *
 */
?>

	<?=form_open('i/profile/password/validate', 'class="form-signin"')?>

		<?php $this->load->view('includes/view_alerts'); ?>

		<h2 class="form-signin-heading">Change your password</h2>

		<p><?=form_password('old_password', '', 'class="input-block-level" placeholder="Current password"')?></p>

		<p><?=form_password('password', '', 'class="input-block-level" placeholder="Password"')?></p>

		<p><?=form_password('c_password', '', 'class="input-block-level" placeholder="Confirm password"')?></p>

		<p>
		<span class="ajax"><a class="btn btn-large" href="<?=base_url()?>i/profile/edit">Cancel</a></span>
		&nbsp;
		<?=form_submit('change_password_submit', 'Set new password', 'class="btn btn-large btn-primary"')?>
		</p>

	<?=form_close()?>
