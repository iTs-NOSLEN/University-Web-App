<!--
  -- edit_course.php
  -- Updates an existing course based on submitted data.
  -->

<?php
// Authenticate user session.	
include "./common/authenticate.php";

// Extract submitted course data.
$Code_pk = $_POST['Code_pk'];
$Title = $_POST['Title'];
$Credits = (int) $_POST['Credits'];
$DepartmentId_fk = (int) $_POST['DepartmentId_pk'];

 // Validate submitted data
 if (!preg_match("/^[A-Z]{3}[0-9]{3}$/", $Code_pk) || 
	!is_numeric($Credits) || 
	empty($DepartmentId_fk)  || 
	empty($Title)) {
	$error = urlencode("Error Updating Course: Invalid Data Format.");
	header("location: transaction_error_screen.php?error=" . $error);
	exit();
}

// Connect to database
include "./common/db_connect.php";

// Prepare SQL statement
$stmt = $conn->prepare(
	"UPDATE Courses " .
	"SET Title = ?, Credits = ?, DepartmentId_fk = ? " .
	"WHERE Code_pk = ?"
);
$stmt->bind_param("siis", $Title, $Credits, $DepartmentId_fk, $Code_pk);

try {
	// Execute SQL statement
	$stmt->execute();

	// Redirect to course list if update is successful
	header("location: list_course_maint.php");
	exit();
} catch (mysqli_sql_exception $ex) {
	// Redirect to error screen with detailed SQL error
	$error = urlencode("Error Updating Course: Missing Code!" );
	header("location: transaction_error_screen.php?error=" . $error);
	exit();
} finally {
	// Release database resources
	$stmt->close();
	$conn->close();
}
?>

