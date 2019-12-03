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
    <?php
        require "header.php";
    ?>
    <DIV class= "wrap">
        <H1>Sign Up</H1>
        <FORM  action= "signup.inc.php" method= "POST">
            <INPUT class= "inputs" type= "text" name="newusername" required placeholder= "Enter Username">
        <BR />
            <INPUT class= "inputs" type= "text" name= "email" required placeholder= "Enter Email Address">
        <BR />
            <INPUT class= "inputs" type= "password" name= "newuserpasswd" required placeholder= "Enter Password">
        <BR />
            <INPUT class= "inputs" type="password" name="passwdcheck" required placeholder= "Confirm Password">
        <BR />
            <INPUT class= "inputs" type= "submit" name= "submitnew" value= "Sign Up">
        </FORM>
        <BR />
        <FORM action= "emailpasswordreset.php" method= "POST">
            <INPUT class= "inputs" type= "submit" name= "resetbutt" value = "Send Password Reset Email">
        </FORM>
        <FORM action= "backfrommygallery.inc.php" method= "POST">
            <INPUT class= "input-login" type="submit" name= "backk" value= "Back">
        </FORM>
    </DIV>
    
<FOOTER id= "footer"> 
    <?PHP require 'footer.php'?>
</FOOTER>
</BODY>
</HTML>