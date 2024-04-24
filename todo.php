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
  <title>ToDo - Noah Pombas</title>
  <link rel="stylesheet" href="./assets/css/dashboard/todo.css">
  <link rel="shortcut icon" href="./assets/img/logo-circle.ico" type="image/x-icon">
</head>
<body>
    <style>
    .checked {
      text-decoration: line-through;
    }
  </style>
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

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="todo-box" style="margin-top: 200px;">
        <h3><?php echo $_SESSION['username']?> Todo List</h3>
        <ul class="todo-list">
        <?php

          $username = $_SESSION['username'];
          $sql = "SELECT * FROM usertodo WHERE `username`='$username'";
          $result = $conn->query($sql);


          while ($row = $result->fetch_assoc()) {

            $id = $row['id'];
            $checked = $row['checked'];
            $title = $row['title'];

            echo '<li class="todo-item '.($checked == 1 ? 'checked' : '').'">
                    <input class="form-check-input" type="checkbox" id="todo'.$id.'" onchange="updateTodo('.$id.', this.checked)" '.($checked == 1 ? 'checked' : '').'>
                    <label for="todo'.$id.'">'.$title.'</label>
                    <form class="ms-auto"  action="assets/php/dashboard/todo-seemore.php" method="post">
                      <input type="hidden" name="id" value='.$id.'>
                      <button class="btn btn-outline-success" style="margin-right: 10px; margin-bottom: -20px;">See More</button>
                    </form>
                    
                    <form class="ms-right" action="assets/php/dashboard/todo-remove.php" method="post">
                      <input type="hidden" name="id" value='.$id.'>
                      <button class="btn btn-outline-danger" style="margin-bottom: -20px;">X</button>
                    </form>
                  </li>
                  <hr style="border-top: 1px solid black; margin: 10px 0;">';
          }
        ?>
        </ul>
        <form class="mt-3" action="assets/php/dashboard/todo-add.php" method="post">
          <div class="mb-3">
            <label for="newTodo" class="form-label">Add New Todo</label>
            <input type="text" class="form-control" name="todoTitle" placeholder="Title">
            <br>
            <input type="text" class="form-control" name="todoDesc" placeholder="Description">
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function updateTodo(id, checked) {
    // Toggle the checked status
    var newChecked = checked ? 1 : 0;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        location.reload();
      }
    };
    xhttp.open("POST", "assets/php/dashboard/todo-update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&checked=" + newChecked);
  }
</script>


</body>
</html>
