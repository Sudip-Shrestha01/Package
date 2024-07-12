<?php

include('dbconfig.php');

// // Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     // Redirect to login page or handle unauthorized access
//     header("Location: login.php");
//     exit();
// }

// Get user's status from the database
// $user_id = $_SESSION['user_id'];
// $query = "SELECT status FROM user WHERE id = $user_id";
// $result = mysqli_query($conn, $query);

// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $user_status = $row['status'];

//     // Check user's status and handle accordingly
//     if ($user_status != 1) {
//         // Redirect the user to a different page or display a message as per your requirement
//         echo "<script>console.log('You are deactivated')</script>";
//         // Redirect to a different page
//         header("Location: user_table.php");
//         exit();
//     }
// }

// If the user's status is active, you can proceed with updating the status if needed
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    $updatequery1 = "UPDATE user SET status = $status WHERE id = $id";

    mysqli_query($conn, $updatequery1);  // Run the query to update data in database table
    
    header('Location: user_table.php');
    exit();
}
?>
