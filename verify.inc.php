<!-- verify account, after email link clicked-->
<?php
echo "sdsd";
if (!empty($_GET['user']) && !empty($_GET['vkey'])){

    require 'config/database.php';
    $verkey = $_GET['vkey'];
    $sql = "SELECT id, vkey, verified FROM users WHERE verified= ? AND vkey= ? LIMIT 1";
    $res = $conn->prepare($sql);
    $res->execute([0, $verkey]);
    $row = $res->fetch();
    if ($verkey = $row['vkey'] && $row['verified'] == 0)
    {
        $user_id = $row['id'];
        $ver_update = $conn->prepare("UPDATE users SET verified =:ver WHERE id=:id");
        $data = [':ver'=>"1", ':id'=>$user_id];
        $ver_update->execute($data);
        $conn = null;
        header("Location: index.php");
        exit();
   }
   else{
        $conn = null;
        header("Location: index.php");
        exit();
   }
}
else{
    exit();
}