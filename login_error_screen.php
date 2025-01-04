<!--
  -- login_error_screen.php
  -- Displays the login error message for invalid login attempts.
  -->

  <?php
	// Copy common header into the document.
    include "./common/header.php";
?>
	</head>
	
	<body class="w3-light-grey">
		<!-- Main container  -->
		<div class="w3-container w3-center w3-card-4 w3-white w3-round-large w3-padding-32" 
             style="max-width: 600px; margin: 100px auto;">
			
			<!-- Display the login error icon and message -->
			<div class="w3-text-red">
				<i class="fa fa-times-circle fa-5x"></i>
			</div>
			<h2 class="w3-text-red">Invalid Username or Password!</h2>
			
			<!-- Display a link to retry access to the system -->
			<p class="w3-text-grey w3-large">
				Click <a href="./login_screen.php" class="w3-text-red w3-hover-text-grey">Here</a> to Log in Again.
			</p>
		</div>
	</body>
</html>
