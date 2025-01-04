<!--
  -- transaction_error_screen.php
  -- Displays a transaction error message.
  -->

  <?php
	// Authenticate user session and copy common header into document.
	include "./common/authenticate.php";
    include "./common/header.php";
?>
	</head>
	
	<body class="w3-light-grey">
		<!-- Header Section -->
		<div class="w3-container w3-red w3-center w3-padding-32">
			<i class="fa fa-exclamation-circle fa-3x"></i>
			<h1 class="w3-xlarge">Transaction Error</h1>
		</div>

		<!-- Error Message Section -->
		<div class="w3-container w3-white w3-card-4 w3-round-large w3-padding-32" 
             style="max-width: 600px; margin: 50px auto; text-align: center;">
			<p class="w3-xlarge w3-text-grey">
				<i class="fa fa-times-circle w3-text-red"></i> 
				<?php echo $_GET["error"]; ?>
			
		<!-- Footer Section -->
		<?php
			// Copy common footer into document.
			include "./common/footer.php";
		?>
	</body>
</html>
