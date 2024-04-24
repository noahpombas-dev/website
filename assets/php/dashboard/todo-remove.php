<?php
session_start();
if(isset($_SESSION['username'])){
include "../db_conn.php";



$id = $_POST['id'];
$username = $_SESSION['username'];

if(isset($id)) {
    $sql = "DELETE FROM table WHERE id = '$id' AND username='$username'";
    $result = mysqli_query($conn, $sql);
    header("location: ../../../todo");
}

} else { 
    header("location: ../../../signin");
}

?>