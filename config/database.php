<?php 

    $servername= "localhost";
    $dbusername= "root";
    $dbpassword= "123456";
    $mydb= "camagru";
    
    //$conn->exec("use camagru"); 
try { //we use to avoid getting an error that will display our server, username and posible password
     //so throwing a catch and exception avoids that, by showing only the error msg
    $conn = new PDO("mysql:host=$servername", $dbusername, $dbpassword);
    //pdo error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("CREATE DATABASE IF NOT EXISTS camagru");
    $sql->execute();
    //echo "connected to database successful\n";
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $conn->exec($sql);
    $conn->exec("use camagru");
    }
    catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
