<?php include('includes/header.php') ?>

<?php include('active.php') ?>

<?php
// Retrieve records per page
$records_per_page = 5;

// Initialize page number
$page = 1;

// Check if page number is set and numeric
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
	$page = $_GET['page'];
}

// Calculate offset
$offset = ($page - 1) * $records_per_page;

// here  initializing sorting order
$sort_order = 'DESC';

// Query to retrieve limited records based on pagination
$query = "SELECT * FROM message LIMIT $offset, $records_per_page";
$query_run = mysqli_query($conn, $query);

$register = "SELECT * FROM message ORDER BY name ASC";
$register_run = mysqli_query($conn, $register);
?>

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

		<li class="active">
			<a href="#">
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
			<a href="logout.php" class="logout">
				<i class='bx bxs-log-out-circle'></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>

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
		$run = mysqli_query($conn, $sel);
		$row = mysqli_fetch_assoc($run);
		?>

		<span class="text" style="font-size: 0.7rem; color:green"><b><?php echo $row['username']; ?></b></span>
		<a href="" class="icons">
			<i class="fa-solid fa-user" id="profile-btn"></i>
			</div>

	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">
				<div class="card">
					<div class="card-header">
						<h2>Message-From-Visitor</h2>
					</div>
					<div class="card-body">
						<?php
						if (isset($_SESSION['status']) && $_SESSION != '') {
						?>

							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								<strong>Hey!</strong><?php echo $_SESSION['status']; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php
							unset($_SESSION['status']);
						}
						?>

						<div class="card-body">
							<?php


							if (mysqli_num_rows($register_run) > 0) {
							?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">S.N</th>

											<th scope="col">Name</th>
											<th scope="col">Email</th>
											<th scope="col">Number</th>
											<th scope="col">Subject</th>
											<th scope="col">Message</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$serial_number = ($page - 1) * $records_per_page + 1;
										while ($reg_row = mysqli_fetch_array($register_run)) {


										?>
											<tr>
												<td><?php echo $serial_number++; ?></td>

												<td><?php echo $reg_row['name']; ?></td>
												<td><?php echo $reg_row['email']; ?></td>
												<td><?php echo $reg_row['number']; ?></td>
												<td><?php echo $reg_row['subject']; ?></td>
												<td><?php echo $reg_row['message']; ?></td>

											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php
							} else {
								echo "No records found";
							}
							?>

							<!-- Pagination -->
							<?php
							$query_pagination = "SELECT COUNT(*) AS total FROM message";
							$result_pagination = mysqli_query($conn, $query_pagination);
							$row_pagination = mysqli_fetch_assoc($result_pagination);
							$total_records = $row_pagination['total'];
							$total_pages = ceil($total_records / $records_per_page);
							?>
							<div class="text-center">
								<ul class="pagination justify-content-center">
									<!-- Previous Button -->
									<li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
										<a class="page-link" href="message.php?page=<?php echo ($page - 1); ?>">Previous</a>
									</li>
									<?php for ($i = 1; $i <= $total_pages; $i++) { ?>
										<li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
											<a class="page-link" href="message.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
										</li>
									<?php } ?>
									<!-- Next Button -->
									<li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
										<a class="page-link" href="message.php?page=<?php echo ($page + 1); ?>">Next</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php include('includes/footer.php') ?>