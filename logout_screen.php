<!--
  -- logout_screen.php
  -- Ends user session and displays a logout message. It also displays a
  -- link to retry access to the system.
  -->

  <?php
	// Copy common header into the document.
    include "./common/header.php";
	
	// Resume user session.
	session_start();
	
	// Release session variables and end session.
	session_unset();
	session_destroy();
?>
	</head>
	
	<body class="w3-light-grey">
		<!-- Header Section -->
		<div class="w3-container w3-red w3-center">
			<h1 class="w3-xlarge">Logout Successful</h1>
		</div>

		<!-- Logout Message Section -->
		<div class="w3-container w3-white w3-card-4 w3-round-large w3-padding-32" 
             style="max-width: 600px; margin: 50px auto; text-align: center;">
			<p class="w3-xlarge w3-text-grey">
				You have successfully logged out of the University System.
			</p>
			<p class="w3-large w3-text-grey">Thank you for using our system. See you next time!</p>
			<br />
			
			<!-- Retry Login Link -->
			<a href="./login_screen.php" class="w3-button w3-red w3-round-large w3-xlarge">
				Log in Again
			</a>
		</div>

	</body>
</html>
