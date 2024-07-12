<?php

include('dbconfig.php');


if (isset($_POST['login_btn'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate if email and password are provided
    if (empty($email) || empty($password)) {
        $_SESSION['status'] = "Email and password are required";
        $_SESSION['status_code'] = "error";
        header("Location: login.php"); // Redirect to the login page
        exit();
    }

    // Query the database to find the user with the provided email
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // User with provided email found, fetch user data
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == 1) {
            // User is deactivated, display pop-up message
            $_SESSION['status'] = "You are deactivated";
            $_SESSION['status_code'] = "error";
            header("Location: login.php"); // Redirect to the login page
            exit();
        }

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, so start a new session
            $_SESSION['user_id'] = $row['id']; // Assuming your user table has an 'id' column
            $_SESSION['email'] = $row['email'];
            $_SESSION['status'] = "Logged in successfully";
            $_SESSION['status_code'] = "success";
            header("Location: user_table.php"); // Redirect to the user_table page
            exit();
        } else {
            // Password is incorrect
            $_SESSION['status'] = "Incorrect password";
            $_SESSION['status_code'] = "error";
            header("Location: login.php"); // Redirect to the login page
            exit();
        }
    } else {
        // User with provided email not found
        $_SESSION['status'] = "User not found";
        $_SESSION['status_code'] = "error";
        header("Location: login.php"); // Redirect to the login page
        exit();
    }
}
?>
