<?php

include('dbconfig.php');


if (isset($_POST['login1_btn'])) {
    // Retrieve form data
    $name = $_POST['username'];
    $password = $_POST['password'];

    // Validate if email and password are provided
    if (empty($name) || empty($password)) {
        $_SESSION['status'] = "username and password are required";
        $_SESSION['status_code'] = "error";
        header("Location: adminlogin.php"); // Redirect to the login page
        exit();
    }

    // Query the database to find the user with the provided email
    $query = "SELECT * FROM admin WHERE username='$name'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // User with provided email found, fetch user data
        $row = mysqli_fetch_assoc($result);


        // Verify the password

        if ($user = password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $user;
            // Password is correct, so start a new session
            $_SESSION['user_id'] = $row['id']; // Assuming your user table has an 'id' column
            $_SESSION['username'] = $row['username'];
            $_SESSION['status'] = "Logged in successfully";
            $_SESSION['status_code'] = "success";
            header("Location: Admin.php"); // Redirect to the user_table page
            exit();
        } else {
            // Password is incorrect
            $_SESSION['status'] = "Incorrect password";
            $_SESSION['status_code'] = "error";
            header("Location: adminlogin.php"); // Redirect to the login page
            exit();
        }
    } else {
        // User with provided email not found
        $_SESSION['status'] = "User not found";
        $_SESSION['status_code'] = "error";
        header("Location: adminlogin.php"); // Redirect to the login page
        exit();
    }
}
?>
