<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="registerJS.js"></script>
    <meta charset="UTF-8">
    <title>Register</title>

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
            margin: 15px 0 0px 425px;
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

<?php
include("pdoInc.php");
?>

<div class="middle">
    <div id="square1" class="HW">
        <br>
        <div>
            <form name="form" action="" method="post">
                <p>ID<br><br><input type="text" name="id" />　(4-14 Number & English)</p>
                <p>PW<br><br><input type="password" name="pw" />　(4-14 Number & English)</p>
                <p>PW Again</p><input type="password" name="pw2" /><br><br>
                <input type="submit" value="OK" class="button">
            </form>

            <?php

            if(isset($_POST['id']) && isset($_POST['pw2']) && isset($_POST['pw'])){

                $id = $_POST['id'];
                $pw = $_POST['pw'];
                $pw2 = $_POST['pw2'];
                $test_id = (preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$id) && strlen($id)>3 && strlen($id)<15);
                $test_pw = (preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$pw) && strlen($pw)>3 && strlen($pw)<15);

                //判斷帳號密碼是否為空值
                //確認密碼輸入的正確性
                if($id != null && $pw != null && $pw2 != null && $pw == $pw2){
                    if(!$test_id || !$test_pw){
                        echo '<p>Format Error！</p>';

                    }else{

                        $sql = "SELECT username FROM data WHERE username = '$id'";
                        $st = $dbh->query($sql);
                        $row = $st->fetch(PDO::FETCH_ASSOC);

                        if($id == $row['username']){

                            echo '<p>ID already exist.</p>';

                        }else{

                            $sth = $dbh->prepare('INSERT INTO data (username, password, nickname) VALUES (?, ?, ?)');

                            if($sth->execute(array($_POST['id'], md5($_POST['pw']),$_POST['id'])))
                            {
                                echo '<p>Success！</p>';
                                echo '<meta http-equiv=REFRESH CONTENT=1;url=Title.html>';
                            }
                            else
                            {
                                echo '<p>Fail！</p>';
                                //echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
                            }
                        }
                    }
                }
                else
                {
                    echo '<p>Fail！</p>';
                    //echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
                }

            }
            ?>


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
