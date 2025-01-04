<!--
  -- delete_course.php
  -- Deletes an existing course based on submitted course code.
  -->

  <?php
    // Authenticate user session.	
    include "./common/authenticate.php";
    
    // Get submitted course code.
    $Code_pk = $_POST["Code_pk"];
    
    // Redirect to transaction error screen if data is not properly formatted.
    if (!preg_match("/^[A-Z]{3}[0-9]{3}$/", $Code_pk)) {
        $error = urlencode("Error Deleting Course: Invalid Data Format.");
        header("location: transaction_error_screen.php?error=" . $error);
        exit();
    }
    
    // Connect to database.
    include "./common/db_connect.php";

    // Prepare a SQL statement to delete the course record.
    $stmt = $conn->prepare(
            "DELETE FROM Courses WHERE Code_pk = ?;");
    $stmt->bind_param("s", $Code_pk);
    
    try {
        // Execute the SQL statement.
        $stmt->execute();
        
        // Redirect to the course list maintenance screen if course is deleted.
        header("location: list_course_maint.php");
        exit();
    } catch (mysqli_sql_exception $ex) {
        // Redirect to transaction error screen if course is not deleted.
        $error = urlencode("Error Deleting Course: Missing Code");
        header("location: transaction_error_screen.php?error=" . $error);
        exit();
    } finally {
        // Release database resources.
        $stmt->close();
        $conn->close();
    }
?>
