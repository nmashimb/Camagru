<?php

if (isset($_POST['newpswd']) && isset($_POST['newpswdconf']) && isset($_POST['sub']))
    {
        $password = $_POST['newpswd'];
        $newpswdconf = $_POST['newpswdconf'];
        $vkey = $_GET['token'];
        $email = $_GET['email'];
        if ($password != $newpswdconf)
        {
            header("Location: resetpassword.inc.php?useremail=$email&token=$vkey&passwordchange=fail");
            exit();
        }
        $lowercase = preg_match('@[a-z]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $specialchars = preg_match('@[^\w]@', $password); //\w means [a-zA-Z0-9_]
        $numbers = preg_match('@[0-9]@', $password);
        if (!$lowercase || !$uppercase || !$numbers || !$specialchars || strlen($password) < 8)
        {
            header("Location: resetpassword.inc.php?useremail=$email&token=$vkey&passwordchange=failed");
            exit();
        }
        require 'config/database.php';
        $stmnt = $conn->prepare("SELECT * FROM users WHERE user_email=? AND vkey=?");
        $stmnt->execute([$email, $vkey]);
        $row = $stmnt->fetch();
        if (empty($row))
        {
            $conn = null;
            header("Location: index.php?passwordchange=failed");
            exit();
        }
        $stmnt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=? AND vkey=?");
        $stmnt->execute([md5($password), $email, $vkey]);
        $conn = null;
        header("Location: index.php?passwordchange=success");
        exit();
    }