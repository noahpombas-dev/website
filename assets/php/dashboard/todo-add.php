<?php

session_start();
if(isset($_SESSION['username'])){

session_start();
include "../db_conn.php";



function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

}





    $username = $_SESSION['username'];
    $title = validate($_POST['todoTitle']);
    $description = validate($_POST['todoDesc']);


    if (empty($title)) {
        echo '
                <script>
                alert("Title is required!")
                window.location.replace("../../../todo")
                </script>
                ';
        exit();
    }  else if(empty($description)){
        echo '
                <script>
                alert("Description is required!")
                window.location.replace("../../../todo")
                </script>
                ';
        exit(); 
    } else {
        if(isset($title)) {
            $sql = "INSERT INTO table (`username`, `title`, `description`) VALUES ('$username', '$title', '$description')";
            $result = mysqli_query($conn, $sql);
            header("location: ../../../todo");
        }
    }
        
} else { 
            header("location: ../../../signin");
        }



?>