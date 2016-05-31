<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - a missing link for business dating
 *
 * File /application/language/english/texts_lang.php
 *
 * All texts are defined in this file
 *
 *
 *--------------------------------------------------------------------------
 * Pages (documents) titles
 *--------------------------------------------------------------------------
 */

$lang['page_home_title'] = 'Welcome to Who You Meet'; // no prefix/postfix

$lang['page_title_prefix'] = ''; // not used for home page
$lang['page_title_postfix'] = ' | Who You Meet'; // not used for home page

/*
 * Pages opened from in "i" controller
 */

$lang['page_iMeet_title'] = 'People who I want to meet';
$lang['page_iMeet_person_title'] = 'I want to meet %1'; // user's fullname is inserted
$lang['page_iMeet_addperson_title'] = 'Add person I want to meet';
$lang['page_iMeet_editperson_title'] = 'Edit person';

$lang['page_meetMe_title'] = 'Users who want to meet me';
$lang['page_meetMe_user_title'] = '%1 wants to meet me'; // user's fullname is inserted

$lang['page_myProfile_title'] = 'My profile';
$lang['page_myProfile_edit_title'] = 'Edit my profile';
$lang['page_myProfile_change_passwd_title'] = 'Change your password';
$lang['page_recover_password_title'] = 'Please set your password';

$lang['page_user_title'] = '%1';

/*
 * Pages opened from in "login" controller
 */

$lang['page_login_title'] = 'Sign in to Who You Meet'; // no prefix/postfix
$lang['page_recover_passwd_title'] = 'Recover your password';

/*
 *
 *$lang['page_signup_title'] = 'Join Who You Meet today'; // no prefix/postfix
*/
$lang['page_signup_title'] = 'Join FENOMENALNO today'; // no prefix/postfix
/*
 *--------------------------------------------------------------------------
 * Forms elements
 *--------------------------------------------------------------------------
 *
 * iMeet person form
 */

$lang['form_iMeet_fullname_field'] = 'Full name';
$lang['form_iMeet_location_field'] = 'Location';
$lang['form_iMeet_web_field'] = 'Website';
$lang['form_iMeet_bio_field'] = 'Bio';
$lang['form_iMeet_email_field'] = 'Email';
$lang['form_iMeet_twitter_field'] = 'Twitter Profile';
$lang['form_iMeet_linkedin_field'] = 'LinkedIn Profile';
$lang['form_iMeet_facebook_field'] = 'Facebook Profile';
$lang['form_iMeet_reason_field'] = 'Reason to meet';

/*
 *
 * User profile form 
 */

$lang['form_profile_fullname_field'] = 'Name';
$lang['form_profile_email_field'] = 'Email';
$lang['form_profile_location_field'] = 'Location';
$lang['form_profile_web_field'] = 'Website';
$lang['form_profile_bio_field'] = 'Bio';
$lang['form_profile_interestedin_field'] = 'Interested In';

/*
 *
 * Change password form
 */

$lang['form_password_old_password_field'] = 'Current Password';
$lang['form_password_password_field'] = 'New Password';
$lang['form_password_c_password_field'] = 'Confirm Password';

/*
 *
 * Login form
 */

$lang['form_login_email_field'] = 'Email'; // same as password recovery
$lang['form_login_password_field'] = 'Password';

/*
 *
 * Signup form
 */

$lang['form_signup_fullname_field'] = 'Your name';
$lang['form_signup_email_field'] = 'Email';
$lang['form_signup_password_field'] = 'Password';
$lang['form_signup_c_password_field'] = 'Confirm Password';

/*
 *
 *--------------------------------------------------------------------------
 * Validation messages
 *--------------------------------------------------------------------------
 */

$lang['form_iMeet_twitter_validation'] = 'This is not a valid Twitter profile.';
$lang['form_iMeet_linkedin_validation'] = 'This is not a valid LinkedIn profile.';
$lang['form_iMeet_facebook_validation'] = 'This is not a valid Facebook profile.';

