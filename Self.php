<?php
session_start();
if(!isset($_SESSION['username'])){
    return;
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
    <title>test</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="selfJS.js"></script>

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
            margin: 15px 0 0px 350px;
            width: 500px;
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


<div class="middle">
    <div id="square1" class="HW">
    <div>
        <?php

        include("pdoInc.php");

        if($_SESSION['username'] != null)
        {
            //將$_SESSION['username']丟給$id
            //這樣在下SQL語法時才可以給搜尋的值
            $id = $_SESSION['username'];
            //若以下$id直接用$_SESSION['username']將無法使用
            $sql = "SELECT * FROM data WHERE username = '$id'";
            $st = $dbh->query($sql);
            $row = $st->fetch(PDO::FETCH_ASSOC);


            if(!$row['username']){
//                echo "<p style=\"font-size:25px\">操作錯誤！</p>";
                return;
            }else{

                $un = $row['username'];
                $nn = $row['nickname'];
                $status = "";

                echo "<form name=\"form\" method=\"post\" action=\"Self.php\">";
                echo "<p style=\"font-size:25px\">".$un." </p><br>";
                echo "<p>PW：<input type=\"password\" name=\"pw\" value=\"\" required/>(must) <br></p>";
                echo "<p>Change PW：<input type=\"password\" name=\"pw2\" value=\"\" /> (4-14 Number & English) </p>";
                echo "<p>PW Again：<input type=\"password\" name=\"pw3\" value=\"\" /> (4-14 Number & English) </p>";
                echo "<p>Nickname：<input type=\"text\" name=\"nickname\" value=\"$nn\" /> (under 20)</p>";
                echo "<input type=\"submit\" name=\"button\" value=\"OK\" class=\"button\">";
                echo "</form>";
                echo $status;
            }
        }
        else
        {
//            echo '<p>您無權限觀看此頁面！</p>';
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }

        if(isset($_POST['pw']) && $_POST['pw'] != null){
            $sql = "SELECT * FROM data WHERE username = '$id'";
            $st = $dbh->query($sql);
            $row = $st->fetch(PDO::FETCH_ASSOC);

            $newPassword = $_POST['pw2'];
            $newPassword2 = $_POST['pw3'];
            $oldNickname = $row['nickname'];
            $nickname = $_POST['nickname'];

            $test_pw = (preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$newPassword) && strlen($pw)>3 && strlen($pw)<15);
            $test_nickname = (mb_strlen($nickname, "utf-8")>0 && mb_strlen($nickname, "utf-8")<21);

            $snn = "SELECT * FROM data WHERE nickname = '$nickname'";
            $cn = $dbh->query($snn);
            $nicknameCheck = $cn->fetch(PDO::FETCH_ASSOC);

            if(md5($_POST['pw']) != $row['password']){
                echo '<p>Password error.</p>';
                echo '</div></div><div class="right"><p><a href="./index.php">Back▸</a></p></div>';
                return;
            }else{
                if(isset($newPassword) && $newPassword != null){
                    if($test_pw && $newPassword == $newPassword2){
                        $newPassword = md5($newPassword);
                    }else{
                        echo '<p>Password error.</p>';
                        echo '</div></div><div class="right"><p><a href="./index.php">Back▸</a></p></div>';
                        return;
                    }
                }else{
                    $newPassword = $row['password'];
                }

                if(!(isset($nickname) && $nickname != null && $test_nickname)){
                    echo '<p>Nicname error</p>';

                    echo '</div></div><div class="right"><p><a href="./index.php">Back▸</a></p></div>';
                    return;
                }

                if($nickname == $nicknameCheck['nickname'] && $nickname != $oldNickname || $nickname == 'robot-left' || $nickname == 'robot-middle' || $nickname == 'robot-right'){
                    echo '<p>Nickname exist.</p>';
                    echo '</div></div><div class="right"><p><a href="./index.php">Back▸</a></p></div>';
                    return;
                }
            }

            $sth = $dbh->prepare("UPDATE data SET password = ?, nickname = ? WHERE username = '$id'");

            if($sth->execute(array($newPassword, $nickname))){
                    $_SESSION['nickname'] = $nickname;
//
//                    $unn = $dbh->prepare("UPDATE thread SET nickname = ? WHERE nickname = '$oldNickname'");
//                    $unn->execute(array($nickname));
//                    $unn = $dbh->prepare("UPDATE comment SET nickname = ? WHERE nickname = '$oldNickname'");
//                    $unn->execute(array($nickname));
//                    $ck = $dbh->query("SELECT * FROM thread WHERE nickname = '$oldNickname'");
//                    while($r = $ck->fetch(PDO::FETCH_ASSOC)){
//                        echo $r['thread_id'];
//                    }
                    echo '<meta http-equiv=REFRESH CONTENT=0;url=Self.php>';
                    //echo '新增成功';
            }
            else{
                    echo 'Fail.';
                    //echo '<meta http-equiv=REFRESH CONTENT=2;url=self.php>';
                }




        }



        ?>
    </div>

            <br>

        </div>

    <div class="right">
        <p> <a href="./index.php">Back▸</a></p>
    </div>



    </div>
</div>

</body>
</html>
