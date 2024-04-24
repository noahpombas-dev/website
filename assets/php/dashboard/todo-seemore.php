<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db_conn.php";
include '../navbars/depency.php';


if(isset($_SESSION['username'])){
    if(isset($_POST['id'])) {
        
        $id = $_POST['id'];
        $username = $_SESSION['username'];
        
        $sql = "SELECT * FROM table WHERE id = '$id' AND username='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    
        $title = $row['title'];
        $description = $row['description'];
    } else {
        echo '<script> window.location.replace("../../../todo") </script>';
    }

} else { 
   echo '<script> window.location.replace("../../../signin") </script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo List - Noah Pombas</title>
  <link rel="stylesheet" href="../../css/dashboard/todo.css">
  <link rel="shortcut icon" href="../../img/logo-circle.ico" type="image/x-icon">
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="./" style="margin-left: 20px;">
          <img src="../../img/logo.png" alt="https://noahpombas.giize.com/" width="40px" style="border-radius: 50%;">
          Noah Pombas</a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

          <!-- navbar links configuration -->

          <?php include('../navbars/todo.php')?>
        </div>
      </div>
    </nav>






<div class="container mt-5" >
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="todo-box" style="margin-top: 200px;">
        <h3><?php echo $title; ?></h3>
        <ul class="todo-list " >

            <li class="todo-item">
                <label for="todo1" style="max-width: 550px; word-wrap: break-word; padding: 5px;">
                    <?php echo $description?>
                </label>
                 
            </li>
            <a class="btn btn-outline-primary" href="../../../todo">Get Back</a>
            
        </ul>
        
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>