<?php 
    session_start();
    if (isset($_SESSION['idofuser'])){
    session_unset(); //takes all session var created, deletes all data in sess var
    session_destroy(); //destroy current sessions running in website
    header("Location: index.php");
    }
    