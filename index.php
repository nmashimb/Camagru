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
//author: nmashimb
    require "header.php";
    require 'config/setup.php';
?>
<DIV>
    <SECTION id= "content-wrap">
            <?php
            session_start();
            if (!empty($_SESSION['nameofuser']) && !empty($_SESSION['idofuser']))
            {
                require 'gallery.php';
            }
            else{
                require 'gallery.php';
            }
            ?>
        </SECTION>
</DIV>

<FOOTER id= "footer"> 
    <?php
        require "footer.php";
    ?>
</FOOTER>
</BODY>
</HTML>