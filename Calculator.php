<?php session_start();

if(!isset($_SESSION['username'])){
    return;
}
?>
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
    <script src="calcJS.js"></script>
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
            height: 410px;
            display: inline-block;
            vertical-align: top;
            margin: -10px 0 -10px 0px;
        }
        .calc{
            display: inline-block;
            margin: 10px 0 0px 350px;
            width: 390px;
            height: 360px;
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

        input{
            font-family: Zpix;
        }
        .button {
            background-color: rgb(90,108,134);
            border: none;
            color: #efefef;
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .button:hover{
            background-color: #efefef;
            color: rgb(90,108,134);
        }
        .button:active{
            background-color: #27292a;
            color: #efefef;
            padding:14px 14px;
            border: 1px solid #efefef;
        }
        .result{
            background-color: rgb(90,108,134);
            border: 2px solid #efefef;
            color: #efefef;
            padding: 15px 20px;
            text-align: right;
            text-decoration: none;
            font-size: 20px;
        }


    </style>


</head>
<body>

<canvas id="canvas" width="1200" height="100" style="background-color:rgb(90,108,134)"></canvas>

<div class="middle">


    <div class="calc">
    <br><br>
    <form name="calculator">
        <div align="center">

                <table  cellpadding="0">
                    <tr>
                        <td colspan="5"><input type="text" size="10" name="result" value="" disabled="disabled" class="result">
                    <tr>
                        <td colspan="2">
                        <td>
                            <input type="button" value="C" onClick="clearNow()" class="button">
                        <td>
                            <input type="button" value="CE" onClick="clearAll()" class="button">
                    <tr>
                        <td>
                            <input type="button" value="1" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="2" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="3" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="/" onClick="operate(this.value)" class="button">
                    <tr>
                        <td>
                            <input type="button" value="4" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="5" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="6" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="*" onClick="operate(this.value)" class="button">
                    <tr>
                        <td>
                            <input type="button" value="7" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="8" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="9" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="-" onClick="operate(this.value)" class="button">
                    <tr>
                        <td>
                            <input type="button" value="+/-" onClick="sign()" class="button">
                        <td>
                            <input type="button" value="0" onClick="input(9-this.value)" class="button">
                        <td>
                            <input type="button" value="." onClick="point()" class="button">
                        <td>
                            <input type="button" value="+" onClick="operate(this.value)" class="button">
                        <td>
                            <input type="button" value="=" onClick="operate(this.value)" class="button">
                </table>
    </form>
   <br>



    </div>

</div>

<div class="right">
    <p> <a href="./index.php">Back▸</a></p>
</div>

</div>



</body>

</html>



<script language="JavaScript">

    var newNumber = true;
    var operation = "+";
    var opSave = "+";
    var front = "0";
    var now = "0";



    function input(number){
        now = document.calculator.result.value;
        if(operation == "="){
            clearAll();
        }
        if (now == "0" || newNumber == true){
            document.calculator.result.value = number;
        }else{
            document.calculator.result.value += number;
        }

        newNumber = false;
    }

    function operate(op){
        if(!newNumber || operation == "=") {
            front = front + "";
            if (op != "=" && operation !="=") {
                now = document.calculator.result.value;
                opSave = operation;
                front = eval(front+opSave+now);
                document.calculator.result.value = front;
            }else if(op == "="){
                if(operation != "="){
                    now = document.calculator.result.value;
                    opSave = operation;
                }
                front = eval(front+opSave+now);
                document.calculator.result.value = front;
            }
            newNumber = true;
        }
        operation = op;

    }

    function clearNow(){
        document.calculator.result.value = "";
        newNumber = true;
    }

    function clearAll(){
        clearNow();
        front = "0";
        opSave = "+";
        operation = "+";
    }

    function sign(){
        if (!newNumber) {
            document.calculator.result.value *= -1;
        }
    }

    function point(){
        if (!newNumber) {
            now =document.calculator.result.value;
            if (now.indexOf('.')==-1){
                document.calculator.result.value += ".";

            }
        }
    }


</script>
