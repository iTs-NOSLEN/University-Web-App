<?php
/*
 * login.php
 * Checks that a user can log into the system and creates a user session.
 */
	 
	// Connect to database.
	include "./common/db_connect.php";
	
	// Prepare sql statement to search for user with submitted username.
	$stmt = $conn->prepare("SELECT * FROM Users WHERE Username_pk = ?");
	$stmt->bind_param("s", $_POST["Username_pk"]);
	
	try {
		// Execute sql statement and fetch record data.
		$stmt->execute();
		$result = $stmt->get_result();
		$record = $result->fetch_assoc();
		
		// Encrypt submitted password.
		$hashedPassword = hash("sha256", $_POST["Password"]);
		
		// Redirect to login error screen if there is no record for the submitted
		// username or if the password is incorrect.
		if (!$record || $hashedPassword != $record["Password"]) {
			header("location:login_error_screen.php");
			exit();
		}
		
		// Create user session. 
		session_start();
		$_SESSION["Username_pk"] = $record["Username_pk"];
		$_SESSION["Type"] = $record["Type"];
		
		// Redirect to list course screen if all is ok.
		header("location: list_course_maint.php");
		exit();
	} catch (mysqli_sql_exception $ex) {
		// Display error message if query fails.
		echo "Query failed: " . $ex->getMessage();
	} finally {
		// Release database resources.
		$stmt->close();
		$conn->close();
	}
	
?>
