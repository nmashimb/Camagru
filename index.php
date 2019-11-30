<?php
    require "header.php";
    require 'config/setup.php';
?>
<!DOCTYPE HTML>    
<HTML>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<MAIN>
<BODY>
<DIV id= "page-container">
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
    <DIV>
        <FOOTER id= "footer"> 
            <?php
                require "footer.php";
            ?>
        </FOOTER>
    </DIV>
    </BODY>
</MAIN>

<?php
   // require "footer.php";
?>
 </HTML>