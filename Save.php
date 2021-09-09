<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="saveJS.js"></script>
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
            height: 310px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .calc{
            display: inline-block;
            margin: 10px 0 0px 525px;
            width: 300px;
            height: 260px;
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
            padding: 20px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;
            border-radius:10%;
        }
        .button:hover{
            background-color: #efefef;
            color: #27292a;
        }
        .button:active{
            background-color: #6f84a2;
            color: #efefef;
            padding: 19px 19px;
            border: 1px solid #efefef;
        }


    </style>


</head>


<canvas id="canvas" width="1200" height="200" style="background-color:rgb(90,108,134)"></canvas>

<div class="middle">



    <div class="calc">
        <div>

            <form action="" method="post">
                <input type="submit" name="button" value="SAVE" class="button">
            </form>
            <br>
            <form action="" method="post">
                <input type="submit" name="button" value="LOAD" class="button">
            </form>
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
            }

            if(isset($_POST['button'])) {
                if($_POST['button'] == 'SAVE'){
                    if($row['player_temX'] > 600){
                        $row['player_temX'] = 300;
                    }
                    $sth = $dbh->prepare("UPDATE data SET player_x=?,robot01_passed=?,robot02_passed=?,robot03_passed=?,robot01_destroy=?,robot02_destroy=?,robot03_destroy=? WHERE username = '$id'");
                    $sth->execute(array($row['player_temX'],$row['robot01_temPass'],$row['robot02_temPass'],$row['robot03_temPass'],$row['robot01_temDest'],$row['robot02_temDest'],$row['robot03_temDest']));
                    echo ' <p>Saved. </p>';
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
                }else if($_POST['button'] == 'LOAD'){
                    $sth = $dbh->prepare("UPDATE data SET player_x=?,player_moveX=?,robot01_temPass = ?, robot02_temPass = ?, robot03_temPass = ?,robot01_temDest = ?, robot02_temDest = ?, robot03_temDest = ? WHERE username = '$id'");
                    $sth->execute(array($row['player_temX'],0,$row['robot01_passed'],$row['robot02_passed'],$row['robot03_passed'],$row['robot01_destroy'],$row['robot02_destroy'],$row['robot03_destroy']));
                    echo ' <p>Loaded. </p>';
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
                }

//                echo '<p>'.$_POST['button'].'</p>';
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
