<!--
  -- add_course.php
  -- Adds a new course based on submitted data.
  -->

  <?php
    // Authenticate user session.	
    include "./common/authenticate.php";
    
    // Extract submitted course data
    $Code_pk = $_POST['Code_pk'];
    $Title = $_POST['Title'];
    $Credits = (int) $_POST['Credits'];
    $DepartmentId_fk = (int) $_POST['DepartmentId_pk'];
    
    // Redirect to transaction error screen if data is not properly formatted.
    if (!preg_match("/^[A-Z]{3}[0-9]{3}$/", $Code_pk) ||
        !is_numeric($Credits)) {
        $error = urlencode("Error Adding Course: Invalid Data Format.");
        header("location: transaction_error_screen.php?error=" . $error);
        exit();
    }
    
    // Connect to database.
    include "./common/db_connect.php";
        
    // Prepare sql statement to insert course record.
    $stmt = $conn->prepare(
            "INSERT INTO Courses (Code_pk, Title, Credits, DepartmentId_fk) " .
            "VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", 
        $Code_pk, $Title, $Credits, $DepartmentId_fk);
    
    try {
        // Execute sql statement.
        $stmt->execute();
        
        // Redirect to course list maintenance screen if course was added.
        header("location: list_course_maint.php");
        exit();
    } catch (mysqli_sql_exception $ex) {
        // Redirect to transaction error screen if course could not be added.
        $error = urlencode("Error Adding Course: Code Already Exists");
        header("location: transaction_error_screen.php?error=" . $error);
        exit();
        
    } finally {
        // Release database resources.
        $stmt->close();
        $conn->close();
    }
?>
