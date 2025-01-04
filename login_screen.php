<!--
  -- login_screen.php
  -- Displays the login form and submits the user's data.
  -->

  <?php
	// Copy common header into the document.
	include "./common/header.php";
?>

		<script src="./scripts/validator.js"></script>
		<script>
			// Validates that the username and password are present and properly formatted.
			function isValidData(form) {
				let valid =
					isPresent(form.Username_pk, "Username") &&
					matchesPattern(form.Username_pk, "Username",
						/^[a-zA-Z0-9]{5,}$/) &&
					
					isPresent(form.Password, "Password") &&
					matchesPattern(form.Password, "Password",
						/^[a-zA-Z0-9]{8,}$/);
				return valid;
			}
			
			// Submits the form's data if it is valid.
			function submitData() {
				let form = document.loginForm;
				if (isValidData(form)) {
					form.submit();
				}
			}
		</script>
	</head>
	
	<body class="w3-light-grey">
		<!-- Header Section -->
		<div class="w3-container w3-center w3-red w3-padding-32">
			<i class="fa fa-university fa-3x"></i>
			<h1 class="w3-xlarge">University System Sign In</h1>
		</div>
	
		<!-- Login Form Section -->
		<div class="w3-container w3-card-4 w3-white w3-round-large" 
             style="max-width: 600px; margin: 50px auto;">
			
			<!-- Display the form and execute the login program for submitted data -->
			<form name="loginForm" method="post" action="login.php" class="w3-container">
				<!-- Username Field -->
				<div class="w3-section">
					<label class="w3-text-grey w3-large"><i class="fa fa-user"></i> Username</label>
					<input class="w3-input w3-border w3-round" type="text" name="Username_pk" 
                           placeholder="Enter your username">
				</div>
				
				<!-- Password Field -->
				<div class="w3-section">
					<label class="w3-text-grey w3-large"><i class="fa fa-lock"></i> Password</label>
					<input class="w3-input w3-border w3-round" type="password" name="Password" 
                           placeholder="Enter your password">
				</div>
				
				<!-- Submit Button -->
				<div class="w3-section w3-center">
					<input type="button" class="w3-button w3-red w3-round-large w3-xlarge" 
						   value="Sign In" onclick="submitData();">
				</div>
			</form>
		</div>
		
	</body>
</html>
