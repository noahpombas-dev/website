<?php

session_start();
include '../../navbars/depency.php';
include '../../db_conn.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM Userstable WHERE username='$username' and email = '$email'";
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



if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Userstable WHERE id=$id";
    $conn->query($sql);
}


echo ' <script> window.location.replace("../../../../admin-manageusers"); </script> ';
exit;