<?php

session_start();

include '../db_conn.php'; // Include your database connection file



if(isset($_POST['id']) && isset($_POST['checked'])) {

    





    // Sanitize input

    $id = $_POST['id'];

    $checked = $_POST['checked'];

    

    echo $id;

        echo 'gdfgdf';

    echo $checked;



    // Update the todo item in the database

    $sql = "UPDATE table SET checked='$checked' WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    

    header("refresh:0");

} else {

    echo "Invalid request";

}

?>

