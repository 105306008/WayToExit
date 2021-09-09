<?php

include("pdoInc.php");
$sql = "SELECT * FROM comment ORDER BY comment_time DESC";
$sth = $dbh->query($sql);
while($cmRow = $sth->fetch(PDO::FETCH_ASSOC)){
    showComment($cmRow);
}

function showComment($cmRow)
{
    $nn = htmlspecialchars($cmRow['comment_nickname']);
    $msg = htmlspecialchars($cmRow['comment_content']);
    $msg = str_replace("\n", "<br/>", $msg);
    $love = 255 - $cmRow['comment_love'] * 9.5;
    if ($love <= 0) {
        $love = 0;
    }
    echo "<p style='color:rgb(255, $love, $love)'>" . $nn . "　" . $cmRow['comment_time'] . "　</p>";
    if ($cmRow['comment_nickname'] == 'robot-left' || $cmRow['comment_nickname'] == 'robot-middle' || $cmRow['comment_nickname'] == 'robot-right') {
        echo "<p style='color:rgb(255, $love, $love)'>" . $msg . "</p>";
    } else {
        echo "<p>" . $msg . "</p>";
    }
    echo "<hr>";


    echo "<br>";

}