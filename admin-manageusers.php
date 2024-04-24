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
  <title>Admin Manage Users - Noah Pombas</title>
  <link rel="stylesheet" href="./assets/css/admin.css">
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

        <?php include ('./assets/php/navbars/subadmin.php') ?>

      </div>
    </div>
  </nav>


  <div class='container my-5' style="margin-top: 15%!important;">
    <h2>List of Users</h2>
    <br>
    <br>
    <table class='table'>
      <thead>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Username</th>
          <th>Role</th>
          <th>Operations</th>
        </tr>
      </thead>
      <?php

      $sql = "SELECT * FROM users";
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()) {
        echo "
            <tbody>
            <tr>
                <td>$row[id]</td>
                <td>$row[email]</td>
                <td>$row[username]</td>
                <td>$row[role]</td>
                <td>
                    <a class='btn btn-primary btn-md' href='assets/php/admin/usermanage/edituser?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-md' href='assets/php/admin/usermanage/deleteuser?id=$row[id]'>Delete</a>
                </td>
            </tr>     
            </tbody>
        ";
      }
      ?>

    </table>
  </div>
</body>
</html>