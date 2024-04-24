<?php
session_start();
include '../../navbars/depency.php';
include '../../db_conn.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE username='$username' and email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!isset($_SESSION['username'])) {
    echo '
    <script>
    alert("You need to Sign-in your account!")
    window.location.replace("../../../../signin")
    </script>
    ';
} else {
    if ($row['role'] == "admin") {
      } else {
        echo '
        <script>
        alert("You do not have permission to perform this action.");
        window.location.replace("../../../../dashboard");
        </script>
        ';
      }
}





if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(!isset($_GET['id'])){
        header("location: ../../../../admin-manageusers");
        exit;
    }

    $id = $_GET['id'];
    
    // read database
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: ../../../../admin-manageusers");
        exit;
    }

    $getEmail = $row['email'];
    $getUsername = $row['username'];
    $getPassword = $row['password'];
    $getRole = $row['role'];
} else {
    
    
    
    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    

    
    $role = $_POST['role'];
    
    if (empty($id) || empty($email) || empty($username) || empty($password) || empty($role) ) {
        $errorMessage = "All the fields are required";
    } else {
        
    $sqls = "SELECT * FROM users WHERE id=$id";
    $results = $conn->query($sqls);
    
    $row = $results->fetch_assoc();

    if(!$row){
        header("location: ../../../../admin-manageusers");
        exit;
    }
    
    $getPassword = $row['password'];

    
    if($password == $getPassword){
        $hashpassword = $_POST['password'];
        $sql = "UPDATE users SET email = '$email', username = '$username', role = '$role', password = '$hashpassword' WHERE id = $id";
    } else {
        $hashpassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET email = '$email', username = '$username', role = '$role', password = '$hashpassword' WHERE id = $id";
    }
        
        
        
        $result = $conn->query($sql);
    
        if (!$result) {
             echo ' <script> window.location.replace("../../../../admin-manageusers"); </script> ';
            exit;
        } else {
            echo ' <script> window.location.replace("../../../../admin-manageusers"); </script> ';
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Noah Pombas</title>
    <link rel="stylesheet" href="../../../css/admin.css">
    <link rel="shortcut icon" href="../../../img/logo-circle.ico" type="image/x-icon">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="./" style="margin-left: 20px;">
            <img src="../../../img/logo.png" alt="https://noahpombas.giize.com/" width="40px" style="border-radius: 50%;">
            Noah Pombas</a> 
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarNav">

            <!-- navbar links configuration -->
            <?php include('../../navbars/adminassets.php')?>

          </div>
        </div>
      </nav>


    <div class="container my-5" style="margin-top: 15%!important;">
        <h2>New Client</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $getEmail?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="username" value="<?php echo $getUsername;?>">
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" value="<?php echo $getPassword;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-6">
                    <select class="form-select" name="role">
                    <?php 
                    
                    if($getRole == "user"){
                        echo '
                        <option value="admin">Administrator</option>
                        <option value="user" selected>User</option>';
                    } if($getRole == "admin") {
                        echo '
                        <option value="admin" selected>Administrator</option>
                        <option value="user">User</option>
                        ';
                    }
                    ?>
                    
                    
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                </div> 
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-danger" href="../../../../admin-manageusers" role="button">Cancel</a>
                </div> 
            </div>


        </form>
    </div>


 

</body>
</html>