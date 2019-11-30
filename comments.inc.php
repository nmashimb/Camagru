<?php
    session_start();
    
    if (isset($_SESSION['idofuser']) && isset($_POST['subcomm']))
    {
        require 'config/database.php';
        $comment = $_POST['comment'];
        $commenter_id = $_SESSION['idofuser'];
        $commenter_username = $_SESSION['nameofuser'];
        $image_id = $_GET['imageid'];
        $image_uploader_id = $_GET['imageuploader'];
        ///////CHECK COMMENT FOR VALIDATION BEFORE INSERTING
        $erro_chrs = preg_match('@[<->]@', $comment);
        if ($erro_chrs == 1)
        {
            $conn = null;
            header("Location: ../Camagru/index.php?comment=failure");
            exit();
        }
        ///////////////////////////////////////////////////
        $stmnt = $conn->prepare("INSERT INTO comments (image_id, commenter_id, commenter_username, comment) VALUES (?, ?, ?, ?)");
        $stmnt->execute([$image_id, $commenter_id, $commenter_username, $comment]);
        echo "comment added\n";
        $stmnt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmnt->execute([$image_uploader_id]);
        $row = $stmnt->fetch();
        echo $row['user_email'];
        if ($row['comments_email'] == 1 && $commenter_id != $image_uploader_id)
        {
            $to = $row['user_email'];
            $subject = "Camagru: you have a new comment";
            $headers = 'From: nonreply@camagru.com'."\r\n";
            $message = $_SESSION['nameofuser']. " just commented on one of your pictures.";
            mail($to, $subject, $message, $headers);
        }
        $conn = null;
        header("Location: ../Camagru/index.php?comment=success");
        exit();
    }