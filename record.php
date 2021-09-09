<?php
session_start();
include("pdoInc.php");

if($_SESSION['username'] != null && isset($_POST['temX'])) {
    $id = $_SESSION['username'];

    $sql = "SELECT * FROM data WHERE username = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);

    $player_x = $_POST['temX'];
    $player_move = $_POST['moveX'];


        $sth = $dbh->prepare("UPDATE data SET player_temX = ?, player_moveX = ? WHERE username = '$id'");

        if($sth->execute(array($player_x,$player_move)))
        {
            echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
            //echo '新增成功';
        }
        else
        {
            echo 'Error';
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=self.php>';
        }




}
