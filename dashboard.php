<?php

session_start();
include './assets/php/navbars/depency.php';

if (!isset($_SESSION['username'])) {

  echo '
    <script>
    alert("You need to Sign-in your account!")
    window.location.replace("signin")
    </script>
    ';
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Noah Pombas</title>
  <link rel="stylesheet" href="./assets/css/dashboard.css">
  <link rel="shortcut icon" href="./assets/img/logo-circle.ico" type="image/x-icon">

</head>
<body>

  <nav class="navbar fixed-top navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./" style="margin-left: 20px;">
        <img src="./assets/img/logo.png" alt="https://noahpombas.giize.com/" width="40px" style="border-radius: 50%;">
        Noah Pombas</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>



      <div class="collapse navbar-collapse" id="navbarNav">



        <!-- navbar links configuration -->

        <?php include ('./assets/php/navbars/dashboard.php') ?>



      </div>
    </div>
  </nav>



  <div class="container-sm" style="margin-top: 20%; text-align: center;">

    <!-- List of Friends and Groups -->

    <div class="row">
      <div class="col-sm-5 mb-3 mb-sm-0">



        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ToDo List</h5>
            <p class="card-text">Make your ToDo List!</p>
            <a class="btn btn-primary" href="todo">Start List</a>
          </div>
        </div>





        <div class="card" style="margin-top: 20px;">
          <div class="card-body">
            <h5 class="card-title">Change Language</h5>
            
            <form method="POST">
              <select class="form-select" name="langselector">



                <?php

                $username = $_SESSION['username'];
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM users WHERE email = '$email' or username = '$username';";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                if ($row['lang'] == "en") {
                  echo '
                            <option value="en" selected>English</option>
                            <option value="de">Deutsch</option>
                            ';
                } else {
                  echo '
                        <option value="en">English</option>
                        <option value="de" selected>Deutsch</option>
                            ';
                }
                ?>
              </select>
              <br>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
          </div>
        </div>
      </div>



      <div class="col-sm-5 mb-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nothing here yet!</h5>
            <p class="card-text">!</p>
            <a class="btn btn-primary disabled" href="#" disabled>nothing much</a>
          </div>
        </div>



        <div class="card" style="margin-top: 20px;">
          <div class="card-body">
            <h5 class="card-title">Account Activity</h5>
            <p class="card-text">See your account Activity!</p>
            <p class="card-text">Is this really you?</p>
            <a class="btn btn-primary" href="activity">See Activity</a>
          </div>
        </div>
      </div>
    </div>
</body>
</html>


<?php

if (isset($_POST['langselector'])) {

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if ($_POST['langselector'] == "en") {

    $sql = "UPDATE users SET lang = 'en' WHERE email = '$email' or username = '$username';";
    $result = mysqli_query($conn, $sql);
    header("refresh:0");

  } else {

    $sql = "UPDATE users SET lang = 'de' WHERE email = '$email' or username = '$username';";
    $result = mysqli_query($conn, $sql);
    header("refresh:0");

  }
}

?>