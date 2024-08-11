<?php
session_start();

include "db_conn.php";
if (isset($_POST['infoemail']) && isset($_POST['infousername']) && isset($_POST['infopassword'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['infoemail']);
    $username = validate($_POST['infousername']);
    $password = validate($_POST['infopassword']);
    $role = "user";
    

    if (empty($email)) {
        echo '
        <script>
        alert("Email is required!")
        window.location.replace("../../signup")
        </script>
        ';
        exit();
    } else if (empty($username)) {
        echo '
        <script>
        alert("Username is required!")
        window.location.replace("../../signup")
        </script>
        ';
        exit();
    } else if (empty($password)) {
        echo '
        <script>
        alert("Password is required!")
        window.location.replace("../../signup")
        </script>
        ';
        exit();
    } else {

        $sqlVerification = "SELECT COUNT(*) AS verifyEmailUser FROM Userstable WHERE `username` = '$username' OR `email` = '$email' ;";
        $resultVerification = mysqli_query($conn, $sqlVerification);
            if (mysqli_num_rows($resultVerification) > 0) {
                $row = mysqli_fetch_assoc($resultVerification);
                if($row['verifyEmailUser'] > 0){
                    echo '
                    <script>
                    alert("Email or Username already exists!")
                    window.location.replace("../../signin")
                    </script>
                    ';

                } else {
                    $hashpass = password_hash($password, PASSWORD_BCRYPT);

                    $sql = "INSERT INTO `Userstable` (`email`, `username`, `password`) VALUES ('$email', '$username', '$hashpass')";
                    $result = mysqli_query($conn, $sql);
    
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    $_SESSION['lang'] = 'en';


    
                    header("Location: ../../../dashboard");
                }


                }
            }
    }
