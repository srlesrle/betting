<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - a missing link for business dating
 *
 * File /application/language/english/emails_lang.php
 *
 * All emails templates are defined in this file
 *
 */

$lang['email_from_WYM'] = 'Who You Meet team';
$lang['email_WYM_signature'] = '<p>Who You Meet team.</p>';
$lang['email_hi_user'] = '<p>Hi %1!</p><br />';

/*
 *--------------------------------------------------------------------------
 * Send verification email after signup
 *--------------------------------------------------------------------------
 */

$lang['email_send_verification_subject'] = 'Please verify your email address at Who You Meet';
$lang['email_send_verification_thanks'] = '<p>Thank you for signing up to <strong>Who You Meet</strong>!</p>';
$lang['email_send_verification_link'] = '<p><a href="%1">Please click here</a> to verify your email address.</p><br />';

/*
 *--------------------------------------------------------------------------
 * Resend verification email
 *--------------------------------------------------------------------------
 */

$lang['email_resend_verification_subject'] = 'Please verify your email address at Who You Meet';
$lang['email_resend_verification_thanks'] = '<p>Thank you for using <strong>Who You Meet</strong>!</p>';
$lang['email_resend_verification_link'] = '<p><a href="%1">Please click here</a> to verify your email address.</p><br />';

/*
 *--------------------------------------------------------------------------
 * Send recovery email
 *--------------------------------------------------------------------------
 */

$lang['email_send_recovery_subject'] = 'Who You Meet: password recovery requested';
$lang['email_send_recovery_text'] = '<p>You (or somebody else) requested to recover the password you use to sign in to <strong>Who You Meet</strong>.</p>';
$lang['email_send_recovery_link'] = '<p>If you did it, <a href="%1">please click here</a> to set a new password.</p><br />';
$lang['email_send_recovery_link_reset'] = '<p>If you did not request to recover your password, <a href="%1">please check if you can sign in</a>.</p><br />';
$lang['email_send_recovery_thanks'] = '<p>Thank you</p>';


/* End of file /application/language/english/emails_lang.php */