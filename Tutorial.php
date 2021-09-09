<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="easeljs.min.js"></script>
    <script src="preloadjs.min.js"></script>
    <script src="tweenjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="jquery-3.2.0.min.js"></script>
    <script src="tutorialJS.js"></script>
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
            height: 110px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .calc{
            display: inline-block;
            margin: 0px 0 0px 400px;
            width: 350px;
            height: 60px;
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
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 25px;
            border-radius:5%;
        }
        .button:hover{
            background-color: #efefef;
            color: #27292a;
        }
        .button:active{
            background-color: #6f84a2;
            color: #efefef;
            padding: 14px 14px;
            border: 1px solid #efefef;
        }


    </style>


</head>
<body>

<canvas id="canvas" width="1200" height="400" style="background-color:rgb(90,108,134)"></canvas>

<div class="middle">
    <br>

    <div class="calc">
        <div align="center">
            <form action="index.php" method="post">
                <input type="submit" value="Go to the Exit" class="button">
            </form>

        </div>


    </div>

</div>



</div>



</body>

</html>
