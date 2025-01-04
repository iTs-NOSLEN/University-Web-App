<!--
  -- add_course_screen.php
  -- Displays the add course form and submits the course's data.
  -->

  <?php
    // Authenticate user session and copy common header to document.
    include "./common/authenticate.php";
    include "./common/header.php";
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
            isPresent(form.Code_pk, "Code") &&
            matchesPattern(form.Code_pk, "Code", /^[A-Z]{3}[0-9]{3}$/) &&
            isSelected(form.DepartmentId_pk, "Department") &&
            isPresent(form.Title, "Title") &&
            matchesPattern(form.Title, "Title", /[A-Z][a-zA-Z\s]{4,49}/);

        return valid;
    }

    // Submits the form's data if it is valid.
    function submitData() {
        let form = document.addCourseForm;
        if (isValidData(form)) {
            form.submit();  
        }
    }
</script>

</head>

<body class="w3-light-grey">

    <!-- Page Header -->
    <div class="w3-panel w3-red w3-xlarge w3-center w3-round-large">
        <i class="fa fa-plus-circle"></i> Add Course
    </div>

    <!-- Form Container -->
    <div class="w3-container w3-card-4 w3-white w3-padding-16 w3-margin-top w3-round-large w3-shadow-2">

        <!-- Display the form and execute the add course program for submitted data. -->
        <form name="addCourseForm" method="post" action="add_course.php">
            
            <!-- Course Code -->
            <div class="w3-section">
                <label for="Code_pk" class="w3-text-red"><i class="fa fa-key"></i> Code</label>
                <input class="w3-input w3-border w3-round-large" type="text" name="Code_pk" maxlength="8"
                pattern="^[A-Z]{3}[0-9]{3}$" required>
            </div>
            <hr>

            <!-- Department -->
            <div class="w3-section">
                <label for="DepartmentId_pk" class="w3-text-red"><i class="fa fa-building"></i> Department</label>
                <select class="w3-select w3-border w3-round-large" name="DepartmentId_pk" required>
                    <option value="-1">-Choose Department-</option>
                    <?php
                        // Connect to database.
                        include "./common/db_connect.php";
                        
                        // Create sql statement to retrieve all departments.
                        $stmt = "SELECT DepartmentId_pk, Name FROM Departments";
                        
                        try {
                            // Query database and add each department to the option list.
                            $result = $conn->query($stmt);
                            
                            while($record = $result->fetch_assoc()) {
                                echo "<option value=\"" . $record['DepartmentId_pk'] . "\">";
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
            </div>
            <hr>

            <!-- Credits -->
            <div class="w3-section">
                <label for="Credits" class="w3-text-red"><i class="fa fa-graduation-cap"></i> Credits</label><br>
                <input type="radio" class="w3-radio" name="Credits" value="1">1
                <input type="radio" class="w3-radio" name="Credits" value="2">2
                <input type="radio" class="w3-radio" name="Credits" value="3" checked>3
                <input type="radio" class="w3-radio" name="Credits" value="4">4
            </div>
            <hr>

            <!-- Title -->
            <div class="w3-section">
                <label for="Title" class="w3-text-red">Title</label>
                <input type="text" class="w3-input w3-border w3-round-large" name="Title" pattern="^[A-Z][a-zA-Z\s]{4,49}$" required>
            </div>

            <!-- Submit and Reset Buttons -->
            <div class="w3-container w3-padding w3-center">
                <input type="button" class="w3-button w3-dark-grey w3-round-xlarge w3-hover-shadow-large" 
                        value="Submit" onclick="submitData();">
                &nbsp;
                <input type="reset" class="w3-btn w3-light-grey w3-round-xxlarge w3-hover-shadow-large" 
                        value="Reset">
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php
        // Copy common footer to document.
        include "./common/footer.php";
    ?>
</body>
</html>
