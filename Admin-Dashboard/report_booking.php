<?php
include('dbconfig.php');


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: adminlogin.php");
    exit();
}

// Handle form submission and get booking data
$report_data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $month = $_POST['month'];
    $year = $_POST['year'];

    $start_date = "$year-$month-01";
    $end_date = date("Y-m-t", strtotime($start_date)); // Get the last day of the selected month

    $sql = "SELECT COUNT(*) AS total_bookings FROM booking WHERE arrival_date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);

    if ($result) {
        $report_data = $result->fetch_assoc();
    } else {
        die("Error: " . $conn->error); // Debugging SQL error
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- SIDEBAR -->
    	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">ExploreUnseen</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="Admin.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="addPackage.php" target="_blank">
					<i class='bx bxs-shopping-bag'></i>
					<span class="text">Add Package</span>
				</a>
			</li>
			<li>
				<a href="myPackage.php">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">My Package</span>
				</a>
			</li>

			<li>
				<a href="message.php">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="user_table.php">
					<i class='bx bxs-user-account'></i>
					<span class="text">Users</span>
				</a>
			</li>
			<li>
				<a href="bookings.php">
					<i class='bx bxs-group'></i>
					<span class="text">Bookings</span>
				</a>
			</li>
			<li class="active">
				<a href="report_booking.php">
					<i class='bx bxs-group'></i>
					<span class="text">Report Booking</span>
				</a>
			</li>

		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
				
                </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
           
            <?php 
            $sel = "SELECT * FROM admin ";
            $run = mysqli_query($conn,$sel);
            $row = mysqli_fetch_assoc($run);
            ?>

            <span class="text" style="font-size: 0.7rem; color:green"><b><?php echo $row['username']; ?></b></span>
            <a href="" class="icons">
                <i class="fa-solid fa-user" id="profile-btn"></i>
                </div>

        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Booking Report</h1>
                    <ul class="dash">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Booking Report</a>
                        </li>
                    </ul>
                </div>
            </div>

            <form method="post" action="">
                <label for="month">Select Month:</label>
                <select name="month" id="month" required>
                    <option value="" disabled selected>Select Month</option>
                    <?php
                    for ($m=1; $m<=12; $m++) {
                        $monthName = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                        echo "<option value='".sprintf("%02d", $m)."'>$monthName</option>";
                    }
                    ?>
                </select>

                <label for="year">Select Year:</label>
                <select name="year" id="year" required>
                    <option value="" disabled selected>Select Year</option>
                    <?php
                    for ($y=2020; $y<=date('Y'); $y++) {
                        echo "<option value='$y'>$y</option>";
                    }
                    ?>
                </select>

                <button type="submit">Get Report</button>
            </form>

            <?php if (!empty($report_data)) : ?>
                <div class="report-result">
                    <h2>Report for <?php echo date("F, Y", strtotime("$year-$month-01")); ?>:</h2>
                    <p>Total Bookings: <?php echo $report_data['total_bookings']; ?></p>
                </div>
            <?php endif; ?>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
	<?php include('includes/footer.php'); ?>

<?php
// Close connection
$conn->close();
?>