$lang['form_profile_email_validation'] = 'Oops! Another user has email address <strong>%1</strong>.<br />Please enter different email.';

$lang['form_recover_passwd_no_such_email'] = 'We are sorry, we have no user with such email. Please try again.';

$lang['form_signup_another_user_email'] = 'Oops! Another user has this email address.<br />Please enter another one.';

/*
 *
 *--------------------------------------------------------------------------
 * Alerts, success and error messages
 *--------------------------------------------------------------------------
 */

$lang['msg_success_verification_msg_sent'] = 'We have sent you a verification message to <strong>%1</strong>. Please check your spam folder too. Thank you!';
$lang['msg_error_cant_send_verification_msg'] = 'Oops. We could not send a verification message. Please try again.';

$lang['msg_success_verification_ok'] = 'Thank you for verifying your email address!';
$lang['msg_info_already_verified'] = 'You have already verified your email address before (or somebody else did it for you :). But thank you anyway!';
$lang['msg_alert_cant_verify_key_expired_email_resent'] = 'We cannot verify your email address, the key has expired. We have re-sent you the message - please verify your email address when you receive it. Thank you!';
$lang['msg_error_cant_verify_key_expired_cant_resend'] = 'We cannot verify your email address, the key has expired. We could not re-send verification email.<br />'.
		'Please try again.';
$lang['msg_alert_cant_verify_no_email'] = "We can't verify your email address and because don't have it - please set it.";
$lang['msg_alert_cant_verify_key_expired_logged_out'] = 'We cannot verify email address, the key has expired.';

$lang['msg_success_recovery_msg_sent'] = 'We have sent you a password recovery message to <strong>%1</strong>. Please check your spam folder too. Thank you!';
$lang['msg_error_cant_send_recovery_msg'] = 'Oops. We could not send a password recovery message. Please try again.';
$lang['msg_alert_cant_recover_key_expired'] = 'We cannot recover your password, the key has expired. Please request a new recovery message.';
$lang['msg_alert_cant_recover_signed_up'] = 'You are already signed in. Please sign out and try again.';

$lang['msg_success_passwd_changed'] = 'Your password was successfully changed.';
$lang['msg_alert_passwd_wrong'] = 'You have entered wrong password. Please try again.';
$lang['msg_alert_social_cant_disconnect_no_email'] = 'Can\'t disconnect %1 profile because no email/password is set.';
$lang['msg_alert_social_cant_connect'] = 'Can\'t connect to %1. Please try again.';
$lang['msg_alert_social_connect_declined'] = '%1 did not allow connect Who You Meet. Please try again.';
$lang['msg_alert_social_another_user'] = 'There is another user connected to your %1 profile. You can sign out and sign in again via %1.';

$lang['msg_alert_login_no_user'] = 'We are sorry, we have no user with such email and password. Please try again.';
$lang['msg_error_login_social'] = 'Oops. Cannot login or signup user. Please try again.';

$lang['msg_success_new_passwd_set'] = 'We have set your new password. Thank you! Welcome back to <strong>Who You Meet</strong>!';
$lang['msg_error_passwd_set_cant_login'] = 'We have set your password but could not sign you in. Please try again.';
$lang['msg_error_cant_set_passwd'] = 'We could not set your new password. Please try again.';

$lang['msg_success_signup_ok'] = 'Thank you for signing up to <strong>Who You Meet</strong> - you can use it right now!<br/>' .
		'<small>Please verify your email address when you receive a message.</small>';
$lang['msg_success_signup_no_email'] = 'Thank you for signing up to <strong>Who You Meet</strong> - you can use it right now!';
$lang['msg_error_signup_email_not_sent'] = 'We could not send verification email for some reason. Please re-send verification email later from your profile.';
$lang['msg_error_signup_database'] = 'Database error. We could not sign you up.<br />Please try again.';


/* End of file /application/language/english/texts_lang.php */
