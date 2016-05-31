<?=form_open('login/validate', 'class="form-signin"')?>

		<h2 class="form-signin-heading">Prijavi se na <strong>Fenomenalno</strong></h2>

		<?php $this->load->view('includes/view_alerts'); ?>

		<p><?=form_input('email', $this->input->post('email'), 'class="input-block-level" placeholder="Email adresa"')?></p>

		<p>
			<?=form_password('password', '', 'class="input-block-level" placeholder="Lozinka"')?>
			
		</p>

		<div style="text-align: center">

			<p>
				<?=form_submit('login_submit', 'Prijavi se', 'class="btn btn-large btn-primary" style="width: 110px"')?>
				<span style="vertical-align: middle"><big>&nbsp;or&nbsp;</big><span>
				<a class="btn btn-large ajax" style="vertical-align: top" href="<?=base_url()?>signup">
					Join now!
				</a>
			</p>

			<p class="ajax"><a href="<?=base_url()?>login/recover<?php if ($this->input->post('email')): ?>?email=<?=$this->input->post('email')?><?php endif; ?>">
				Zaboravio sam lozinku! UPOMO&#262;</a></p>

			<div>&nbsp;</div>

		</div>
		
	<?=form_close()?>
