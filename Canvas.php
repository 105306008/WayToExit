<?php session_start();

if(!isset($_SESSION['username'])){
    return;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Canvas</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
<!--    <script src="canvasJS.js"></script>-->
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
            vertical-align: top;
            display: inline-block;
            margin: 25px 0 0px 175px;
            width: 425px;
            height: 360px;
        }
        .right{
            vertical-align: bottom;
            display: inline-block;
            margin: 0px 5px 25px 0px;

        }
        .choose{
            vertical-align: top;
            display: inline-block;
            margin: 75px 0px 0px 50px;

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
        button.button {
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

        li {
            list-style: none;
            list-style-type: none;
            margin: 0 -40px 5px;
            border: 1px solid #ffffff;
            padding: 5px;
            border-radius: 4px;
            color: #ffffff;
            cursor: move;

            width: 210px;
        }


    </style>


</head>
<body>
<!---->
<!--<canvas id="robotCanvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>-->
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

if(!$row['robot03_temDest']) {
    echo '<canvas id="robotCanvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>';
} else{
    echo '<p style="color:red;position:absolute;top:10;left:10;">ThindS DesTroyeD Can\'T WorK AnymorE.</p>';
    return;
}

?>
<div class="middle">


        <div class="choose">

            <p>Layer　　 　　now</p>
            <ul id="canvas-list" class="moveable">
                <li id="c4">　Word4　　　<input type="radio" name="canvas" onclick="setCanvas('Canvas4')">
<!--                    　　<input type="checkbox" checked="checked" onchange="setVisible(this.checked,'4')">　</li>-->
                <li id="c3">　Word3　　　<input type="radio" name="canvas" onclick="setCanvas('Canvas3')">
<!--                    　　<input type="checkbox" checked="checked" onchange="setVisible(this.checked,'3')">　</li>-->
                <li id="c2">　Word2　　　<input type="radio" name="canvas" onclick="setCanvas('Canvas2')">
<!--                    　　<input type="checkbox" checked="checked" onchange="setVisible(this.checked,'2')">　</li>-->
                <li id="c1">　Word1　　　<input type="radio" name="canvas" onclick="setCanvas('Canvas1')" checked="checked">
<!--                    　　<input type="checkbox" checked="checked" onchange="setVisible(this.checked,'1')">　</li>-->
            </ul>
            <button type="submit" class="button" onclick="reset()">Reset</button>
            <p style="position:absolute;top:375;left:125;">↑Change the order</p>

            <!--            <p style="position:absolute;top:410;left:65;">Choose the canvas to draw<br>Change the canvas order<br>Reset if you need</p>-->

        </div>

        <div class="HW" style="display:inline-block">
            <?php
            if(!$row['robot03_temPass']){
                echo '<form action="" method="post">';
                echo '<p></p><input name="answer">';
                echo '　<input type="submit" value="submit" class="button">';
                echo '</form>';
            }
            ?>
        </div>
    <div class="right">
        <p> <a href="./index.php">Back▸</a></p>
    </div>
        <br>

        <canvas width="400" height="250" id="Canvas1" style="z-index:1;background:rgba(255,255,255,0);border:1px solid #ffffff;position:absolute;top:200;left:420;pointer-events:auto; visibility: visible;"></canvas>
        <canvas width="400" height="250" id="Canvas2" style="z-index:2;background:rgba(255,255,255,0);border:1px solid #ffffff;position:absolute;top:200;left:420;pointer-events:auto; visibility: visible;"></canvas>
        <canvas width="400" height="250" id="Canvas3" style="z-index:3;background:rgba(255,255,255,0);border:1px solid #ffffff;position:absolute;top:200;left:420;pointer-events:auto; visibility: visible;"></canvas>
        <canvas width="400" height="250" id="Canvas4" style="z-index:4;background:rgba(255,255,255,0);border:1px solid #ffffff;position:absolute;top:200;left:420;pointer-events:auto; visibility: visible;"></canvas>




</div>




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    let canvas = document.getElementById("Canvas1"); // 取得物件
    let ctx = canvas.getContext("2d");
    var drawMode, mx, my, lx, ly;
    let points = [];
    let nowGco, nowBrush, nowLayer;


    setWord();
    setCanvas('Canvas1');
    draw('source-over', 'normal');

    function setCanvas(c) {
        canvas = document.getElementById(c);
        ctx = canvas.getContext("2d");
        console.log(canvas,ctx);

        let nowZ = parseInt(document.getElementById(c).style.zIndex);

        for(let i=1;i<=4;i++){
            document.getElementById('Canvas'+ i).style.pointerEvents = 'auto';
        }

        for(let i=1;i<=4;i++){
            let allZ = parseInt(document.getElementById('Canvas'+ i).style.zIndex);
            if (allZ > nowZ){
                document.getElementById('Canvas'+ i).style.pointerEvents = 'none';
                console.log(document.getElementById('Canvas'+ i).style.pointerEvents);
            }
        }

        draw(nowGco, nowBrush);
        console.log('test');
    }

    function setWord(){
        for(let i=1;i<=4;i++) {
            let img = new Image();
            img.src = 'Object/canvas0'+ i +'.png';
            img.onload = function () {
                let passCanvas = document.getElementById("Canvas"+i);
                let passCtx = passCanvas.getContext("2d");
                passCtx.drawImage(img, 0, 0);
            };
        }
    }

    function reset(){
        for(let i=1;i<=4;i++) {
            let clearCanvas = document.getElementById("Canvas"+i);
            let clearCtx = clearCanvas.getContext("2d");
            clearCtx.clearRect(0, 0, clearCanvas.width,clearCanvas.height);
        }
        setWord();
    }

    function draw(gco, b) {
        if (canvas.style.visibility == 'hidden') return;

        nowGco = gco;
        nowBrush = b;

        ctx.globalCompositeOperation = gco;

        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';


        canvas.onmousedown = function (ev) {
            ctx.beginPath();
            ctx.strokeStyle = '#ffffff';
            ctx.fillStyle = '#ffffff';
            ctx.lineWidth = '20';
            lx = event.clientX - parseInt(canvas.style.left) + window.pageXOffset;
            ly = event.clientY - parseInt(canvas.style.top) + window.pageYOffset;
            ctx.moveTo(lx, ly);
            drawMode = true;


            canvas.onmousemove = function (ev) {
                if (drawMode) {
                    mx = event.clientX - parseInt(canvas.style.left) + window.pageXOffset;
                    my = event.clientY - parseInt(canvas.style.top) + window.pageYOffset;
                    brush(b, mx, my, lx, ly);


                }
            }

            canvas.onmouseup = function () {
                drawMode = false;
                points = [];
            }


        }


        function brush(b, mx, my, lx, ly) {
            if (b == 'normal') {
                ctx.lineTo(mx, my);
                ctx.stroke();
            }
        }

    }

    function setVisible(check,c){
        if(check){
            document.getElementById('Canvas'+ c).style.visibility = 'visible';
        }else{
            document.getElementById('Canvas'+ c).style.visibility = 'hidden';
        }
    }


    let items = document.querySelectorAll('#canvas-list > li');

    items.forEach(item => {
        $(item).prop('draggable', true);
        item.addEventListener('dragstart', dragStart);
        item.addEventListener('drop', dropped);
        item.addEventListener('dragenter', cancelDefault);
        item.addEventListener('dragover', cancelDefault);
    })

    function dragStart (e) {
        var index = $(e.target).index();
        e.dataTransfer.setData('text/plain', index);
    }

    function dropped (e) {
        cancelDefault(e);

        // get new and old index
        let oldIndex = e.dataTransfer.getData('text/plain');
        let target = $(e.target);
        let newIndex = target.index();

        // remove dropped items at old place

        if(newIndex!=parseInt(oldIndex)) {

            let dropped = $(this).parent().children().eq(oldIndex).remove();

            // insert the dropped items at new place

            if (newIndex < oldIndex) {
                target.before(dropped);
            } else if (newIndex > oldIndex) {
                target.after(dropped);
            }
        }

        for(let i=1;i<=4;i++){
            let nowPlace = $('li').index(document.getElementById('c' + i));
            document.getElementById('Canvas'+ i).style.zIndex = 4 - nowPlace;
        }

    }

    function cancelDefault (e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    }



</script>


</body>

</html>

<?php
include ("canvasJS.php");
?>