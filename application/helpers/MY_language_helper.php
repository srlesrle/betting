<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - a missing link for business dating
 *
 *---------------------------------------------------------------
 * File /application/helpers/MY_language_helper.php
 *
 * Extends language helper
 *---------------------------------------------------------------
 *
 */


function my_page_title($page, $add_str = '') {
	$title = lang('page_title_prefix');
	//$title .= ($add_before ? $add_str . lang($page) : lang($page) . $add_str);
	$title .= my_lang($page, $add_str);
	$title .= lang('page_title_postfix');
	return $title;
}


function my_lang($line, $add_str = '') {
	$result = lang($line);
	if ( ! $result) {
		$result = $line; // lang() function returns '' if there is no such line
	}
	if ($add_str) {
		$result = str_replace('%1', $add_str, $result);
	}
	return $result;
}

/* End of file /application/helpers/MY_url_helper.php */