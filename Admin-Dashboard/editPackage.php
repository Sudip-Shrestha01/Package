<?php include('dbconfig.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit-Packages</h4>
                    </div>
                    <div class="card-body">
                        <?php

                        $id = $_GET['id'];
                        $query = "SELECT * FROM packages where pac_id='$id' ";
                        $query_run =  mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {

                        ?>
                                <form action="pac.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="edit_id" value="<?php echo $row['pac_id']; ?>">

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
                                        <input type="text" name="description" value="<?php echo $row['pac_dec']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Price:</label>
                                        <input type="text" name="price" value="<?php echo $row['price']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Discount:</label>
                                        <input type="text" name="discount" value="<?php echo $row['discount']; ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Detail:</label>
                                        <textarea name="detail" value="<?php echo $row['pac_detail']; ?>" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Media:</label>
                                        <input type="file" name="img" class="form-control">

                                        <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>">
                                    </div><br>

                                    <img src="<?php echo "upload/" . $row['image']; ?>" width="100px"> <br><br>

                                    <button type="submit" name="edit_package_btn" class="btn btn-primary">Edit</button>

                                </form>
                        <?php
                            }
                        } else {
                            echo "No record available";
                        }


                        ?>

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