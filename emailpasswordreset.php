<?php
    require "header.php";
?>
<!DOCTYPE HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<MAIN>
    <DIV>
        <H1>Reset Your Password</H1>
        <FORM action= "emailpasswordreset.php" method= "POST">
        Email: <INPUT type= "text" name= "useremail" placeholder= "Enter Your Email Address">
        <INPUT type= "submit" name= "submail" value= "Send Email">
        </FORM>
    </DIV>
</MAIN>

<?php

    if (isset($_POST['useremail']) && isset($_POST['submail']))
    {
        require 'config/database.php';
        $usermail = $_POST['useremail'];
        $stmnt = $conn->prepare("SELECT * FROM users WHERE user_email= ? LIMIT 1");
        $stmnt->execute([$usermail]);
        $row = $stmnt->fetch();
        if (empty($row) || $row['verified'] == 0)
        {
            $conn = null;
            header("Location: ../Camagru/emailpasswordreset.php?error=usernotfound");
            exit();
        }
        else{//send email to reset password
            $token = $row['vkey'];
            $subject = "Reset Camagru Password";
            $message = "click <a href= 'http://localhost:8080/Camagruu/Camagru/resetpassword.inc.php?useremail=$usermail&token=$token'>HERE</a> to change your Camagru account password.";
            $headers = 'From: nonreply@camagru.com'."\r\n";
            $headers .= "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
            mail($usermail, $subject, $message, $headers);
            $conn = null;
            echo "Password Reset Email Sent!!!";
            exit();
        }
        exit();
    }
    exit();
    require 'footer.php';
?>