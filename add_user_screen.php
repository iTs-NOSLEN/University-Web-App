<!--
  -- add_user_screen.php
  -- Displays the add-user form and submits the user's data.
  -->

  <?php
    // Authenticate user session.
    include "./common/authenticate.php";
    
    // Redirect to transaction error screen if user is not an administrator.
    if ($_SESSION["Type"] != "A") {
        $error = urlencode("User is not an Administrator.");
        header("location: transaction_error_screen.php?error=" . $error);
        exit;
    }
    
    // Copy common header into document.
    include "./common/header.php";
?>

<script src="./scripts/validator.js"></script>
<script>
    // Checks that two text boxes have the same contents.
    function equalContents(textBox1, name1, textBox2, name2) {
        if (!(textBox1.value === textBox2.value)) {
            window.alert("Error! " + name1 + " and " + name2 + " should be equal.");
            return false;
        }
        return true;
    }

    // Checks username and password are present and properly formatted.
    // Also checks that retyped password is equal to original password.
    function isValidData(form) {
        let valid =
            isPresent(form.Username_pk, "Username") &&
            matchesPattern(form.Username_pk, "Username", /^[a-zA-Z0-9]{5,}$/) &&
            
            isPresent(form.Password, "Password") &&
            matchesPattern(form.Password, "Password", /^[a-zA-Z0-9]{8,}$/)  &&
            
            equalContents(form.Password, "Password", 
                            form.retypedPassword, "Retyped Password");
        return valid;
    }

    // Submits the form's data if it is valid.
    function submitData() {
        let form = document.addUserForm;
        
        if (isValidData(form)) {
            form.submit();
        }
    }
</script>

</head>

<body class="w3-light-grey">

    <!-- Page Header -->
    <div class="w3-panel w3-red w3-xlarge w3-center w3-round-large w3-padding-16">
        <i class="fa fa-user-plus"></i> Add User
    </div>

    <!-- Form Container -->
    <div class="w3-container w3-card-4 w3-white w3-padding-16 w3-margin-top w3-round-large w3-shadow-2">

        <!-- Display the form and execute the add user program for submitted data. -->
        <form name="addUserForm" method="post" action="add_user.php">
            
            <!-- Username Input Field -->
            <div class="w3-section">
                <label for="Username_pk" class="w3-text-red"><i class="fa fa-user"></i> Username</label>
                <input class="w3-input w3-border w3-round-large" type="text" name="Username_pk" required>
            </div>
            <hr>

            <!-- Password Input Field -->
            <div class="w3-section">
                <label for="Password" class="w3-text-red"><i class="fa fa-lock"></i> Password</label>
                <input class="w3-input w3-border w3-round-large" type="password" name="Password" required>
            </div>
            <hr>

            <!-- Retype Password Input Field -->
            <div class="w3-section">
                <label for="retypedPassword" class="w3-text-red"><i class="fa fa-key"></i> Retype Password</label>
                <input class="w3-input w3-border w3-round-large" type="password" name="retypedPassword" required>
            </div>
            <br>

            <!-- Submit and Reset Buttons -->
            <div class="w3-container w3-padding w3-center">
                <input type="button" class="w3-button w3-red w3-round-xlarge w3-hover-shadow-large" 
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
