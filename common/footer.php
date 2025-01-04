<!--
  -- footer.php
  -- Common footer for html documents.
  -->

  <footer class="w3-container w3-padding-32 w3-center w3-dark-grey w3-round-large">
    <?php
        // Display add user option only for administrators.
        if ($_SESSION["Type"] == 'A') {
            echo "<span class=\"w3-button w3-red w3-round-large w3-hover-shadow handPointer\" ";
            echo "onclick=\"window.location='add_user_screen.php';\">";
            echo "<i class=\"fa fa-plus-circle\"></i> Add User</span>";
            echo "&nbsp; | &nbsp;";
        }
    ?>
    <!-- Display the list and logout options for all users. -->
    <span class="w3-button w3-grey w3-round-large w3-hover-shadow handPointer" 
          onclick="window.location='list_course_maint.php';">
        <i class="fa fa-clipboard"> Course List</i> 
    </span>
    &nbsp; | &nbsp;
    <span class="w3-button w3-red w3-round-large w3-hover-shadow handPointer" 
          onclick="window.location='logout_screen.php';">
        <i class="fa fa-sign-out"> Log Off</i> 
    </span>
</footer>
