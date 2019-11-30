<?php
session_start();
?>
<!DOCTYPE HTML>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<HTML>
<BODY>
    <HEADER>
        <DIV>
            <?php
        if (!empty($_SESSION['idofuser']) && !empty($_SESSION['nameofuser']))
        {
            echo'<DIV class= "login-bar">
                    <FORM style= "float: left" action= "mygallery.php" method= "POST">
                        <INPUT class= "input-login" type= "submit" name= "mygallery" value= "My Gallery">
                    </FORM>
                    <FORM style= "float: left" action= "cameralayout.php">
                        <INPUT class= "input-login" type= "submit" value= "Camera">
                    </FORM>
                    <FORM style= "float: left" action= "settings.php" method= POST">
                        <INPUT class= "input-login" type= "submit" name= "settings" value= "Settings">
                    </FORM>
                    <FORM style= "float: right" action= "logout.inc.php" method= "GET">
                        <INPUT class= "input-login" type= "submit" name= "logout" value= "Logout" >
                    </FORM>
                </DIV>';
        }
        else{
            echo '<DIV class= "login-bar">
                    <FORM action= "login.inc.php" method= "POST">
                        <INPUT class= "input-login" type= "text" name= "username" placeholder="Enter Username/Email">
                        <INPUT class= "input-login" type= "password" name= "passwd" placeholder= "Enter Password">
                        <INPUT class= "input-login" type= "submit" name= "submit" value= "Login"> |
                    <A href= "signup.php" style= "color: white">Sign Up</A>                  
                    </FORM>
                    
                  </DIV>';
        }
            ?>
        </DIV>
    </HEADER>
</BODY>
</HTML>