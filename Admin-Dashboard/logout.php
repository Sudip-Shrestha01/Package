<?php include('dbconfig.php');  ?>
<?php
// Check if logout button is clicked

    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header('location: adminlogin.php');
    exit(); // Terminate script
?>