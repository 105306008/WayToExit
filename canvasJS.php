<?php
include("pdoInc.php");
if($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    $sql = "SELECT * FROM data WHERE username = '$id'";
    $st = $dbh->query($sql);
    $row = $st->fetch(PDO::FETCH_ASSOC);
}

$password = '3584';
if(isset($_POST['answer']) && $_POST['answer'] == $password){
    $sth = $dbh->prepare("UPDATE data SET robot03_temPass = ? WHERE username = '$id'");
    $sth->execute(array((int)1));
    echo '<meta http-equiv=REFRESH CONTENT=0;url=Canvas.php>';
}
?>

<script>
    //canvas

    let stage = new createjs.Stage(robotCanvas);
    let repo = new createjs.LoadQueue(false);

    console.log('test');
    setup();

    function setup() {
        // automatically update
        createjs.Ticker.on("tick", e => stage.update());
        createjs.Ticker.framerate = 60;
        repo.loadManifest([{id:'bg',src:"MC/BG01.png"}
        ]);
        repo.on('complete', drawRobot);
    }


    function drawRobot() {


        let robotData03 = {
            images: ["Chara/Robot03.png"],
            frames: {width: 150, height: 160, spacing: 10},
            animations: {
                status: [0, 3, , 0.075],
            },
        }


        let robotSheet03 = new createjs.SpriteSheet(robotData03);
        let robot03 = new createjs.Sprite(robotSheet03, "status");
        let text = new createjs.Text();
        text.text = 'Password...lost.\n\nHelp...please.';
        <?php
            if($row['robot03_love'] > 8){
                echo "text.color = '#FF000E';";
                echo 'text.text = "I Don\'T NeeD YouR He?P.";';
            }else if($row['robot03_love'] > 4){
                echo 'text.text = "...Le$(#A)@Ve...";';
            }else if($row['robot03_love'] > 1) {
                echo 'text.text = "P@s#$rd...lo*T.\n\nHe?p...pl@)s2...";';
            }
            if($row['robot03_temPass']) {
                if($row['robot03_love'] > 8){
                    echo "text.color = '#FF000E';";
                    echo 'text.text = "...Never come back.";';
                }else if($row['robot03_love'] > 4){
                    echo 'text.text = "^G0...*a#Wa3$(y...";';
                }else if($row['robot03_love'] > 1){
                    echo 'text.text = "T@)...hA?@ks...";';
                }else{
                    echo 'text.text = "Thanks...";';
                }
            }
        ?>;

        text.font = '25px Zpix';


        robot03.x = 300;
        robot03.y = 30;
        robot03.scaleX = 0.4;
        robot03.scaleY = 0.4;
        stage.addChild(robot03);

        text.x = 400;
        text.y = 30;
        stage.addChild(text);
    }



</script>