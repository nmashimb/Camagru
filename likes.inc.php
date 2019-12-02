<?php

    session_start();
if (isset($_SESSION['idofuser']))
{
    //require 'dbh.inc.php';
    require 'config/database.php';
    $image_id = $_GET['imageid'];
    $liker_id = $_SESSION['idofuser'];
    $image_owner_id = $_GET['picuploaderid'];

    /// get the uploaders id
    $stmnt = $conn->prepare("SELECT * from gallery WHERE image_id=? LIMIT 1");
    $stmnt->execute([$image_id]);
    $row = $stmnt->fetch();
    $likers_id = $row['image_uploader_id'];

    //check first if the user already liked the image
    $stmnt = $conn->prepare("SELECT * FROM likes WHERE image_id=? AND liker_id=? LIMIT 1");
    $stmnt->execute([$image_id, $liker_id]);
    $row = $stmnt->fetch(); 
    if (empty($row))
    {   //add a row for a new like.
        $stmnt = $conn->prepare("INSERT INTO likes (image_id, liker_id) VALUES(?, ?)");
        $stmnt->execute([$image_id, $liker_id]);
        $st = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $st->execute([$image_owner_id]);
        $row = $st->fetch();
        
        //send email to image owner
        if ($row['likes_email'] == 1 && $likers_id != $_SESSION['idofuser'])
        {
            $to = $row['user_email'];
            $subject = "Camagru: you have a new like";
            $headers = 'From: nonreply@camagru.com'."\r\n";
            $message = $_SESSION['nameofuser']. " just liked your picture.";
            mail($to, $subject, $message, $headers);
        }
        $conn = null;
        header("Location: index.php?like=success");
        exit();
    }
    else{
        $conn = null;
        header("Location: index.php?like=failed");
        exit();
    }
   
}
else {
    $conn = null;
    header("Location: index.php?likes=failure");
}
