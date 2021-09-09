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
<!--    <script src="turnJS.js"></script>-->
    <meta charset="UTF-8">
    <title>Turn</title>

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
            margin: 10px 0 0px 400px;
            width: 390px;
            height: 360px;
        }

        .turn {
            display: inline-block;
            width: 100%;
            height:100%;
            border-radius: 10%;
            padding: 0px;
            background-color: rgb(138, 163, 196);
            margin: 0px 0px 0px 0px;
        }
        .inner {
            background-size:cover;
            background-position:center center;
            height: 100%;
            border-radius:10%;

        }
        .right{
            display: inline-block;
            margin: 5px 5px 5px 100px;

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


        .container {
            display: inline-block;
            position: relative;
            width: 100px;
            height: 100px;
            margin: -5px -5px -5px -5px;
        }
        .card {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: all 0.5s linear;
        }
        .face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }
        .face.back {
            transform: rotateY(180deg);
            box-sizing: border-box;
            color: #6f84a2;
            background-color:rgb(90,108,134);
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
<!--    <script src="turnJS.js"></script>-->


</head>
<body>
<!--<canvas id="canvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>-->
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

if(!$row['robot02_temDest']) {
    echo '<canvas id="canvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>';
} else{
    echo '<p style="color:red;position:absolute;top:10;left:10;">ThindS DesTroyeD Can\'T WorK AnymorE.</p>';
    return;
}

?>

<div class="middle">
    <div id="square1" class="HW">
        <br>
        <?php
        if(!$row['robot02_temPass']){

            echo '<form action="Turn.php" method="post">';
            echo '<p></p><input name="answer">';
            echo '　<input type="submit" value="submit" class="button">';
            echo '</form>';
        }
        ?>
    <br>
            <div class="container">
                <div id="1" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner1" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="2" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner2" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="3" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner3" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="4" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner4" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container" >
            <div id="5" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner5" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="6" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner6" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="7" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner7" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="8" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner8" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container"  >
            <div id="9" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner9" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="10" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner10" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="11" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner11" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" >
            <div id="12" class="card" onclick="turn(this.id)">
                <div class="front face">
                    <div class="turn" >
                    </div>
                </div>
                <div class="back face">
                    <div class="turn" >
                        <div id="inner12" class="inner" ></div>
                    </div>
                </div>
            </div>
        </div>


        <p style="position:absolute;top:450;">　　　　　Read by Left to Right →</p>


    </div>
    <div class="right">
        <p> <a href="./index.php">Back▸</a></p>
    </div>

</div>

</body>

</html>

<script language="JavaScript">
let url = ['Object/turn01','Object/turn02','Object/turn03','Object/turn04',
        'Object/turn05','Object/turn06','Object/turn07','Object/turn08',
        'Object/turn09','Object/turn10','Object/turn11','Object/turn12'];
let v1 = ['a','b','c','d','e','f','a','b','d','e','f','c'];



let record = v1;
let now = [];
let found = [];
let play = true;

start(v1);

function turn(card){
    if(now.length < 2 && found.indexOf(card) == -1) {
        document.getElementById(card).style.transform = "rotateY(180deg)";
        if (now.length == 0) {
            now.push(card);
            console.log(record[now[0] - 1]);
        } else if (now.length == 1 && card != now[0]) {
            now.push(card);
            if (record[now[1] - 1] == record[now[0] - 1]) {
                found.push(now[0]);
                found.push(now[1]);
                console.log(found);
                now = [];
                if(found.length == record.length){
                    play = false;
                }
            } else {
                setTimeout(trans, 1000);

            }

        }
    }
    console.log(now);
}


function trans() {
    document.getElementById(now[0]).style.transform = "rotateY(0deg)";
    document.getElementById(now[1]).style.transform = "rotateY(0deg)";
    console.log("test");
    now = [];
}

function start(v) {

        document.getElementById("square1").style.visibility = "visible";


        for (let i = 1; i <= record.length; i++) {
            let id = "inner" + i;
            let photo = url[i-1];
            document.getElementById(id).style.backgroundImage = "url(" + photo + ".png)";
        }
        console.log(record);
}


</script>

<?php
include("turnJS.php");
?>