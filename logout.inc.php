<?php 
    session_start();
    if (isset($_SESSION['idofuser'])){
        $_SESSION['idofuser'] = null;
        $_SESSION['nameofuser'] = null;
        $_SESSION['emailofuser'] = null;
        $conn = null;
        header("Location: index.php");
    }
    