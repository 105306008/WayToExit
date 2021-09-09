<?php session_start();
if(!isset($_SESSION['username'])){
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Robot01</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
<!--    <script src="passJS.js"></script>-->
    <style>
        @font-face {
            font-family: 'Zpix';
            src: url('Zpix.ttf');
        }
        body{
            /*background-color: #27292a;*/
            /*border: 4px solid #fff;*/
            font-family: Zpix;
            overflow:auto;
        }
        div{
            background-color:rgb(90,108,134);
        }
        .middle{
            width: 1200px;
            height: 210px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .calc{
            display: inline-block;
            margin: 0px 0 0px 425px;
            width: 350px;
            height: 160px;
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

<!--<canvas id="canvas" width="1200" height="300" style="background-color:rgb(90,108,134)"></canvas>-->
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
    if(!$row['username']) {
        return;
    }
}

if(!$row['robot01_temDest']) {
    echo '<canvas id="canvas" width="1200" height="300" style="background-color:rgb(90,108,134)"></canvas>';
} else{
    echo '<p style="color:red;position:absolute;top:10;left:10;">ThindS DesTroyeD Can\'T WorK AnymorE.</p>';
    return;
}

?>
<div class="middle">


    <div class="calc">
        <div>
            <?php
            if(!$row['robot01_temPass']){
                echo '<form action="" method="post">';
                echo '<p></p><input name="answer">';
                echo '　<input type="submit" value="submit" class="button">';
                echo '</form>';
            }
            else{
                if($row['robot01_love'] > 8){
                    echo '<p>?????????????????????????</p>';
                }else if($row['robot01_love'] > 4){
                    echo '<p>Y?u\'ve ?lre??y kn?wn it?</p>';
                }else if($row['robot01_love'] > 1) {
                    echo '<p>You\'ve al?eady kno?n ?t.</p>';
                }else {
                    echo '<p>You\'ve already known it.</p>';
                }
            }
            ?>

        </div>


    </div>
    <div class="right">
        <p> <a href="./index.php">Back▸</a></p>
    </div>
</div>



</div>



</body>

</html>



<script language="JavaScript">



</script>

<?php
include ("passJS.php");
?>