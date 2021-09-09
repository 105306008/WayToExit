<?php session_start();

if(!isset($_SESSION['username'])){
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="boardJS.js"></script>
    <meta charset="UTF-8">
    <title>Exit</title>

    <style>
        @font-face {
            font-family: 'Zpix';
            src: url('Zpix.ttf');
        }
        body{
            /*background-color:rgb(90,108,134);*/
            /*border: 4px solid #fff;*/
            font-family: Zpix;
            overflow:auto;
        }
        div{
            background-color:rgb(90,108,134);
        }
        .middle{
            width: 1200px;
            height: 360px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .HW{
            vertical-align: top;
            display: inline-block;
            margin: -10px 0 0px 225px;
            width: 300px;
            height: 300px;
        }
        .board{
            overflow:auto;
            vertical-align: top;
            display: inline-block;
            margin: 0px 0 0px 10px;
            width: 500px;
            height: 300px;
        }
        .right{
            vertical-align: bottom;
            display: inline-block;
            margin: 0px 5px 25px 0px;
        }


        p{
            color: #fff;
        }


        a:link {
            color: #fff;
            text-decoration:none;
        }
        a:visited {
            color: #fff;
        }
        a:hover {
            color: #fff;
            text-decoration:underline;
        }
        a:active {
            color: #bababa;
        }

        input.button {
            font-family: Zpix;
            background-color: #6f84a2;
            border: none;
            color: #efefef;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius:10%;
        }
        .button:hover{
            background-color: #efefef;
            color: #27292a;
        }
        .button:active{
            background-color: #6f84a2;
            color: #efefef;
            padding: 4px 4px;
            border: 1px solid #efefef;
        }



    </style>

</head>
<body>
<!--<canvas id="canvas" width="1200" height="150" style="background-color:rgb(90,108,134)"></canvas>-->
<?php
include("pdoInc.php");
if($_SESSION['username'] != null) {
//將$_SESSION['username']丟給$id
//這樣在下SQL語法時才可以給搜尋的值
    $id = $_SESSION['username'];
//若以下$id直接用$_SESSION['username']將無法使用
    $sql = "SELECT * FROM data WHERE username = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);

    $love = $row['robot01_love'] + $row['robot02_love'] + $row['robot03_love'];
    $exit_level = $row['robot01_temPass'] + $row['robot02_temPass'] + $row['robot03_temPass'];

    if($exit_level == 3) {
        echo '<canvas id="canvas" width="1200" height="150" style="background-color:rgb(90,108,134)"></canvas>';
    } else{
        echo '<p style="color:red;position:absolute;top:10;left:10;">ExiT Isn\'t PassablE.</p>';
        return;
    }

}
?>
<div class="middle">
    <div id="square1" class="HW">
        <br>
        <div>
            <form name="form" action="" method="post">
                <p>Comment：</p>
                <textarea name="content"></textarea>
            <br><br>
                <input type="submit" value="OK" class="button">
            </form>
            <br>
            <br>
            <div>
                <p> <a href="./SpecialThx.php">Special Thanks▸</a></p>
            </div>
            <div>
                <p> <a href="./index.php">Back▸</a></p>
            </div>

        </div>


    </div>
    <div id="board" class="board">
        <?php
//
//        echo $_SESSION['username'], $_SESSION['nickname'];
//        function showComment($cmRow){
//            $nn = htmlspecialchars($cmRow['comment_nickname']);
//            $msg = htmlspecialchars($cmRow['comment_content']);
//            $msg = str_replace("\n", "<br/>", $msg);
//            $cid = $cmRow['comment_id'];
//            echo "<p>".$nn."　".$cmRow['comment_time']."　</p>";
//            echo "<p>".$msg."</p>";
//            echo "<hr>";
//
//
//            echo "<br>";
//
//        }


        if(isset($_POST['content']) && $_POST['content'] != null){
            $sth = $dbh->prepare('INSERT INTO comment (comment_username,comment_nickname, comment_content, comment_love) VALUES (?, ?, ?, ?)');
            $sth->execute(array(
                $_SESSION['username'],
                $_SESSION['nickname'],
                $_POST['content'],
                $love
            ));
//            echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
        }

//        $sql = "SELECT * FROM comment ORDER BY comment_time DESC";
//        $sth = $dbh->query($sql);
//        while($cmRow = $sth->fetch(PDO::FETCH_ASSOC)){
//            showComment($cmRow);
//        }



        ?>
    </div>


</div>


</body>

</html>


<script language="JavaScript">

    <?php
    echo 'console.log('.$exit_level.');';
    ?>

    function showMsg(){
        $("#board").load(
            "Message.php", "",
            function(){}
        );
        console.log('hey');
    }


    showMsg();
    setInterval("showMsg();", 700);
    // 按下 enter 後送出訊息


</script>