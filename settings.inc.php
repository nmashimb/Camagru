<?php
    session_start();
    if ((isset($_SESSION['idofuser']) && isset($_SESSION['nameofuser'])) && (isset($_POST['sendemailforcomm']) || isset($_POST['sendemailforlikes']) || isset($_POST['cusername']) || isset($_POST['cemail']) || isset($_POST['cpassword']) || isset($_POST['back'])))
    {
        if (isset($_POST['cusername']) && empty($_POST['usernamevar']))
        {
            header("Location: ../Camagru/settings.php");
            exit();
        }
        if (isset($_POST['cemail']) && empty($_POST['emailvar']))
        {
            header("Location: ../Camagru/settings.php");
            exit();
        }
        if (isset($_POST['cpassword']) && empty($_POST['passwordvar']))
        {
            header("Location: ../Camagru/settings.php");
            exit();
        }
        require 'config/database.php';
        $id = $_SESSION['idofuser'];
        $stmnt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stmnt->execute([$id]);
        $row = $stmnt->fetch();
        if (empty($row))
        {
            $conn = null;
            header("Location: ../Camagru/settings.php");
        }
        if (isset($_POST['back']))
        {
            header("Location: ../Camagru/index.php?back=success");
            exit();
        }
        if ($_POST['sendemailforcomm'])
        {
            $stmnt = $conn->prepare("SELECT * from users WHERE id=?");
            $stmnt->execute([$_SESSION['idofuser']]);
            if ($row['comments_email'] == 1){
                $turn_off = 0;
                $stmnt = $conn->prepare("UPDATE users SET comments_email=? WHERE id=?");
                $stmnt->execute([$turn_off, $_SESSION['idofuser']]);
                $conn = null;
                header("Location: ../Camagru/settings.php?commentsemail=success");
                exit();
            }
            if($row['comments_email'] == 0){
                $turn_on = 1;
                $stmnt = $conn->prepare("UPDATE users SET comments_email=? WHERE id=?");
                $stmnt->execute([$turn_on, $_SESSION['idofuser']]);
                $conn = null;
                header("Location: ../Camagru/settings.php?commentsemail=success");
                exit();
            }
        }
        if ($_POST['sendemailforlikes'])
        {
            $stmnt = $conn->prepare("SELECT * from users WHERE id=?");
            $stmnt->execute([$_SESSION['idofuser']]);
            if ($row['likes_email'] == 1){
                $turn_off = 0;
                $stmnt = $conn->prepare("UPDATE users SET likes_email=? WHERE id=?");
                $stmnt->execute([$turn_off, $_SESSION['idofuser']]);
                $conn = null;
                header("Location: ../Camagru/settings.php?likesemail=success");
                exit();
            }
            else{
                $turn_on = 1;
                $stmnt = $conn->prepare("UPDATE users SET likes_email=? WHERE id=?");
                $stmnt->execute([$turn_on, $_SESSION['idofuser']]);
                $conn = null;
                header("Location: ../Camagru/settings.php?likesemail=success");
                exit();
            }
        }
        if ($_POST['cusername'] && $_POST['usernamevar'])
        {
            $username = $_POST['usernamevar'];
            if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && strlen($username) > 2)
            {
                $conn = null;
                header("Location: ../Camagru/signup.php?error=invalidusername");
                exit();
            }
            $stmnt = $conn->prepare("UPDATE users SET username=? WHERE id=?");
            $stmnt->execute([$username, $id]);
            $_SESSION['nameofuser'] = $username;
            $conn = null;
            header("Location: ../Camagru/settings.php?username=changessucceeded");
        }
        if ($_POST['cemail'] && $_POST['emailvar'])
        {
            $email = $_POST['emailvar'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $conn = null;
                header("Location: ../Camagru/settings.php?error=invalidemail");
                exit();
            }
            $stmnt = $conn->prepare("UPDATE users SET user_email=? WHERE id=?");
            $stmnt->execute([$email, $id]);
            $_SESSION['emailofuser'] = $email;
            $conn = null;
            header("Location: ../Camagru/settings.php?email=changessucceeded");
        }
        if ($_POST['cpassword'] && $_POST['passwordvar'])
        {
            $password = $_POST['passwordvar'];
            $lowercase = preg_match('@[a-z]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $specialchars = preg_match('@[^\w]@', $password); //\w means [a-zA-Z0-9_]
            $numbers = preg_match('@[0-9]@', $password);
            if (!$lowercase || !$uppercase || !$numbers || !$specialchars || strlen($password) < 8)
            {
                $conn = null;
                header("Location: ../Camagru/settings.php?error=weakpassword");
                exit();
            }
            $password = md5($_POST['passwordvar']);
            $stmnt = $conn->prepare("UPDATE users SET user_password=? WHERE id=?");
            $stmnt->execute([$password, $id]);
            $conn = null;
            header("Location: ../Camagru/settings.php?password=changessucceeded");
            exit();
        }
        else{
            exit();
        }
    }