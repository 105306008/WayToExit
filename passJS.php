<?php
include("pdoInc.php");
if($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    $sql = "SELECT * FROM data WHERE username = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);
}

$password = '889278';
if(isset($_POST['answer']) && $_POST['answer'] == $password){
    $sth = $dbh->prepare("UPDATE data SET robot01_temPass = ? WHERE username = '$id'");
    $sth->execute(array((int)1));
    echo '<meta http-equiv=REFRESH CONTENT=0;url=Password.php>';
}
?>

<script>
    //canvas

    let stage = new createjs.Stage(canvas);
    let repo = new createjs.LoadQueue(false);

    console.log('test');
    setup();

    function setup() {
        // automatically update
        createjs.Ticker.on("tick", e => stage.update());
        createjs.Ticker.framerate = 60;
        repo.loadManifest([{id:'panel',src:"Object/Panel01.png"}
        ]);
        repo.on('complete', draw);
    }


    function draw() {


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
            frames: {width: 150, height: 160, spacing: 10},
            animations: {
                status: [0, 3, , 0.075],
            },
        }

        let robotSheet01 = new createjs.SpriteSheet(robotData01);
        let robot01 = new createjs.Sprite(robotSheet01, "status");
        let robotSheet02 = new createjs.SpriteSheet(robotData02);
        let robot02 = new createjs.Sprite(robotSheet02, "status");
        let robotSheet03 = new createjs.SpriteSheet(robotData03);
        let robot03 = new createjs.Sprite(robotSheet03, "status");
        let text1 = new createjs.Text();
        let text2 = new createjs.Text();
        text1.text = 'Hello, player.\n\nHere is the message for you.\n\n';
        text1.font = '25px Zpix';
        text2.text = '＋　　＝？'
        text2.font = '40px Zpix';

        <?php
            if($row['robot01_love'] > 8){
                echo "text1.color = '#FF000E';";
                echo 'text1.text = "YoU JusT Won\'T Stop, Hah?";';
            }else if($row['robot01_love'] > 4){
                echo 'text1.text = "I think you can do better.";';
            }else if($row['robot01_love'] > 1) {
                echo 'text1.text = "Destroy is not allowed, \n\nremember?";';
            }

        ?>

        robot01.x = 300;
        robot01.y = 30;
        robot01.scaleX = 0.4;
        robot01.scaleY = 0.4;
        stage.addChild(robot01);

        robot02.x = 400;
        robot02.y = 160;
        robot02.scaleX = 0.4;
        robot02.scaleY = 0.4;
        stage.addChild(robot02);

        robot03.x = 525;
        robot03.y = 160;
        robot03.scaleX = 0.4;
        robot03.scaleY = 0.4;
        stage.addChild(robot03);

        text1.x = 400;
        text1.y = 30;
        stage.addChild(text1);

        text2.x = 475;
        text2.y = 175;
        stage.addChild(text2);
    }


</script>
