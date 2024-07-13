<?php
include('dbconfig.php');


if (isset($_POST['add_package_btn'])) {
    $pacloc = $_POST['location'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $detail = $_POST['detail'];

    // File upload
    $pacimg = $_FILES['img']['name'];

    // Prepare the SQL statement with prepared statements
    $query_insert = "INSERT INTO packages (pac_loc, pac_dec, price, discount, pac_detail, image) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query_insert);
    mysqli_stmt_bind_param($stmt, 'ssddss', $pacloc, $desc, $price, $discount, $detail, $pacimg);

    // Execute the statement
    $query_insert_run = mysqli_stmt_execute($stmt);

    if ($query_insert_run) {
        // Move the uploaded file to the destination directory
        move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);

        $_SESSION['status'] = "Package Added Successfully";
        header('Location: myPackage.php');
    } else {
        $_SESSION['status'] = "Package Not Added";
        header('Location: addPackage.php');
    }
    exit();
}


//edit-package//

if (isset($_POST['edit_package_btn'])) {
    $id = mysqli_real_escape_string($conn, $_POST['edit_id']);
    $loc = mysqli_real_escape_string($conn, $_POST['location']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $det = mysqli_real_escape_string($conn, $_POST['detail']);
    $new_img = $_FILES['img']['name'];
    $old_img = mysqli_real_escape_string($conn, $_POST['old_image']);

    if ($new_img != '') {
        if (file_exists("upload/" . $new_img)) {
            $_SESSION['status'] = "Image already exists: " . $new_img;
            header("Location: myPackage.php");
            exit; // Make sure to exit after redirection
        }
    } else {
        $new_img = $old_img; // Use the old image if no new image is uploaded
    }

    $query = "UPDATE packages SET pac_loc = '$loc', pac_dec = '$desc', price = '$price', discount = '$discount', pac_detail = '$det', image = '$new_img' WHERE pac_id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if ($_FILES['img']['name']) {
            move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);
            if ($old_img && $old_img != $new_img) {
                unlink("upload/" . $old_img);
            }
        }
        $_SESSION['status'] = "Updated Successfully";
        header("Location: myPackage.php");
        exit;
    } else {
        $_SESSION['status'] = "Not Updated Successfully. Error: " . mysqli_error($conn);
        header("Location: editPackage.php");
        exit;
    }
}
//for deleting package//



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $package_id = $_POST['del_id'];
    $image_filename = $_POST['del_pac'];

    // Delete the package from the database
    $sql_delete_package = "DELETE FROM packages WHERE pac_id = ?";
    $stmt_delete_package = $conn->prepare($sql_delete_package);
    $stmt_delete_package->bind_param('i', $package_id);

    // Execute the deletion query
    if ($stmt_delete_package->execute()) {
        // Optionally, delete associated image file from server
        if (!empty($image_filename)) {
            $image_path = "upload/" . $image_filename;
            if (file_exists($image_path)) {
                unlink($image_path); // Delete file from server
            }
        }

        $_SESSION['status'] = "Package deleted successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting package.";
        $_SESSION['status_code'] = "error";
    }

    // Close statement and connection
    $stmt_delete_package->close();
    $conn->close();

    // Redirect back to myPackage.php
    header("Location: myPackage.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request method.";
    $_SESSION['status_code'] = "error";
    header("Location: myPackage.php");
    exit();
}


//for deleting booking// // Make sure to include your database configuration


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $booking_id = $_POST['delete_id'];

    // Delete the booking from the database
    $sql = "DELETE FROM booking WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $booking_id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Booking deleted successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting booking.";
        $_SESSION['status_code'] = "error";
    }

    $stmt->close();
    $conn->close();

    header("Location: bookings.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request method or booking ID not set.";
    $_SESSION['status_code'] = "error";
    header("Location: bookings.php");
    exit();
}
