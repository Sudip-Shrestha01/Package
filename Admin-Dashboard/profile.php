
<?php
$user_id = $_SESSION['user_id']
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="update.css">
</head>

<body>

    <div class="contain">
        <div class="profile">
            <i class="fas fa-times" id="form2-close"></i><br>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($query) > 0) {
                $fetch = mysqli_fetch_assoc($query);
            }

            ?>
            <img src="img/default-avatar.png" alt="">
            <h3><?php echo $fetch['username'] ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
        </div>
        </div>
</body>

</html>