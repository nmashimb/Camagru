<?php
ECHO "dddd";
   if (isset($_POST["submitnew"]))
    {
        require 'config/database.php';
        $username = $_POST['newusername'];
        $email = $_POST['email'];
        $password = $_POST['newuserpasswd'];
        $psswrdcheck = $_POST['passwdcheck'];
        
        $lowercase = preg_match('@[a-z]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $specialchars = preg_match('@[^\w]@', $password); //\w means [a-zA-Z0-9_]
        $numbers = preg_match('@[0-9]@', $password);
        if (empty($username) || empty($email) || empty($password) || empty($psswrdcheck)){
            $conn = null;
            header("Location: signup.php?error=emptyfields&email=".$email);
            exit();
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username) && strlen($username) > 2){
            $conn = null;
            header("Location: signup.php?error=invalidusernameandemail");
            exit();
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $conn = null;
            header("Location: signup.php?error=invalidemail");
            exit();
        }/*check if username valid, if it has letters or numbers, nothing else*/
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username) && strlen($username) > 2){
            $conn = null;
            header("Location: signup.php?error=invalidusername&email=".$email);
            exit();
        }
        elseif ($password != $psswrdcheck){
            $conn = null;
            header("Location: signup.php?error=passwordsdontmatch");
            exit();
        }
        elseif (!$lowercase || !$uppercase || !$numbers || !$specialchars || strlen($password) < 8)
        {
            $conn = null;
            header("Location: signup.php?error=weakpassword");
            exit();
        }
        else
        {   //now that everything is valid 
            $stmntone = $conn->prepare("SELECT username FROM users WHERE username= :user");
            $prm = array(':user' => $username);
            $stmntone->execute($prm);
            $rows = $stmntone->fetchAll();
            //checking if username is taken
            if (!empty($rows)){
                $conn = null;
                header("Location: signup.php?error=usernametaken");
                exit();
            }
            else{//now we insert the data in our table
                //password has to be hashed first before stored.
                $vkey = md5(time().$username);  
                $stmnt = $conn->prepare("INSERT INTO users (username, user_email, user_password, vkey)
                                        VALUES(?, ?, ?, ?)");
                $stmnt->execute([$username, $email, md5($password), $vkey]);
    
                //send verification email
                $subject = "Email Verification";
                $message = "Thank you for making a Camagru account click  
                <a href= 'http://localhost:8080/Camagru/verify.inc.php?user= $username&vkey=$vkey'>HERE</a> to register your account.";
                //sending content type because i use html in message
                $headers = 'From: nonreply@camagru.com'."\r\n";
                $headers .= "MIME-Version: 1.0"."\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                mail($email, $subject, $message, $headers);
                $stmnt = null;
                echo "Account Verification Email Sent!\n";
            }
        }
    }