<?php
  session_start();
  include './assets/php/navbars/depency.php';

  if(isset($_SESSION['username'])){
    echo '
    <script>
    window.location.replace("dashboard")
    </script>
    ';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Noah Pombas </title>
    <link rel="shortcut icon" href="./assets/img/logo-circle.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
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
            <?php include('./assets/php/navbars/signup.php')?>
          </div>
        </div>
      </nav>


    <div class="box">
      <h2 class="signup" style="margin-top: 60px;">Sign In</h2>
      <form action="./assets/php/signin.php" method="post">

        <!-- Username Input -->

        <div class="inputGroup">
          <label class="label">Username or Email</label>
          <input type="text" name="infousername" class="input" placeholder="Type in your Email or Username" onkeypress="return event.charCode != 32" required>
        </div>



        <!-- Password Input -->

        <div class="inputGroup lastgroup">
          <label class="label">Password:</label>
          <input id="password" type="password" name="infopassword" class="input" placeholder="Insert your Password" required>
          <i class="bi bi-eye-slash text-secondary" id="togglePassword"></i>
        </div>



      <p><a href="signup" class="alreadyacc">Get started with a new account</a></p>
      <button class="btn btn-outline-light confirm" type="submit">Sign In</button>
      </form>
    </div>



    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("bi-eye");
        });

    </script>

</body>

</html>