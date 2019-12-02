
<?php
    require "header.php";
?>
<!DOCTYPE HTML>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<HTML>
<BODY>
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
        
    </DIV>
<FOOTER> 
    <?PHP require 'footer.php'?>
</FOOTER>
</BODY>
</HTML>