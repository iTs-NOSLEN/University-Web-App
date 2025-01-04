<!--
  -- add_user.php
  -- Adds a new user to the system based on submitted data.
  -->

<?php
	// Authenticate user session.
	include "./common/authenticate.php";
	
	// Redirect to transaction error screen if user session is not for 
	// an administrator.
	if ($_SESSION["Type"] != "A") {
		$error = urlencode("User is not an Administrator.");
		header("location: transaction_error_screen.php?error=" . $error);
		exit();
	}
	
	// Extract submitted username, password and retyped password.
	extract($_POST);
	
	// Redirect to transaction error screen if data is not properly formatted. 
	if (!preg_match("/^[a-zA-Z0-9]{5,}$/", $Username_pk) || 
			!preg_match("/^[a-zA-Z0-9]{8,}$/", $Password) ||
			$Password != $retypedPassword) {
		$error = urlencode("Error Adding User: Invalid Username or Password.");
		header("location: transaction_error_screen.php?error=" . $error);
		exit();
	}
	
  	// Connect to database.
	include "./common/db_connect.php";

	// Encrypt submitted password.
	$hashedPassword = hash("sha256", $Password);
	
	// Prepare sql statement to insert user record.
	$stmt = $conn->prepare(
			"INSERT INTO Users (Username_pk, Password, Type) " .
			"VALUES (?, ?, 'U')");
	$stmt->bind_param("ss", $Username_pk, $hashedPassword);
	
	try {
		// Execute sql statement. 
		$stmt->execute();
		
		// Redirect to list course screen if user is added.
		header("location: list_course_maint.php");
		exit();
	} catch (mysqli_sql_exception $ex) {
		// Redirect to transaction error screen if user is not added.
		$error = urlencode("Error Adding User: Duplicate Username");
		header("location: transaction_error_screen.php?error=" . $error);
		exit();
	} finally {
		// Release database resources.
		$stmt->close();
		$conn->close();
	}

?>








