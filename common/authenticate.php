<?php
	/*
	 * authenticate.php
	 * Authenticates the user session.
	 */

    // Resume user session.
	session_start();
	
	// Redirect to login screen if there is no user session.
	if (!isset($_SESSION["Username_pk"]) || !isset($_SESSION["Type"])) {
		header("location: login_screen.php");
		exit();
	}
?>