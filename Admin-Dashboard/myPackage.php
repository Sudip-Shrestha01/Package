<?php include('includes/header.php') ?>
<?php include('dbconfig.php') ?>
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
$query = "SELECT * FROM packages LIMIT $offset, $records_per_page";
$query_run = mysqli_query($conn, $query);
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
        <li class="active">
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



    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>myPackages</h2>
                    </div>
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

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">EDIT</th>
                                    <th scope="col">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    $serial_number = ($page - 1) * $records_per_page + 1;

                                    foreach ($query_run as $row) {
                                        // echo $row['pac_id'];
                                ?>


                                        <tr>
                                            <td><?php echo $serial_number++; ?></td>
                                            <td><?php echo $row['pac_id'];  ?></td>
                                            <td>
                                                <img src="<?php echo "upload/" . $row['image'];  ?>" width="100px" alt="Image">
                                            </td>
                                            <td><?php echo $row['pac_loc'];  ?></td>
                                            <td>Rs.<?php echo $row['price'];  ?></td>
                                            <td>Rs.<?php echo $row['discount'];  ?></td>

                                            <td>
                                                <a href="editPackage.php?id=<?php echo $row['pac_id']; ?> " <i class='bx bxs-edit' style="color:black; font-size:1.2rem; display:flex; justify-content:center"></i></a>
                                            </td>
                                            <td>
                                                <form action="pac.php" method="POST" class="delete-form">
                                                    <input type="hidden" name="del_id" value="<?php echo $row['pac_id']; ?>">
                                                    <input type="hidden" name="del_pac" value="<?php echo $row['image']; ?>">
                                                    <button type="button" class="delete-btn" style="color: white;">
                                                        <i class="fa-solid fa-trash" style="font-size:1.2rem;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8">No record available</td>
                                    </tr>
                                <?php
                                }

                                ?>


                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <?php
                        $query_pagination = "SELECT COUNT(*) AS total FROM packages";
                        $result_pagination = mysqli_query($conn, $query_pagination);
                        $row_pagination = mysqli_fetch_assoc($result_pagination);
                        $total_records = $row_pagination['total'];
                        $total_pages = ceil($total_records / $records_per_page);
                        ?>
                        <div class="text-center">
                            <ul class="pagination justify-content-center">
                                <!-- Previous Button -->
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="myPackage.php?page=<?php echo ($page - 1); ?>">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="myPackage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>
                                <!-- Next Button -->
                                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="myPackage.php?page=<?php echo ($page + 1); ?>">Next</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');

            // Iterate over each delete button
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    const pacId = form.querySelector('input[name="del_id"]').value;
                    const pacImage = form.querySelector('input[name="del_pac"]').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this package!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form for deletion
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <?php include('includes/footer.php') ?>