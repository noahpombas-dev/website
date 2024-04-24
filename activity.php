<?php
  session_start();
  include './assets/php/navbars/depency.php';
  if(!isset($_SESSION['username'])){
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
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarNav">

            <!-- navbar links configuration -->
            <?php include('./assets/php/navbars/nothing.php')?>

          </div>
        </div>
      </nav>

      <style>
    * {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    .container { 
        margin-top: 10%;
        
    }

    

    .box {
      background-color: #0c0c0c;
      border-radius: 12px;
      padding: 20px; /* Add padding for content */
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .box p {
      flex: 1;
      text-align: center;
      margin: 0;
      padding: 5px; /* Add padding for content */
    }

    .box p:not(:last-child) {
      border-right: 1px solid #ccc;
    }

    p { 
        color: white;
    }

    p strong {
      color: blue;
    }
  </style>

<?php

include 'assets/php/seeactivity.php';


$sql = "SELECT *, DATE_FORMAT(DATE_ADD(`timestamp`, INTERVAL 1 HOUR), '%d.%m.%y %H:%i') AS formatted_timestamp FROM useractivity WHERE `username` = '" . $_SESSION['username'] . "' ORDER BY id DESC LIMIT 20";

$result = $conn->query($sql);




echo '

<div class="container">
  <div class="row">
    <div class="col-md-12">
    
';


while ($row = $result->fetch_assoc()) {

    echo '
        
        <div class="box">
          <p>' . $row['reason'] . '</p>
          <p>Location: <strong>' . $row['location'] . '</strong></p>
          <p>Browser: <strong>' . $row['browser'] . '</strong></p>
          <p>Device: <strong>' . $row['device'] . '</strong></p>
          <p>IP: <strong>' . $row['ip'] . '</strong></p>
          <p>'. $row['formatted_timestamp'] .'</p>
        </div>
    ';
}

?>


        </div>
      </div>
    </div>
</body>
</html>