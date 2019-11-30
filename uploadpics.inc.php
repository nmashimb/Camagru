<?php

if (isset($_POST['sub']))
{
    session_start();
    $imageCapt = $_POST['caption'];
    $image = $_FILES['image'];
    //Image uploaded contains details about it and they are retrivable for error handling
    $imageName = $image['name'];
    $imageType = $image['type'];
    $imageTempName = $image['tmp_name'];
    $imageErr = $image['error'];
    $imageSize = $image['size'];

    $imageExtArr = explode(".", $imageName);
    $imageName = $imageExtArr[0];
    $imageExt = strtolower(end($imageExtArr)); //get img type.
    $allowedType = array("jpg", "jpeg", "png");

    if (in_array($imageExt, $allowedType))
    {
        if ($imageErr == 0)
        {
            if ($imageSize < 20000000)
            {
                $nameofimg = $imageName. ".".uniqid("", true). ".".$imageExt; //use to upload
                $imageDes = "images/gallery/".$nameofimg;
                if (empty($nameofimg) || empty($imageDes)){
                    header("Location: ../Camagru/gallery.php?error=upload=empty");
                    exit();
                }
                
                require 'config/database.php';
                $uploaderID = $_SESSION['idofuser'];
                $uploaderName = $_SESSION['nameofuser'];
                $stmnt = $conn->prepare("SELECT * FROM gallery");
                $stmnt->execute();
                $rows = $stmnt->rowCount(); //no. of pics in gallery
                $ImgOrder = $rows + 1;

                $sql = "INSERT INTO gallery (image_name, image_caption, image_uploader_id, image_uploader_name, image_order) VALUES (?,?,?, ?,?)";
                $stmnt = $conn->prepare($sql);
                $stmnt->execute([$nameofimg, $imageCapt, $uploaderID, $uploaderName, $ImgOrder]);
                move_uploaded_file($imageTempName, $imageDes);
                header("Location: ../Camagru/index.php?upload=success");
                exit(); //added
            }
            else{
                echo "Image size is too big to upload!\n";
                exit();
            }
        }
        else{
            echo "Error uploading image!\n";
            exit();
        }
    }
    else{
        echo "Image type not supported!\n";
        exit();
    }
}