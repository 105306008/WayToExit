<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="loginJS.js"></script>
    <meta charset="UTF-8">
    <title>Login</title>

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
            height: 410px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .HW{
            display: inline-block;
            margin: 35px 0 0px 450px;
            width: 390px;
            height: 360px;
        }
        .right{
            display: inline-block;
            margin: 10px 10px 10px 0px;

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
<canvas id="canvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>


﻿<?php
include("pdoInc.php");
?>

<div class="middle">
    <div id="square1" class="HW">
        <br>
        <div>
            <form name="form" action="" method="post">
                <p>ID</p><input type="text" name="id">
                <p>PW</p><input type="password" name="pw">
                <br><br>
                <input type="submit" name="login" value="login" class="button">
            </form>

            <?php

            if(isset($_POST['id']) && isset($_POST['pw'])){
                $id = $_POST['id'];
                $pw = $_POST['pw'];

                //搜尋資料庫資料
                $sql = "SELECT * FROM data WHERE username = '$id'";
                $st = $dbh->query($sql);
                $row = $st->fetch(PDO::FETCH_ASSOC);

                //判斷帳號與密碼是否為空白
                //以及MySQL資料庫裡是否有這個會員
                if($id != null && $pw != null && $row['username'] == $id && $row['password'] == md5($pw))
                {
                    //將帳號寫入session，方便驗證使用者身份
                    $_SESSION['username'] = $id;
                    $_SESSION['nickname'] = $row['nickname'];

                    $sth = $dbh->prepare("UPDATE data SET player_temX = ?,player_moveX=?,robot01_temPass = ?, robot02_temPass = ?, robot03_temPass = ?,robot01_temDest = ?, robot02_temDest = ?, robot03_temDest = ? WHERE username = '$id'");
                    $sth->execute(array($row['player_x'],0,$row['robot01_passed'],$row['robot02_passed'],$row['robot03_passed'],$row['robot01_destroy'],$row['robot02_destroy'],$row['robot03_destroy']));


                    echo ' <p>Success！ </p>';
                    if(!$row['first_play']){
                        $sth = $dbh->prepare("UPDATE data SET first_play = ? WHERE username = '$id'");
                        $sth->execute(array((int)1));
                        echo '<meta http-equiv=REFRESH CONTENT=0;url=Tutorial.php>';
                    }else {
                        echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
                    }
                }
                else
                {
                    echo ' <p>Fail！</p>';
                    //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
                }

            }

            ?>
            <br>

        </div>



    </div>
    <div class="right">
        <p> <a href="./Title.html">Back▸</a></p>
    </div>

</div>

</body>

</html>


<script language="JavaScript">



</script>
