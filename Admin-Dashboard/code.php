<?php

include('dbconfig.php');

if(isset($_POST['register_update_btn'])){
    $update_id = $_POST['edit_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone_number'];

    $query_update = "UPDATE packages SET fname='$fname', lname='$lname', email='$email', password='$password',phone='$phone' WHERE id='$update_id' ";

    $query_update_run = mysqli_query($conn, $query_update);
    if($query_update_run){
        // echo "Updated  Successfully!";
        $_SESSION['status'] = "Data Updated Succesfully";
        $_SESSION['status_code'] = "success";
        header("Location: index.php" );
    }
    else{
        // echo "Data not updated";
        $_SESSION['status'] = "Data Not Updated";
        $_SESSION['status_code'] = "error";
        header("Location: index.php");
    }
}

?>
