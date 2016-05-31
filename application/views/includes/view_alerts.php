<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/views/includes/view_alerts.php
 *
 * Displays validation errors and errors/alerts/success & info messages
 * passed via flash session data
 *---------------------------------------------------------------
 *
 */
?>
<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?=$this->session->flashdata('error')?>
	</div>
<?php endif;
?>
<?php if ($this->session->flashdata('alert')): ?>
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?=$this->session->flashdata('alert')?>
	</div>
<?php endif;
?>
<?php if (validation_errors()): ?>
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?=validation_errors()?>
	</div>
<?php endif;
?>
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?=$this->session->flashdata('success')?>
	</div>
<?php endif;
?>
<?php if ($this->session->flashdata('info')): ?>
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<?=$this->session->flashdata('info')?>
	</div>
<?php endif; ?>
