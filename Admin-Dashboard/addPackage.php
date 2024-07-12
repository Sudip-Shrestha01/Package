<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add PAckage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Packages</h4>
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
                        <form action="pac.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Location:</label>
                                <select name="location" id="location" required class="form-control">
                                    <option value="Kathmandu">Kathmandu</option>
                                    <option value="Pokhara">Pokhara</option>
                                    <option value="Lumbini">Lumbuni</option>
                                    <option value="Kalinchowk">Kalinchowk</option>
                                    <option value="Janakpur">Janakpur</option>
                                    <option value="Chitwan">Chitwan</option>
                                    <option value="Shailung">Shailung</option>
                                    <option value="Rara">Rara</option>
                                    <option value="Solukhumbu">Solukhumbu</option>
                                    <option value="Manakamana">Manakamana</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Description:</label>
                                <input type="text" name="description" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Price:</label>
                                <input type="text" name="price" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Discount:</label>
                                <input type="text" name="discount" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Detail:</label>
                                <textarea name="detail" required class="form-control"></textarea>
                            </div>



                            <div class="form-group">
                                <label for="">Media:</label>
                                <input type="file" name="img" required class="form-control">
                            </div><br>


                            <button type="submit" name="add_package_btn" class="btn btn-primary">submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>