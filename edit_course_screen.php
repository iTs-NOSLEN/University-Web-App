<!--
  -- edit_course_screen.php
  -- Displays the edit course form and submits the course data.
  -->

  <?php
    // Authenticate user session and copy common header to document.
    include "./common/authenticate.php";
    include "./common/header.php";
    
    // Connect to database.
    include "./common/db_connect.php";
        
    // Prepare SQL statement to search for course with submitted course code.
    $stmt = $conn->prepare("SELECT * FROM Courses WHERE Code_pk = ?");
    $stmt->bind_param("s", $_POST["Code_pk"]);
    
    try {
        // Execute SQL statement.
        $stmt->execute();
        
        // Fetch record if execution was successful.
        $row_result = $stmt->get_result();
        $course_record = $row_result->fetch_assoc();
    } catch (mysqli_sql_exception $ex) {
        // Display error message if query fails.
        echo "Query failed: " . $ex->getMessage(); 
    }

    // Release database resources.
    $stmt->close();
    $conn->close();
?>

<script src="./scripts/validator.js"></script>
<script>
    // Checks that an option is selected from a list.
    function isSelected(list, name) {
        if (list.value == -1) {
            window.alert("Error! " + name + " should be selected.");
            return false;
        }
        return true;
    }
    
    // Checks that all form's data is present and properly formatted.
    function isValidData(form) {
        let valid =
            isSelected(form.DepartmentId_pk, "Department") &&
            isPresent(form.Title, "Title") &&
            matchesPattern(form.Title, "Title", /[A-Z][a-zA-Z\s]{4,49}/);

        return valid;
    }
    
    // Submits the form's data if it is valid.
    function submitData() {
        let form = document.editCourseForm;
        form.submit();
        
        if (isValidData(form)) {
            form.submit();
        }
    }
</script>

</head>

<body class="w3-light-grey">

    <!-- Header -->
    <div class="w3-panel w3-red w3-xlarge w3-center w3-padding-16">
        Edit Course
    </div>
    
    <div class="w3-container w3-white w3-padding-32 w3-round-large w3-card-4 w3-margin-top" style="width: 80%; margin: 20px auto;">
        <!-- Display the form and execute the edit course program for submitted data. -->
        <form name="editCourseForm" method="post" action="edit_course.php">
        
            <!-- Display the course code as readonly. -->
            
            <label class="w3-text-red"> <i class="fa fa-key"></i> Code</label>
            <input class="w3-input w3-border w3-round" type="text" name="Code_pk" 
                    value="<?php echo $_POST['Code_pk']; ?>" readonly>
            <hr>

            <label class="w3-text-red"><i class="fa fa-building"></i> Department</label>
            <select class="w3-select w3-border w3-round" name="DepartmentId_pk">
                <option value="-1">-Choose Department-</option>
                <?php
                    // Connect to database.
                    include "./common/db_connect.php";

                    // Create SQL statement to retrieve all departments.
                    $stmt = "SELECT DepartmentId_pk, Name FROM Departments";

                    try {
                        // Query database and add each department to the option list.
                        $result = $conn->query($stmt);

                        while($record = $result->fetch_assoc()) {
                            // Use DepartmentId_fk from course record for comparison
                            $selected = ((int)$course_record["DepartmentId_fk"] === (int)$record["DepartmentId_pk"]) ? " selected" : "";

                            echo "<option value=\"" . $record['DepartmentId_pk'] . "\"" . $selected . ">";
                            echo $record['Name'];
                            echo "</option>\n";
                        }
                    } catch (mysqli_sql_exception $ex) {
                        // Display error message if query fails.
                        echo "Query failed: " . $ex->getMessage();
                    }

                    // Close database connection.
                    $conn->close();
                ?>
            </select>

            <br><hr>
            
            <label class="w3-text-red"><i class="fa fa-graduation-cap"></i> Credits</label><br>
            <?php
                // Select the course's number of credits.
                $selected_1 = $selected_2 = $selected_3 = $selected_4 = "";
                if ($course_record['Credits'] == 1) 
                    $selected_1 = " checked";
                else if ($course_record['Credits'] == 2)
                    $selected_2 = " checked";
                else if ($course_record['Credits'] == 3)
                    $selected_3 = " checked";
                else if ($course_record['Credits'] == 4)
                    $selected_4 = " checked";
            ?>
            <input type="radio" class="w3-radio" name="Credits" 
                    value="1" <?php echo $selected_1 ?>>1</input>
            <input type="radio" class="w3-radio" name="Credits" 
                    value="2" <?php echo $selected_2 ?>>2</input>
            <input type="radio" class="w3-radio" name="Credits" 
                    value="3" <?php echo $selected_3 ?>>3</input>
            <input type="radio" class="w3-radio" name="Credits" 
                    value="4" <?php echo $selected_4 ?>>4</input>
            <br><hr>
          
            <!-- Display the course's title. -->
            <label class="w3-text-red">Title</label>
            <input type="text" class="w3-input w3-border w3-round" name="Title" 
                    value="<?php echo $course_record["Title"]; ?>"><br>
           
            <!-- Submit button -->
            <div class="w3-center">
                <input type="button" class="w3-button w3-red w3-round-large w3-xlarge" 
                        value="Submit" onclick="submitData();">
            </div>
        </form>
    </div>
    
    <?php
        // Copy common footer to document.
        include "./common/footer.php";
    ?>
</body>
</html>
