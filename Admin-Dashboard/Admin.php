<?php include('dbconfig.php'); ?>
<?php
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
	header("Location: adminlogin.php");
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


	<title>AdminHub</title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">ExploreUnseen</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
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
			<li>
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
		<!--Profile Section -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="dash">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-package'></i>
					<span class="text">

						<p>Available Packages
							<?php
							$dash_package_query = "SELECT * from packages ";
							$dash_package_query_run = mysqli_query($conn, $dash_package_query);

							if ($package_total = mysqli_num_rows($dash_package_query_run)) {
								echo '<h3>' . $package_total . '</h3>';
							} else {
								echo '<h3>No Package Available!</h3>';
							}
							?>
						</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-user-account'></i>
					<span class="text">

						<p>Total User
							<?php
							$dash_user_query = "SELECT * from user ";
							$dash_user_query_run = mysqli_query($conn, $dash_user_query);

							if ($user_total = mysqli_num_rows($dash_user_query_run)) {
								echo '<h3>' . $user_total . '</h3>';
							} else {
								echo '<h3>No User Available!</h3>';
							}
							?>
						</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">

						<p>Total Booking
							<?php
							$dash_user_query = "SELECT * from booking ";
							$dash_user_query_run = mysqli_query($conn, $dash_user_query);

							if ($user_total = mysqli_num_rows($dash_user_query_run)) {
								echo '<h3>' . $user_total . '</h3>';
							} else {
								echo '<h3>No User Available!</h3>';
							}
							?>
						</p>
					</span>
				</li>
			</ul>
		</main>
	</section>
	<?php include('includes/footer.php'); ?>