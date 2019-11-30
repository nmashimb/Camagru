<?php
     
try {
    require 'config/database.php';
    $conn->exec("use camagru");
    $sql = "CREATE TABLE IF NOT EXISTS users (
                    id int(11) AUTO_INCREMENT PRIMARY KEY,
                    username tinytext NOT NULL,
                    user_email tinytext NOT NULL,
                    user_password longtext NOT NULL,
                    vkey varchar(50) NOT NULL,
                    verified int(1) NOT NULL DEFAULT 0, 
                    likes_email int(1) NOT NULL DEFAULT 1,
                    comments_email int(1) NOT NULL DEFAULT 1)";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS gallery (
                    image_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    image_name longtext NOT NULL,
                    image_caption longtext,
                    image_uploader_id int(11) NOT NULL,
                    image_uploader_name tinytext NOT NULL,
                    image_order int(11) NOT NULL)";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS likes (
                    likes_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    image_id int(11) NOT NULL,
                    liker_id int(11) NOT NULL)";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS comments (
                    comment_id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    image_id int(11) NOT NULL,
                    commenter_id int(11) NOT NULL,
                    commenter_username tinytext NOT NULL,
                    comment longtext NOT NULL)";
    $conn->exec($sql);
    }
    catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }