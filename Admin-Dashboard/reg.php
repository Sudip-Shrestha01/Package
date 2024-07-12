<?php include('dbconfig.php') ?>
<?php


// Check if form is submitted
if(isset($_POST['register_btn'])) {
   

    // Check if all fields are filled
    if(empty($_POST['username'])  || empty($_POST['password'])) {
        $_SESSION['status'] = "All fields are required";
        $_SESSION['status_code'] = "error";
        header("Location: registration.php");
        exit();
    }

    // Retrieve form data
    $name = $_POST['username'];
    $password = $_POST['password'];
    

    // Hash passwords
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // Insert data into database
    $query = "INSERT INTO admin (username, password) VALUES ('$name', '$password')";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        $_SESSION['status'] = "Registered Successfully";
        $_SESSION['status_code'] = "success";
        header("Location: adminlogin.php");
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong";
        $_SESSION['status_code'] = "error";
        header("Location: registration.php");
        exit();
    }
}
?>
