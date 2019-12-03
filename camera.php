<?php 
    session_start();
    if (isset($_POST['image']) && $_SESSION['idofuser'])
    {
        $filteredData = str_replace("data:image/png;base64,", "", $_POST['image']);
        $filteredData = str_replace(" ", "+", $filteredData);
        $unencodedData=base64_decode($filteredData);
        $image_name = "camera" . ".".uniqid("", true). '.png';
        file_put_contents('images/gallery/'.$image_name, $unencodedData);

        require 'config/database.php';
        $stmnt = $conn->prepare("SELECT * FROM gallery");
        $stmnt->execute();
        $rows = $stmnt->rowCount(); //no. of pics in gallery
        $ImgOrder = $rows + 1;
        $image_cap = "";
        $image_cap = $_POST['capt'];


        $sql = "INSERT INTO gallery (image_name, image_caption, image_uploader_id, image_uploader_name, image_order) VALUES (?,?,?, ?,?)";
        $stmnt = $conn->prepare($sql);
        $stmnt->execute([$image_name, $image_cap, $_SESSION['idofuser'], $_SESSION['nameofuser'], $ImgOrder]);
        $conn = null;
        header("Location: cameralayout.php?takephoto=success");
        exit();
        function super_impose($src,$dest,$added)
        {
            $base = imagecreatefrompng($src);
            $superpose= imagecreatefrompng($added);
            list($width, $height) = getimagesize($src);
            list($width_small, $height_small) = getimagesize($added);
            imagecopyresampled($base , $superpose,  0, 0, 0, 0, 100, 100,$width_small, $height_small);
            imagepng($base , $dest);
        }
    }

?>