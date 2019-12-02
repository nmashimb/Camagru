<!DOCTYPE HTML>
<MAIN>
    <DIV>
    <?php
        if (isset($_GET['useremail']) && isset($_GET['token'])){
        require 'config/database.php';
        $usermail = $_GET['useremail'];
        $token = $_GET['token'];
        $stmnt = $conn->prepare("SELECT * FROM users WHERE vkey=? LIMIT 1");
        $stmnt->execute([$token]);
        $row = $stmnt->fetch();
        
        if (empty($row) || $row['verified'] == 0){
            echo "made it\n";
            $conn = null;
            header("Location: index.php");
            exit();
        }
        else{
            $conn = null;
            echo '<H1>Change Your Password</H1>
            <FORM action= "resetuserpassword.inc.php?token='.$token.'&email='.$usermail.'" method= "POST">
            <!-- Old Password: <INPUT type= "password" name= "oldpswd" placeholder= "Enter Old Password"> -->
            New Password: <INPUT type= "password" name= "newpswd" placeholder= "Enter New Password">
            Confirm Password: <INPUT type= "password" name= "newpswdconf" placeholder= "Re-Enter New Password">
            <INPUT type= "submit" name= "sub" value= "Change Password">
            </FORM>';
        }
    }
    require 'footer.php'; 
    ?>
    </DIV>
</MAIN>
