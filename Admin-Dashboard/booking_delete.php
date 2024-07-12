<?php
include('dbconfig.php');


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
?>
