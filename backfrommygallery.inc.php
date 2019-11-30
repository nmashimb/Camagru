<?php

    session_start();
    if (isset($_SESSION['idofuser']) && isset($_POST['back']))
    {
        header("Location: ../Camagru/index.php?back=success");
        exit();
    }