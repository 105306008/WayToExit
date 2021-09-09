<?php
    include("pdoInc.php");
    if($_SESSION['username'] != null) {
        $id = $_SESSION['username'];
        $sql = "SELECT * FROM data WHERE username = '$id'";
        $st = $dbh->query($sql);
        $row = $st->fetch(PDO::FETCH_ASSOC);
    }


    $password = '117136';
    $text_unpassed = 'Help!! Please help me find \n\nthe lost password!!';
    $text_passed = 'Thank you very much!!';
    $text = $text_unpassed;

    if(isset($_POST['answer']) && $_POST['answer'] == $password){
        $sth = $dbh->prepare("UPDATE data SET robot02_temPass = ? WHERE username = '$id'");
        $sth->execute(array((int)1));
        echo '<meta http-equiv=REFRESH CONTENT=0;url=Turn.php>';
    }
?>

<script>
    let stage = new createjs.Stage(canvas);
    let repo = new createjs.LoadQueue(false);

    console.log('test');
    setup();

    function setup() {
        // automatically update
        createjs.Ticker.on("tick", e => stage.update());
        createjs.Ticker.framerate = 60;
        repo.loadManifest([{id:'bg',src:"MC/BG01.png"}
        ]);
        repo.on('complete', draw);
    }


    function draw() {


        let robotData02 = {
            images: ["Chara/Robot02.png"],
            frames: {width: 150, height: 160, spacing: 10},
            animations: {
                status: [0, 3, , 0.075],
            },
        }


        let robotSheet02 = new createjs.SpriteSheet(robotData02);
        let robot02 = new createjs.Sprite(robotSheet02, "status");
        let text = new createjs.Text();
        text.color = '#000000';
        text.text = 'Help!! Please help me find \n\nthe lost password!!';
        <?php
            if($row['robot02_love'] > 8){
                echo 'text.color = \'#FF000E\';';
                echo 'text.text = "WhY Do YoU StiLL He?p Me?";';
            }else if($row['robot02_love'] > 4){
               echo 'text.text = "Ple2se do?t de&$r@y Me!!";';
            }else if($row['robot02_love'] > 1) {
                echo 'text.text = "Help!! Ple?se he?p me f@nd \n\nthe lo#(* pa@#!)o?d!!";';
            }
            if($row['robot02_temPass']) {
                if($row['robot02_love'] > 8){
                    echo "text.color = '#FF000E';";
                    echo 'text.text = "WHY?";';
                }else if($row['robot02_love'] > 4){
                    echo 'text.text = "I bel)#eVe Y*u wIll #*@...";';
                }else if($row['robot02_love'] > 1){
                    echo 'text.text = "It\'s a0llr@ghT.. T-anK?? u...";';
                }else{
                    echo 'text.text = "It\'s alright!! \n\nThank you very much!!";';
                }
            }
        ?>
        text.font = '25px Zpix';


        robot02.x = 300;
        robot02.y = 30;
        robot02.scaleX = 0.4;
        robot02.scaleY = 0.4;
        stage.addChild(robot02);

        text.x = 400;
        text.y = 30;
        stage.addChild(text);
    }


</script>