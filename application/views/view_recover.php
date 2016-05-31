<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/views/view_recover.php
 *
 * Main part of /login/Recover webpage
 *---------------------------------------------------------------
 *
 */
?>

	<?=form_open('login/recover/validate', 'class="form-signin"')?>

		<h2 class="form-signin-heading">Povratite lozinku</h2>

		<?php $this->load->view('includes/view_alerts'); ?>

		<p><?=form_input('email', (isset($email) ? $email : ''), 'class="input-block-level" placeholder="Email adresa"')?></p>

		<p><?=form_submit('login_submit', 'Posalji', 'class="btn btn-large btn-primary"')?></p>

		<p class="ajax"><a href="<?=base_url()?>login">Znam lozinku Prijavi se</a></p>

	<?=form_close()?>
