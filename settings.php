<?php
    session_start();
    require 'header.php';
?>
<!DOCTYPE HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<HTML>
<MAIN>
<BODY>
    <?php 
        if (!empty($_SESSION['idofuser']) && !empty($_SESSION['nameofuser']))
        {
            require 'config/database.php';
            $stmnt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
            $stmnt->execute([$_SESSION['idofuser']]);
            $row = $stmnt->fetch();
            if ($row['likes_email'] == 1)
                $send_like_email = "On";
            else
                $send_like_email = "Off";
            if ($row['comments_email'] == 1)
                $send_comment_email = "On";
            else
                $send_comment_email = "Off";
            $name = $_SESSION['nameofuser'];
            echo '
                    <h1>Settings</h1>
                <DIV class= "wrap">
                                <h2 style= "text-align: center"> '.$name.' </h2>
                            <H5 style="text-align: center"> '.$_SESSION['emailofuser'].' </H5>
                        <FORM action= "settings.inc.php" method= "POST">
                            <INPUT class= "inputs" type= "text" name= "usernamevar" placeholder= "New Username">    
                            <INPUT class="input-login" type= "submit" name="cusername" value= "Change My Username">
                        </BR>
                            <INPUT class= "inputs" type= "text" name= "emailvar" placeholder= "New Email">
                            <INPUT class="input-login" type= "submit" name= "cemail" value= "Change My Email">
                        </BR>
                            <INPUT class= "inputs" type= "text" name= "passwordvar" placeholder= "New Password">
                            <INPUT class="input-login" type= "submit" name= "cpassword" value= "Change My Password">
                        </BR>
                        </BR>
                            <INPUT class="input-login" type= "submit" name= "sendemailforcomm" value= "Send Comments Email"> '.$send_comment_email.'
                        </BR>
                            <INPUT class="input-login" type= "submit" name= "sendemailforlikes" value= "Send Likes Email">  '.$send_like_email.'
                        </BR>
                        </BR>
                            <INPUT class="input-login" type= "submit" name= "back" value= "Back">
                    </FORM>
            </DIV>';
        }   
        $conn = null; 
    ?>
    <?php
    require 'footer.php';
    ?>
</FOOTER>
    </BODY>
</MAIN>
</HTML>
<FOOTER>
