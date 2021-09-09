<?php
session_start();
include("pdoInc.php");

if($_SESSION['username'] != null && isset($_POST['temX'])) {
    $id = $_SESSION['username'];

    $sql = "SELECT * FROM data WHERE username = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);
    $robot_love = $row['robot01_love'] + $row['robot02_love'] + $row['robot03_love'];

    $player_x = $_POST['temX'];
    $player_move = $_POST['moveX'];


    $sth = $dbh->prepare("UPDATE data SET player_temX = ?, player_moveX = ? WHERE username = '$id'");
    $sth->execute(array($player_x,$player_move));


    if($_POST['robot_love'])
    {
        $des = $dbh->prepare('INSERT INTO comment (comment_username,comment_nickname, comment_content, comment_love) VALUES (?, ?, ?, ?)');

        if($_POST['robot02_temDest']){
            $temDest = $_POST['robot02_temDest'];
            $love = $row['robot02_love'] + 1;
            $sth = $dbh->prepare("UPDATE data SET robot02_temDest = ?, robot02_love = ?, robot02_temPass=? WHERE username = '$id'");
            $des->execute(array(
                $_SESSION['username'],
                'robot-middle',
                'Warning!! Be careful of'.$_SESSION['nickname'].'!!!',
                $robot_love
            ));

        }else if($_POST['robot03_temDest']){
            $temDest = $_POST['robot03_temDest'];
            $love = $row['robot03_love'] + 1;
            $sth = $dbh->prepare("UPDATE data SET robot03_temDest = ?, robot03_love = ?, robot03_temPass=? WHERE username = '$id'");
            $des->execute(array(
                $_SESSION['username'],
                'robot-right',
                'You break the rule, '.$_SESSION['nickname'],
                $robot_love
            ));

        }else if($_POST['robot01_temDest']){
            $temDest = $_POST['robot01_temDest'];
            $love = $row['robot01_love'] + 1;
            $sth = $dbh->prepare("UPDATE data SET robot01_temDest = ?, robot01_love = ?, robot01_temPass=? WHERE username = '$id'");
            $des->execute(array(
                $_SESSION['username'],
                'robot-left',
                $_SESSION['nickname'].', don\'t destroy others, okay?',
                $robot_love
            ));

        }
        if($love > 9){ $love = 9; }
        $sth->execute(array($temDest,$love,$temDest));

        echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
        //echo '新增成功';
    }
    else
    {
        echo 'Error';
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=self.php>';
    }




}
