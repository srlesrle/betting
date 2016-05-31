<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/views/view_signup.php
 *
 * Main part of /Signup webpage
 *---------------------------------------------------------------
 *
 */
?>

	<?=form_open('signup/validate', 'class="form-signin"')?>

		<?php $this->load->view('includes/view_alerts'); ?>

		<h2 class="form-signin-heading">Prijavi se na <strong>FENOMENALNO</strong></h2>

		<div><?=form_input('fullname', $this->input->post('fullname'), 'class="input-block-level" placeholder="Ime i Prezime"')?></div>

		<div><?=form_input('email', $this->input->post('email'), 'class="input-block-level" placeholder="Email Adresa"')?></div>

		<div><?=form_password('password', '', 'class="input-block-level" placeholder="&#352;ifra"')?></div>

		<p><?=form_password('c_password', '', 'class="input-block-level" placeholder="Ponovi &#353;ifru"')?></p>

		<div style="text-align: center">

			<div>
				<button type="submit" name="signup_submit" class="btn btn-large btn-primary">U&#269;lani se</button>
				<span style="vertical-align: middle"><big>&nbsp;ili&nbsp;</big><span>
				<a class="btn btn-large ajax" style="vertical-align: top; width=110px" href="<?=base_url()?>login">
					Prijavi se
				</a>
			</div>

			<br/><br/>

			<!--<p>
				<small class="vert-middle">Sign in with</small>&nbsp;
				<a type="button" class="btn btn-mini" href="<?=base_url()?>login/twitter_redirect">
					<img src="<?=base_url()?>img/icon-twitter.png" class="icon-login"/>
					<span class="vert-middle">&nbsp;Twitter</span>
				</a>
				&nbsp;
				<a type="button" class="btn btn-mini" href="<?=base_url()?>login/linkedin_redirect">
					<img src="<?=base_url()?>img/icon-linkedin.png" class="icon-login"/>
					<span class="vert-middle">&nbsp;LinkedIn</span>
				</a>
				&nbsp;
				<a type="button" class="btn btn-mini" href="<?=base_url()?>login/facebook_redirect">
					<img src="<?=base_url()?>img/icon-facebook.png" class="icon-login"/>
					<span class="vert-middle">&nbsp;Facebook</span>
				</a>
			</p>-->
			
		</div>

	<?=form_close()?>
