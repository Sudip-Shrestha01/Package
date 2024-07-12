<?php include('dbconfig.php') ?>
<?php


$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_fname = mysqli_real_escape_string($conn, $_POST['update_fname']);
   $update_lname = mysqli_real_escape_string($conn, $_POST['update_lname']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE signin SET fname = '$update_fname', lname = '$update_lname', email = '$update_email' WHERE id = '$user_id'") or die('query failed');




}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="update.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM signin WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

      <form action="" method="post">
      <div class="flex">
         <div class="inputBox">
            <img src="p-1.jpg" alt="">
            <span>fname :</span>
            <input type="text" name="update_fname" value="<?php echo $fetch['fname']; ?>" class="box">
            <span>lname :</span>
            <input type="text" name="update_lname" value="<?php echo $fetch['lname']; ?>" class="box">
            <span>your email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            
            <!-- <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box"> -->
         </div>
      </div>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a href="home.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>