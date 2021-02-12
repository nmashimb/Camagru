
<!DOCTYPE HTML>
<HTML lang="en">
<HEAD>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
</HEAD>
<BODY>
        <H1> Gallery </H1>
            <DIV>
            <?php
                //ONLY USERS CAN SEE THE PIC UPLOAD FORM 
                if (isset($_SESSION['idofuser']) && isset($_SESSION['nameofuser']))
                {
                echo '<DIV class= "wrap-gallery">
                        <FORM action= "uploadpics.inc.php" method= "POST" enctype= "multipart/form-data">
                            <INPUT class= "input-caption" type= "text" name= "caption" placeholder= "Caption...">
                            <INPUT type= "file" name= "image">
                            <INPUT class= "input-upload" type= "submit" name= "sub" value= "Upload">
                        </FORM><BR />
                    </DIV><BR />';
                }
                ?>
                <!-- CONTAINERS THAT WILL HOLD EACH PIC IN GALLERY -->
                <?php 
                /////PAGINATION
                if (isset($_GET['start']))
                {
                    $pageno = $_GET['start'];
                }else{
                    $pageno = 1;
                }
                $pics_per_page = 5;
                $start = ($pageno - 1) * $pics_per_page;
                require 'config/database.php';
                $stmnt = $conn->prepare("SELECT COUNT(*) FROM gallery");
                $stmnt->execute();
                $row = $stmnt->fetch();
                $total_rows = $row[0];
                
                $total_pages = ceil($total_rows / $pics_per_page);
                $stmnt = $conn->prepare("SELECT * FROM gallery ORDER BY image_id DESC LIMIT $start, $pics_per_page");
                $stmnt->execute();
                ///////////////////////////////////////////////////////////////////////////////////////////////////////

                while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)){
                    //////////////LIKES//////////
                    $sqlLikes = $conn->prepare("SELECT * FROM likes WHERE image_id=?");
                    $sqlLikes->execute([$row['image_id']]);
                    $rows = $sqlLikes->fetchALL();
                    $likes = sizeof($rows); 
                    //////////////IMAGE//////////
                    echo '<A  href= "likes.inc.php?imageid='.$row['image_id'].'&picuploaderid='.$row['image_uploader_id'].'">
                    <DIV class="gallery-image" style= "background-image: url(images/gallery/'.$row['image_name'].');">
                    </DIV>';
                    if ($_SESSION['idofuser'] == $row['image_uploader_id'])
                        echo '</br>
                            <FORM action= "deleteimage.inc.php?imageid='.$row['image_id'].'" method= "POST">
                                <INPUT class= "input-login" type= "submit" name= "del" value= "Delete Image">
                            </FORM>';
                    echo '<A href= "likes.inc.php?imageid='.$row['image_id'].'&picuploaderid='.$row['image_uploader_id'].'"><H5>'.$likes.' likes</H5>
                          </A>
                        <DIV>
                            <h4>'.$row['image_uploader_name'].': '.$row['image_caption'].'</h4>
                        </DIV>';
                    ///////////// no of comment////////////
                    $sqlcmnnts = $conn->prepare("SELECT COUNT(*) FROM comments WHERE image_id=?");
                    $sqlcmnnts->execute([$row['image_id']]);
                    $noofcm = $sqlcmnnts->fetch();
                        
                    echo '<h6> '.$noofcm[0].' comment(s)</h6>';
                        /////////////COMMENTS///////////////////////////////////
                        $sqlcmnnts = $conn->prepare("SELECT * FROM comments WHERE image_id=? ORDER BY comment_id ASC");
                        $sqlcmnnts->execute([$row['image_id']]);
                        
                        while ($comments = $sqlcmnnts->fetch(PDO::FETCH_ASSOC)){
                            echo '<DIV>
                                <p class= "font-style">'.$comments['commenter_username'].': ' .$comments['comment'].'</p>
                                </DIV>';
                            }
                    /////////////////////////COMMENT SECTION
                        if ($_SESSION['idofuser']){
                            echo '<FORM action= "comments.inc.php?imageid='.$row['image_id'].'&&imageuploader='.$row['image_uploader_id'].'" method= "POST">
                                   <INPUT class= "input-caption" type= "text" name= "comment" placeholder= "Add a comment...">
                                    <INPUT class= "input-login" type= "submit" name= "subcomm" value= "Post">
                                </FORM>
                                </BR></BR>';
                        }
                }
                if ($total_pages > 1){
                    for ($i=1; $i <= $total_pages; $i++){
                        echo '<DIV class= "pagination">
                                <a href= "index.php?start='.$i.' "> '.$i.'</a>
                              </DIV >';
                    
                    }
                }
                $conn = null;
                ?>
                <!--FORM TO UPLOAD PICS-->
               
            </DIV>      
</BODY>
</HTML>