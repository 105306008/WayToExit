<?php session_start(); ?>
<?php
if(!isset($_SESSION['username'])){
    return;
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
    <title>Lobby</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
<!--    <script src="indexJS.js"></script>-->

    <style>
        @font-face {
            font-family: 'Zpix';
            src: url('Zpix.ttf');
        }
        input.button {
            font-family: Zpix;
            background-color: #6f84a2;
            border: none;
            color: #efefef;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            border-radius:5%;
        }
        button:hover{
            background-color: #efefef;
            color: #27292a;
        }
        button:active{
            background-color: #6f84a2;
            color: #efefef;
            padding: 9px 9px;
            border: 1px solid #efefef;
        }

    </style>
</head>
<body>

<canvas id="canvas" width="1200" height="500" style="background-color:rgb(90,108,134)"></canvas>
<canvas id="des" width="1200" height="500" style="position:absolute;top:0;left:0;background:rgba(255,255,255,0)"></canvas>

<form action="Save.php" method="POST">
    <input id="save" name="gameButton" type="submit" style="position: absolute; top:410px; left:875px;visibility: hidden" class="button" value="Access">
</form>
<form action="index.php" method="POST">
    <input id="saveDestroy" name="saveDestroy" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden"  class="button" value="Destroy">
</form>
<form action="Password.php" method="POST">
    <input id="robot01" name="gameButton" type="submit" style="position: absolute; top:410px; left:850px;visibility: hidden" class="button" value="'Hello.'">
</form>
</form>
<form action="index.php" method="POST">
    <input id="robot01Destroy" name="robotDestroy" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden" class="button" value="Destroy">
</form>
<form action="Turn.php" method="POST">
    <input id="robot02" name="gameButton" type="submit" style="position: absolute; top:410px; left:775px;visibility: hidden" class="button" value="'What's wrong?'">
</form>
<form action="index.php" method="POST">
    <input id="robot02Destroy" name="robotDestroy" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden" class="button" value="Destroy">
</form>
<form action="Canvas.php" method="POST">
    <input id="robot03" name="gameButton" type="submit" style="position: absolute; top:410px; left:885px;visibility: hidden" class="button" value="'Hi?'">
</form>
<form action="index.php" method="POST">
    <input id="robot03Destroy" name="robotDestroy" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden" class="button" value="Destroy">
</form>
<form action="Calculator.php" method="POST">
    <input id="panel" name="gameButton" type="submit" style="position: absolute; top:410px; left:920px;visibility: hidden" class="button" value="Use">
</form>
<form action="index.php" method="POST">
    <input id="panelDestroy" name="panelDestroy" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden" class="button" value="Destroy">
</form>
<form action="Self.php" method="POST">
    <input id="self" name="gameButton" type="submit" style="position: absolute; top:410px; left:900px;visibility: hidden" class="button" value="Info">
</form>
<form action="Logout.php" method="POST">
    <input id="logout" name="gameButton" type="submit" style="position: absolute; top:410px; left:1000px;visibility: hidden" class="button" value="Logout">
</form>
<form action="Board.php" method="POST">
    <input id="exit" name="gameButton" type="submit" style="position: absolute; top:410px; left:850px;visibility: hidden" class="button" value="Go">
</form>

</body>
</html>

<?php

include("pdoInc.php");
include("indexJS.php");
?>

<script>
    let canvas = document.getElementById("des"); // 取得物件
    let ctx = canvas.getContext("2d");
    let alpha = 0,
        delta = 0.1;


    function destroy(){
        alpha = 1;
        fade();
    }
    function fade() {

        alpha -= delta;
        /// clear canvas, set alpha and re-draw image
        ctx.clearRect(10, 10, canvas.width, canvas.height);
        ctx.globalAlpha = alpha;
        ctx.rect(10, 10, canvas.width, canvas.height);
        ctx.fillStyle = 'red';
        ctx.fill();
        console.log();

        if(alpha>0){setTimeout(fade, 16)} // or use setTimeout(loop, 16) in older browsers
    }

    <?php
        if(isset($_POST['robotDestroy'])){
            echo 'destroy();';
        }
    ?>
</script>
