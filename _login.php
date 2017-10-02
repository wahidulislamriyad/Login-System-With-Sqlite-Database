<?php session_start(); /* Starts the session */

// PHP Login protection script for all pages that you want to protect from unauthorized access

if(!isset($_SESSION['UserData']['username'])) { /* Session that will expire on browser wxit. */
	if (isset($_SESSION['UserData']['username'])) {
		//Continue
	} elseif (!isset($_COOKIE["UserData"])) {
		require('login.php');
		exit;
	} elseif (isset($_COOKIE["UserData"])) { /* Cookie is for remember me option on login */
		//Continue
	} else {
		require('login.php');
		exit;
	}
}
?>