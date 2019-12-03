<?php

    session_start();
    if (isset($_SESSION['idofuser']) && isset($_POST['back']))
    {
        header("Location: index.php?back=success");
        exit();
    }
    elseif(isset($_POST['backk']))
    {
        header("Location: index.php");
        exit();
    }