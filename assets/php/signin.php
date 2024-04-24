<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

                
require ('../PHPMailer/src/Exception.php');
require ('../PHPMailer/src/PHPMailer.php');
require ('../PHPMailer/src/SMTP.php');



session_start(); 


include "db_conn.php";
include "seeactivity.php";

if (isset($_POST['infousername']) && isset($_POST['infopassword'])) {

    function validate($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }



    $username = validate($_POST['infousername']);
    $password = validate($_POST['infopassword']);

    if (empty($username)) {
        echo '
                <script>
                alert("Username is required!")
                window.location.replace("../../signin")
                </script>
                ';

        exit();
    } else if(empty($password)){
        echo '
                <script>
                alert("Password is required!")
                window.location.replace("../../signin")
                </script>
                ';

        exit();

    } else {
        $sql = "SELECT * FROM users WHERE username='$username' or email = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
              if($_SERVER["HTTP_CF_CONNECTING_IP"] !== $row['last ip']){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['lang'] = $row['lang'];
                    $email = $row['email'];
                    $lastip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                    $username = $_SESSION['username'];
                    $location = $geolocation_data['region'] . " / " . $geolocation_data['city'];
                    $userbrowser = $browser_info['browser'];
                    $userdevice = $browser_info['platform'];
                    $rowusername = $row['username'];
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();

                    $mail->Host = 'cp.rhoster.pt';
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Username = 'email';
                    $mail->Password = 'email pass';
                    $mail->Port = 465;



                    $mail->setFrom('email');
                    $mail->addAddress($row['email']); // User email
                    $mail->isHTML(true);



                    if($row['lang'] == "en"){
                        $mail->Subject = "New Device Login"; // Email Subject in English
                        $mail->Body = '<div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Dear&nbsp;<span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">'.$rowusername.',</span></span></span></span></span><br></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">We hope this message finds you well. We wanted to inform you that a login has been detected from a new device on your account. If this login was initiated by you, you can disregard this email.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">If you did not initiate this login, please take the following steps:<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><hr><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:2;text-align:left" dir="ltr"><b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Secure Your Account: </span></span></b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Change your password immediately through the account settings page.<br></span></span><b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Contact Support: </span></span></b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">If you have concerns or need further assistance, please contact our support team at </span></span><a href="mailto:info@noahpombas.ch" target="_blank"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">info@noahpombas.ch</span></span></a><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">.<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div dir="ltr" style="text-align:left;line-height:1"><hr><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><br></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="colour" style="color:#666"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Thank you for your prompt attention to this matter. We prioritize the security of your account and appreciate your cooperation.</span></span></span><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Best regards,<br></span></span></div><div style="line-height:1;text-align:left" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:13.3333px;font-style:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:left;text-indent:0;text-transform:none;widows:2;word-spacing:0;white-space:normal;line-height:1;color:#000;background-color:#fff" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Noah Pombas</span></span><br></span></span></div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:13.3333px;font-style:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:left;text-indent:0;text-transform:none;widows:2;word-spacing:0;white-space:normal;line-height:1;color:#000;background-color:#fff" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><a target="_blank" href="mailto:info@noahpombas.ch"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">info@noahpombas.ch</span></span></a><br></span></span></div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:13.3333px;font-style:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:left;text-indent:0;text-transform:none;widows:2;word-spacing:0;white-space:normal;line-height:1;color:#000;background-color:#fff" dir="ltr"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><a href="https://noahpombas.ch/" target="_blank"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">noahpombas.ch</span></span></a></span></span><br></div></div></div></div></div></div><div><br></div></div></div></div>';

                        // Activity Login Success

                        $sql = "INSERT INTO `useractivity` (`reason`, `username`, `location`, `browser`, `device`, `ip`) VALUES ('New Device Login', '$username', '$location', '$userbrowser', '$userdevice', '$lastip')";
                        $result = mysqli_query($conn, $sql);

                    }  

    

                    if($row['lang'] == "de"){
                        $subject = 'Benachrichtigung über neue Geräteanmeldung';
                        $encoded_subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
                        $mail->Subject = $encoded_subject; // Email Subject in German
                        $mail->Body = '<div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Sehr geehrte/r&nbsp;'.$rowusername.',<br></span></span></span></div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">wir hoffen, diese Nachricht erreicht Sie wohlauf. Wir m&#246;chten Sie dar&#252;ber informieren, dass eine Anmeldung von einem neuen Ger&#228;t auf Ihrem Konto erkannt wurde. Falls Sie diese Anmeldung selbst durchgef&#252;hrt haben, k&#246;nnen Sie diese E-Mail ignorieren.<br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size " style="font-size:16px"><br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Falls Sie diese Anmeldung nicht veranlasst haben, bitten wir Sie, die folgenden Schritte zu unternehmen:<br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div dir="ltr" style="line-height:1;text-align:left"><hr><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div dir="ltr" style="line-height:2;text-align:left"><b><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Sichern Sie Ihr Konto: </span></span></span></b><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">&#196;ndern Sie sofort Ihr Passwort &#252;ber die Kontoeinstellungen.<br></span></span></span></div><div dir="ltr" style="line-height:2;text-align:left"><b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Kontaktieren Sie den Support: </span></span></b><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Wenn Sie Bedenken haben oder weitere Unterst&#252;tzung ben&#246;tigen, kontaktieren Sie bitte unser Support-Team unter <a href="mailto:info@noahpombas.ch">info@noahpombas.ch</a></span></span><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><a href="mailto:info@noahpombas.ch"><br></a></span></span></span></div><div dir="ltr" style="line-height:1;text-align:left"><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div style="text-align:left;line-height:1" dir="ltr"><hr><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br><br></span></span></span></div></div><div><span class="colour" style="color:#666"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Vielen Dank f&#252;r Ihre zeitnahe Aufmerksamkeit in dieser Angelegenheit. Wir legen großen Wert auf die Sicherheit Ihres Kontos und sch&#228;tzen Ihre Mitarbeit.</span></span></span><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px">Mit freundlichen Gr&#252;&#223;en,<br></span></span></span></div><div><span class="colour" style="color:#000"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><br></span></span></span></div><div><div style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:10pt"><div dir="ltr" style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:13.3333px;font-style:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:left;text-indent:0;text-transform:none;widows:2;word-spacing:0;white-space:normal;line-height:1;color:#000;background-color:#fff"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><span class="colour" style="color:#036">Noah Pombas&nbsp;</span></span></span><br></div><div dir="ltr" style="font-family:Verdana,Arial,Helvetica,sans-serif;font-size:13.3333px;font-style:normal;font-weight:400;letter-spacing:normal;orphans:2;text-align:left;text-indent:0;text-transform:none;widows:2;word-spacing:0;white-space:normal;line-height:1;color:#000;background-color:#fff"><a href="mailto:info@noahpombas.ch" target="_blank"><span class="font" style="font-family:arial,helvetica,sans-serif"><span class="size" style="font-size:16px"><span class="colour" style="color:#036"></span></span></span></a><a target="_blank" href="mailto:info@noahpombas.ch">info@noahpombas.ch</a><br></div></div></div></div><div><span style="font-family:arial,helvetica,sans-serif" class="font"><span style="font-size:16px" class="size"><span style="color:#036" class="colour"><a href="https://noahpombas.ch" target="_blank">noahpombas.ch</a></span></span></span><br></div></div></div></div><div><br></div>';

                        // Activity Login Success

                        $sql = "INSERT INTO `useractivity` (`reason`, `username`, `location`, `browser`, `device`, `ip`) VALUES ('Benachrichtigung über neue Geräteanmeldung', '$username', '$location', '$userbrowser', '$userdevice', '$lastip')";
                        $result = mysqli_query($conn, $sql);

                    }



                    // Enable SMTP debugging
                   //  $mail->SMTPDebug = 2;
                   //  $mail->Debugoutput = 'html';

                    

                    try {
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Login issue <br> Contact us at info@noahpombas.ch <br> Thanks for your patience!";
                    }

                }  

                

                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['lang'] = $row['lang'];

                

                

                $email = $row['email'];
                $lastip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $sql = "UPDATE users SET `last ip` = '$lastip' WHERE username = '$username' AND email = '$email'";
                $result = mysqli_query($conn, $sql);

                echo '<script> window.location.replace("../../dashboard")</script>';

                exit();
            } else {

                echo '
                <script>
                alert("Username or Password is invalid!")
                window.location.replace("../../signin")
                </script>
                ';

            }



                

            } else {
                echo '
                <script>
                alert("Username or Password is invalid!")
                window.location.replace("../../signin")
                </script>
                ';

            }



        }

    } else {

    echo '<script> window.location.replace("../../signin")</script>';
    exit();
}
?>