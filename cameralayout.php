<?php
    session_start();
?>
<!DOCTYPE HTML> 

<HTML>
<HEAD>
    <link rel= "stylesheet" type= "text/css" href= "style.css">
</HEAD>

<BODY>
    <header>
       <?php 
    require 'header.php'; 
       ?> 
    </header>
   
   <?php
    if (isset($_SESSION['idofuser'])){
    
    echo '<h1>My Camera </h1>
            <DIV class= "booth">
            <VIDEO id= "video" width= "400px" height= "300px"></VIDEO>
            <a href= "#" id= "capture" class= "booth-capture-button"> TAKE PHOTO</a>
            <a href= "#" id= "save" class= "booth-capture-button" onclick="withSticker()">SAVE PHOTO</a>
            <canvas id= "canvas" width="400px" height="300px"></canvas>
            <img id="ok" src= "images/stickers/ok.png" height= "50px" width= "50px">
            <img id="wow" src= "images/stickers/wow.png" height= "50px" width= "50px">
        </DIV>
    
    <FORM style= "text-align: center" action= "index.php" method= "POST">
        <INPUT class= "inputs" type= "submit" name= "galley" value= "Gallery">
    </FORM>
    <script src= "camera.js"></script>';
    }
    ?>

</BODY>
</HTML>