<?php

if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['passwd']))
{
    require 'config/database.php';
    $pswd = md5($_POST['passwd']);
    if (preg_match("/^[a-zA-Z0-9]*$/", $_POST['username']))
    {//if username is inserted!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $username = $_POST['username'];
        $sql = "SELECT * FROM users WHERE username=? AND user_password=? LIMIT 1";
        $stmnt = $conn->prepare($sql);
        $stmnt->execute([$username, $pswd]);
        $row = $stmnt->fetch();
        if (!isset($row) || $row['username'] != $username || $row['verified'] == 0 || $row['user_password'] != $pswd){
            $conn = null;
            header("Location: index.php?login=failed");
            exit();
        }
        //username works: Start session, allowing us to have global variables(session variable) with some user data.
        session_start();
        $_SESSION['idofuser'] = $row['id'];
        $_SESSION['nameofuser'] = $row['username'];
        $_SESSION['emailofuser'] = $row['user_email'];
        $conn = null;
        header("Location: index.php?login=success");
        exit();
    }
    else{//if email is inserted!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $email = $_POST['username'];
        $sql = "SELECT * FROM users WHERE user_email=? AND user_password=? LIMIT 1";
        $stmnt = $conn->prepare($sql);
        $stmnt->execute([$email, $pswd]);
        $row = $stmnt->fetch();
        if (!isset($row) || $row['user_email'] != $email || $row['verified'] == 0 || $row['user_password'] != $pswd){
            $conn = null;
            header("Location: index.php?login=failed");
            exit();
        }
        //email works: Start session, allowing us to have global variables(session variable) with some user data.
        session_start();
        $_SESSION['idofuser'] = $row['id'];
        $_SESSION['nameofuser'] = $row['username'];
        $_SESSION['emailofuser'] = $row['user_email'];
        $conn = null;
        header("Location: index.php?login=success");
        exit();
    }
    $conn = null;
    header("Location: index.php?login=failed");
    exit();
}
else{
    $conn = null;
    header("Location: index.php?login=failed");
    exit();
}
