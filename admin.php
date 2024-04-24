<?php
session_start();
include './assets/php/navbars/depency.php';
include './assets/php/db_conn.php';



$username = $_SESSION['username'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE username='$username' and email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



if (!isset($_SESSION['username'])) {
    echo '
    <script>
    alert("You need to Sign-in your account!")
    window.location.replace("signin")
    </script>
    ';

} else {

    if ($row['role'] == "admin") {
      } else {
        echo '
        <script>
        alert("You do not have permission to perform this action.");
        window.location.replace("dashboard");
        </script>
        ';

      }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Noah Pombas</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="shortcut icon" href="./assets/img/logo-circle.ico" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./" style="margin-left: 20px;">
            <img src="./assets/img/logo.png" alt="https://noahpombas.giize.com/" width="40px" style="border-radius: 50%;">
            Noah Pombas</a> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- navbar links configuration -->

            <?php include('./assets/php/navbars/admin.php')?>

          </div>
        </div>
      </nav>

      <div class="container-sm" style="margin-top: 20%; text-align: center;">

        <!-- List of Friends and Groups -->

            <div class="row">
            <div class="col-sm-5 mb-3 mb-sm-0">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">Here you can manage Users. Change Passwords, Emails and Usernames</p>
                    <a href="admin-manageusers" class="btn btn-primary">Start Managing</a>
                </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Coming Soon.</h5>
                    <p class="card-text">Hello <?php echo $row['username']?>, we are sorry but this Card is under Maintenance! <br> Do you still have questions? Contact Us: <a href="mailto:info@noahpombas.ch">info@noahpombas.ch</a></p>
                    <a href="#" class="btn btn-primary">Soon...</a>
                </div>
                </div>
            </div>
            </div>
    </div>


</body>
</html>