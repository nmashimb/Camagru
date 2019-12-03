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
    require 'header.php'; 
    session_start();
    if (isset($_SESSION['idofuser'])){   

    echo '<h1>My Camera </h1>
            <DIV class= "booth">
            <VIDEO id= "video" width= "400px" height= "300px"></VIDEO>
            <a href= "#" id= "capture" class= "booth-capture-button"> TAKE PHOTO</a>
            <canvas id= "canvas" width="400px" height="300px"></canvas>
            <img id="kak" src= "images/stickers/kak.png" height= "50px" width= "50px">
            <img id="ok" src= "images/stickers/ok.png" height= "50px" width= "50px">
            <img id="wow" src= "images/stickers/wow.png" height= "50px" width= "50px">
            <a href= "#" id= "save" class= "booth-capture-button" onclick="withSticker()">SAVE PHOTO</a>
            </DIV>';

    require 'config/database.php';
    $stmnt = $conn->prepare("SELECT * FROM gallery WHERE image_name like 'camera%' ORDER BY image_id DESC LIMIT 5");
    $stmnt->execute(); 
    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC))
    {
    echo '<DIV style= "float:left">
            <A  class="thumb-imag" href= "#" style= "float: right"></a>
            <DIV class="thumb-image" style= "background-image: url(images/gallery/'.$row['image_name'].');"></DIV>
            </DIV>';
    
        }
    
    echo '<BR /><FORM style= "text-align: center" action= "index.php" method= "POST">
        <INPUT class= "inputs" type= "submit" name= "galley" value= "Gallery">
    </FORM>
    <script src= "camera.js"></script>';
    }
    ?>

<FOOTER id= "footer">
    <?php require 'footer.php' ?>
</FOOTER>
</BODY>
</HTML>