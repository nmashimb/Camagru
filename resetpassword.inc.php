<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
</HEAD>
<BODY>
    <DIV>
    <?php
        if (isset($_GET['useremail']) && isset($_GET['token'])){
        require 'config/database.php';
        $usermail = $_GET['useremail'];
        $token = $_GET['token'];
        $stmnt = $conn->prepare("SELECT * FROM users WHERE vkey=? LIMIT 1");
        $stmnt->execute([$token]);
        $row = $stmnt->fetch();
        
        if (empty($row) || $row['verified'] == 0){
            echo "made it\n";
            $conn = null;
            header("Location: index.php");
            exit();
        }
        else{
            $conn = null;
            echo '<H1>Change Your Password</H1>
            <FORM class- "login-bar" action= "resetuserpassword.inc.php?token='.$token.'&email='.$usermail.'" method= "POST">
                <INPUT class= "inpts" type= "password" name= "newpswd" placeholder= "Enter New Password">
                <INPUT class= "inuts" type= "password" name= "newpswdconf" placeholder= "Re-Enter New Password">
                <INPUT class= "input-login" type= "submit" name= "sub" value= "Change Password">
            </FORM>';
        }
    }
    ?>
    </DIV id= "footer">
    <FOOTER><?php require 'footer.php'?></FOOTER>
</BODY>
