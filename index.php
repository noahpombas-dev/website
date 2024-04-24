<?php
  session_start();
  include './assets/php/navbars/depency.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Noah Pombas</title>
    <link rel="shortcut icon" href="./assets/img/logo-circle.ico" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./" style="margin-left: 20px;">
            <img src="./assets/img/logo.png" alt="Logo" width="40px" style="border-radius: 50%;">
            Noah Pombas</a> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- navbar links configuration -->

            <?php include('./assets/php/navbars/index.php')?>
          </div>
        </div>
      </nav>
</body>
</html>