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

    $exit_level = $row['robot01_temPass'] + $row['robot02_temPass'] + $row['robot03_temPass'];
//    echo $exit_level;

}
?>

<script>

    let stage = new createjs.Stage(canvas);
    let repo = new createjs.LoadQueue(false);
    let playerX = <?php echo $row['player_temX'] ?>;
    let moveX = <?php echo $row['player_moveX'] ?>;
    let robot01_passed = <?php echo $row['robot01_temPass'] ?>;
    let robot02_passed = <?php echo $row['robot02_temPass'] ?>;
    let robot03_passed = <?php echo $row['robot03_temPass'] ?>;
    let robot01_destroy = <?php echo $row['robot01_temDest'] ?>;
    let robot02_destroy = <?php echo $row['robot02_temDest'] ?>;
    let robot03_destroy = <?php echo $row['robot03_temDest'] ?>;
    let robot01_love = <?php echo $row['robot01_love'] ?>;
    let robot02_love = <?php echo $row['robot02_love'] ?>;
    let robot03_love = <?php echo $row['robot03_love'] ?>;
    let exit_level = <?php echo $exit_level ?>;
    let saveDest = false;
    let panelDest = false;
    let destCheck = true;

    console.log('test');
    setup();

    function setup() {
        // automatically update
        createjs.Ticker.on("tick", e => stage.update());
        createjs.Ticker.framerate = 60;
        repo.loadManifest([{id:'bg',src:"MC/BG01.png"},
            {id:'board',src:"Object/Board.png"},
            {id:'board01',src:"Object/Board01.png"},
            {id:'board02',src:"Object/Board02.png"},
            {id:'board03',src:"Object/Board03.png"},
            {id:'panel',src:"Object/Panel01.png"},
            {id:'panel02',src:"Object/Panel02.png"},
            {id:'battery',src:"Object/Battery.png"},
            {id:'box',src:"Object/Xbox.png"}
        ]);
        repo.on('complete', draw);
    }


    function draw() {

        let board = new createjs.Bitmap(repo.getResult('board'));
        let boards = [repo.getResult('board'),repo.getResult('board01'),repo.getResult('board02'),repo.getResult('board03')];
        // let board02 = repo.getResult('board02');
        // let board03 = repo.getResult('board03');
        let panel = new createjs.Bitmap(repo.getResult('panel'));
        let panel01 = repo.getResult('panel');
        let panel02 = repo.getResult('panel02');
        let box = new createjs.Bitmap(repo.getResult('box'));
        let bg = new createjs.Bitmap(repo.getResult('bg'));


        let playerData = {
            images: ["MC/stayRightSheet.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,7,,0.075],
            },
        };
        let robotData01 = {
            images: ["Chara/Robot01.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,5,,0.075],
            },
        }
        let robotData02 = {
            images: ["Chara/Robot02.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,3,,0.075],
            },
        }
        let robotData03 = {
            images: ["Chara/Robot03.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,3,,0.075],
            },
        }
        let saveData = {
            images: ["Chara/SavePoint.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,5,,0.075],
            },
        }


        let spriteSheet = new createjs.SpriteSheet(playerData);
        let player = new createjs.Sprite(spriteSheet, "status");
        let robotSheet01 = new createjs.SpriteSheet(robotData01);
        let robot01 = new createjs.Sprite(robotSheet01, "status");
        let robotSheet02 = new createjs.SpriteSheet(robotData02);
        let robot02 = new createjs.Sprite(robotSheet02, "status");
        let robotSheet03 = new createjs.SpriteSheet(robotData03);
        let robot03 = new createjs.Sprite(robotSheet03, "status");
        let saveSheet = new createjs.SpriteSheet(saveData);
        let savePoint = new createjs.Sprite(saveSheet, "status");
        let text = new createjs.Text();
        text.text = '';
        text.font = '30px Zpix';
        text.color = '#000000';


        bg.x = 0 + moveX;
        bg.y = -1;
        bg.scaleX = 1.6;
        bg.scaleY = 1.6;
        stage.addChild(bg);

        text.x = 100;
        text.y = 400;
        stage.addChild(text);

        box.x = 650 + moveX;
        box.y = 100;
        box.scaleX = 1.6;
        box.scaleY = 1.6;
        box.width = 71*1.6;
        box.height = 71*1.6;
        stage.addChild(box);

        board.x = 1450 + moveX;
        board.y = 123;
        board.scaleX = 0.25;
        board.scaleY = 0.25;
        board.width = 360*0.25;
        board.height = 360*0.25;
        stage.addChild(board);

        robot01.scaleX = 0.3;
        robot01.scaleY = 0.3;
        robot01.x = 450 + moveX;
        robot01.y = 165;
        robot01.width = 150*0.3;
        robot01.height = 160*0.3;
        stage.addChild(robot01);

        panel.scaleX = 0.3;
        panel.scaleY = 0.3;
        panel.x = 780 + moveX;
        panel.y = 160;
        panel.width = 160*0.3;
        panel.height = 180*0.3;
        stage.addChild(panel);

        robot02.scaleX = 0.3;
        robot02.scaleY = 0.3;
        robot02.x = 900 + moveX;
        robot02.y = 165;
        robot02.width = 150*0.3;
        robot02.height = 160*0.3;
        stage.addChild(robot02);

        robot03.scaleX = 0.3;
        robot03.scaleY = 0.3;
        robot03.x = 1200 + moveX;
        robot03.y = 165;
        robot03.width = 150*0.3;
        robot03.height = 160*0.3;
        stage.addChild(robot03);

        savePoint.scaleX = 0.3;
        savePoint.scaleY = 0.3;
        savePoint.x = 300 + moveX;
        savePoint.y = 165;
        savePoint.width = 150*0.3;
        savePoint.height = 160*0.3;
        stage.addChild(savePoint);

        player.scaleX = 0.3;
        player.scaleY = 0.3;
        player.x = playerX;
        player.y = 165;
        player.width = 150*0.3;
        player.height = 160*0.3;
        stage.addChild(player);

        window.addEventListener('keydown', (e) => {
            console.log(player.x);
            switch (e.keyCode) {
                case 65:// left
                    spriteSheet['_images'][0].src = "MC/runLeftSheet.png";
                    player.x -= 10;
                    if (player.x <= 600 && bg.x < 0){
                        player.x = 600;
                        bg.x += 10;
                        box.x += 10;
                        robot01.x += 10;
                        robot02.x += 10;
                        robot03.x += 10;
                        savePoint.x += 10;
                        panel.x += 10;
                        board.x += 10;
                        moveX += 10;
                    }else if(player.x <= 0){
                        player.x = 0;
                    }
                    //move.play();
                    break;
                case 68:// right
                    spriteSheet['_images'][0].src = "MC/runRightSheet.png";
                    player.x += 10;
                    if (player.x >= 600 && bg.x >= -400){
                        player.x = 600;
                        bg.x -= 10;
                        box.x -= 10;
                        robot01.x -= 10;
                        robot02.x -= 10;
                        robot03.x -= 10;
                        savePoint.x -= 10;
                        panel.x -= 10;
                        board.x -= 10;
                        moveX -= 10;
                    }else if(player.x >= 1150){
                        player.x = 1150;
                    }
                    //move.play();
                    break;
                // case 90:
                //     player['hp'] = 0;
                //     break;
            }
        });

        window.addEventListener('keyup', (e) => {
            switch (e.keyCode) {
                case 65:// left
                    spriteSheet['_images'][0].src = "MC/stayLeftSheet.png";
                    break;
                case 68:// right
                    spriteSheet['_images'][0].src = "MC/stayRightSheet.png";
                    break;
            }
        });

        createjs.Ticker.addEventListener("tick", handleTick);

        function handleTick(event){
            text.color = '#000000';
            if(isHit(player, panel)){
                for (i = 0; i < document.getElementsByClassName('button').length; i++) {
                    document.getElementsByClassName('button')[i].style.visibility = 'hidden';
                }
                panel.image = panel02;
                text.text = 'A panel.';
                document.getElementById('panel').style.visibility = 'visible';
                document.getElementById('panelDestroy').style.visibility = 'visible';
                <?php
                    if(isset($_POST['panelDestroy'])){
                        echo 'panelDest = true;';
                    }
                ?>
                if (panelDest && destCheck) {
                    text.text = "DESTROY A PANEL HAS NO MEANING.";
                }
            }else if(isHit(player, savePoint)){
                text.text = 'Save Point';
                document.getElementById('save').style.visibility = 'visible';
                document.getElementById('saveDestroy').style.visibility = 'visible';
                <?php
                    if(isset($_POST['saveDestroy'])){
                        echo 'saveDest = true;';
                    }
                ?>
                if (saveDest && destCheck) {
                    text.text = "YOU CAN\'T DESTROY THE SAVEPOINT.";
                }
            }else if(isHit(player, robot01)){
                <?php
                if(!$row['robot01_temDest']){
                    if($row['robot01_love'] < 2){
                        echo "text.text = '\"Hello, player.\"';";
                    }else if($row['robot01_love'] < 5){
                        echo "text.text = '\"Hello.\"';";
                    }else if($row['robot01_love'] < 8){
                        echo "text.text = '\"Hello, is it fun?\"';";
                    }else{
                        echo "text.color = '#FF000E';";
                        echo "text.text = '\"HellO, KilleR.\"';";
                    }
                    echo "document.getElementById('robot01').style.visibility = 'visible';";
                    echo "document.getElementById('robot01Destroy').style.visibility = 'visible';";
                }else{
                    echo "text.text = '\"...\"';";
                }
                ?>
            }else if(isHit(player, robot02)){
                <?php
                    if(!$row['robot02_temDest']){
                        if($row['robot02_love'] < 2){
                            echo "text.text = '\"Help!!\"';";
                        }else if($row['robot02_love'] < 5){
                            echo "text.text = '\"He*)p @#!!\"';";
                        }else if($row['robot02_love'] < 8){
                            echo "text.text = '\"H2*)9 @q!!\"';";
                        }else{
                            echo "text.color = '#FF000E';";
                            echo "text.text = '\"WhY Do YoU KEeP KiLLinG Me?\"';";
                        }
                        echo "document.getElementById('robot02').style.visibility = 'visible';";
                        echo "document.getElementById('robot02Destroy').style.visibility = 'visible';";
                    }else{
                        echo "text.text = '\"...\"';";
                    }
                ?>
            }else if(isHit(player, robot03)){
                <?php
                    if(!$row['robot03_temDest']){
                        if($row['robot03_love'] < 2){
                            echo "text.text = '\"...Help...\"';";
                        }else if($row['robot03_love'] < 5){
                            echo "text.text = '\"...5e*p &..\"';";
                        }else if($row['robot03_love'] < 8){
                            echo "text.text = '\"...5e*& o?...\"';";
                        }else{
                            echo "text.color = '#FF000E';";
                            echo "text.text = '\"You Killer.\"';";
                        }
                        echo "document.getElementById('robot03').style.visibility = 'visible';";
                        echo "document.getElementById('robot03Destroy').style.visibility = 'visible';";
                    }else{
                        echo "text.text = '\"...\"';";
                    }
                ?>
            }else if(isHit(player, board)){
                text.text = 'Exit';
                if(exit_level == 3){
                    document.getElementById('exit').style.visibility = 'visible';
                }
            }else if(isHit(player, box)){
                for (i = 0; i < document.getElementsByClassName('button').length; i++) {
                    document.getElementsByClassName('button')[i].style.visibility = 'hidden';
                }
                panel.image = panel01;
                text.text = 'Console';
                document.getElementById('self').style.visibility = 'visible';
                document.getElementById('logout').style.visibility = 'visible';
            }else {
                destCheck = false;
                // console.log(destCheck);
                panel.image = panel01;
                text.text = '';
                for (i = 0; i < document.getElementsByClassName('button').length; i++) {
                    document.getElementsByClassName('button')[i].style.visibility = 'hidden';
                }
                //console.log(document.getElementsByName('gameButton'))
            }

            board.image = boards[exit_level];

            playerX = player.x;
            // console.log(playerX);
        }





    }

    //setup();

    function isHit(player, other){
        // let player = player;
        // let other = other;

        if((player.x <= other.x + other.width) && (player.x + player.width >= other.x)
            && (player.y <= other.y + other.height) && (player.y + player.height >= other.y) ){
            return true;
        }else{
            return false;
        }
    }




    $("#save").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot01_temPass:robot01_passed,
                robot02_temPass:robot02_passed,
                robot03_temPass:robot03_passed,
                robot01_temDest:robot01_destroy,
                robot02_temDest:robot02_destroy,
                robot03_temDest:robot03_destroy
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#saveDestroy").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#panel").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#panelDestroy").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#self").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#robot01").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot01_temPass:robot02_passed,
                robot01_temDest:robot02_destroy
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#robot02").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot02_temPass:robot02_passed,
                robot02_temDest:robot02_destroy
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#robot03").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot03_temPass:robot03_passed,
                robot03_temDest:robot03_destroy
            },success : function(result) {
                console.log(result);
            },
            error: function(result) {
                console.log(result);
            }
        })
    });
    $("#robot02Destroy").on('click', function(){
        $.ajax({
            url: 'Destroy.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot02_temDest:1,
                robot_love:true
            },success : function(result) {
                console.log(result);
                console.log('success');
            },
            error: function(result) {
                console.log(result);
                console.log('fail');
            }
        })
    });
    $("#robot03Destroy").on('click', function(){
        $.ajax({
            url: 'Destroy.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot03_temDest:1,
                robot_love:true
            },success : function(result) {
                console.log(result);
                console.log('success');
            },
            error: function(result) {
                console.log(result);
                console.log('fail');
            }
        })
    });
    $("#robot01Destroy").on('click', function(){
        $.ajax({
            url: 'Destroy.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX,
                robot01_temDest:1,
                robot_love:true
            },success : function(result) {
                console.log(result);
                console.log('success');
            },
            error: function(result) {
                console.log(result);
                console.log('fail');
            }
        })
    });
    $("#exit").on('click', function(){
        $.ajax({
            url: 'record.php',
            type : "POST",
            dataType : 'json',
            data : {
                temX:playerX,
                moveX:moveX
            },success : function(result) {
                console.log(result);
                console.log('success');
            },
            error: function(result) {
                console.log(result);
                console.log('fail');
            }
        })
    });


</script>


