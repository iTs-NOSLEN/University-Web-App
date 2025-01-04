<!--
  -- list_course_maint.php
  -- Displays the list of courses in the university system.
  -->

  <?php
	// Authenticate session and copy common header to document.
	include "./common/authenticate.php";
	include "./common/header.php";
?>

		<!-- Dispatch the appropriate program based on the user selection. -->
		<script>
			// Dispatches the add_course_screen program.
			function addCourse() {
				dispatch("add_course_screen.php");
			}

			// Dispatches the edit_course_screen program.
			function editCourse(Code_pk) {
				document.UniversityForm.Code_pk.value = Code_pk;
				dispatch("edit_course_screen.php");
			}

			// Dispatches the delete_course program if confirmed by user.
			function deleteCourse(Code_pk) {
				let confirmed = 
					window.confirm("Are you sure you want to delete the course with code " + 
								Code_pk + "?");
				if (confirmed) {
					document.UniversityForm.Code_pk.value = Code_pk;
					dispatch("delete_course.php");
				}
			}

			// Sets the form's action attribute to a program and submits data.
			function dispatch(program) {
				let form = document.UniversityForm;
				
				form.action = program;
				form.submit();
			}
		</script>
	</head>

	<body class="w3-light-grey">
		<!-- Header -->
		<div class="w3-panel w3-red w3-xxlarge w3-center w3-padding-16">
			<i class="fa fa-list-alt"></i> Course List
		</div>
		<div class="w3-panel w3-red w3-large w3-padding-8 w3-round">
			<i class="fa fa-user"></i> User: <?php echo $_SESSION["Username_pk"] ?>
		</div> 
		
		<div class="w3-container">
		
			<!-- Display the university course form. -->
			<form class="w3-card-4 w3-white w3-round w3-padding-16" name="UniversityForm" method="post" action="">
			
				<!-- Create a hidden field with the course code to be used for edit and delete. -->
				<input type="hidden" name="Code_pk" value="">
				
				<!-- Display a link to add a new course. -->
				<div class="w3-margin-bottom">
					<i class="fa fa-plus-circle fa-2x w3-text-red handPointer"
						onclick="addCourse();"> Add Course</i>
				</div>
				
				<!-- Display a responsive table with the data of each course. -->
				<div class="w3-responsive">
					<table class="w3-table-all w3-hoverable">
						<tr class="w3-red">
							<th>Code</th>
							<th>Department</th>
							<th>Title</th>
							<th class="w3-center">Credits</th>
							<th class="w3-center">Edit</th>
							<th class="w3-center">Delete</th>
						</tr>
						
						<?php
							// Displays an icon to edit the course with the given code.
							function show_edit_icon($Code_pk) {
								echo "<td class=\"w3-center\">";
								echo "<i class=\"fa fa-edit w3-text-green fa-2x handPointer\" ";
								echo "onclick=\"editCourse('$Code_pk');\"></i>";
								echo "</td>";
							}
							
							// Displays an icon to delete the course with the given code.
							function show_delete_icon($Code_pk) {
								echo "<td class=\"w3-center\">";
								echo "<i class=\"fa fa-trash w3-text-red fa-2x handPointer\" ";
								echo "onclick=\"deleteCourse('$Code_pk');\"></i>";
								echo "</td>";
							}
							
							// Connect to database.
							include "./common/db_connect.php";
							
							// Create SQL statement to retrieve all courses.
							$stmt = "SELECT c.Code_pk, d.Name, c.Title, c.Credits " .
									"FROM Courses c " .
									"JOIN Departments d " .
									"ON c.DepartmentId_fk = d.DepartmentId_pk";

							try {
								// Query database and display each course and action icons.
								$result = $conn->query($stmt);
								$rowcount = $result->num_rows;
								
								while($record = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>" . $record["Code_pk"] . "</td>";
									echo "<td>" . $record["Name"] . "</td>";
									echo "<td>" . $record["Title"] . "</td>";
									echo "<td class=\"w3-center\">" . $record["Credits"] . "</td>";
									
									show_edit_icon($record["Code_pk"]);
									show_delete_icon($record["Code_pk"]);
									echo "</tr>\n";
								}
							} catch (mysqli_sql_exception $ex) {
								// Display error message if query fails.
								echo "<tr><td colspan='6' class='w3-center'>Query failed: " . $ex->getMessage() . "</td></tr>";
							}
							
							// Close database connection.
							$conn->close();
						?>
					</table>
					<div class="w3-panel w3-red w3-large w3-padding-8 w3-round">
						<i class="fa fa-info-circle"></i> There are <?php echo $rowcount ?> courses in the system.
					</div>
				</div>
			 </form>
		</div>
		
		<?php
			// Copy common footer to document.
			include "./common/footer.php";
		?>
		
	</body>
</html>
