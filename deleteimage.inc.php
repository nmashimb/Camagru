<?php

session_start();

if (isset($_SESSION['idofuser']) && isset($_POST['del']))
{
    require 'config/database.php';
    $image_id = $_GET['imageid'];
    $stmnt = $conn->prepare("DELETE FROM gallery WHERE image_id=? AND image_uploader_id=? LIMIT 1");
    $stmnt->execute([$image_id, $_SESSION['idofuser']]);
    $conn = null;
    ///CAN I DELETE THE PIC FROM FOLDER TOO??????
    header("Location: index.php?delimage=success");
    exit();
}