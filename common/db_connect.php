<?php

	/*
	 * db_connect.php
	 * Creates and checks connection to the database.
	 */

	// Set authentication parameters for database.
	$db_hostname = "localhost";
	$db_username = "university_system";
	$db_password = "UprB#841";
	$db_name = "University";

	try {
		// Create connection to database.
		$conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
	}
	catch (mysqli_sql_exception $ex) {
		// End application execution if there is a connection error.
		die("Database connection failed: " . $ex->getMessage());
	}
?>