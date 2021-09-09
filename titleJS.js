$(document).ready(()=>{ // jQuery main

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
            frames: {width: 150, height: 160, spacing: 10},
            animations: {
                status: [0, 3, , 0.075],
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
        let text1 = new createjs.Text();
        let text2 = new createjs.Text();
        text1.text = 'Way to the Exit';
        text1.font = '40px Zpix';

        player.x = 500;
        player.y = 110;
        player.scaleX = 0.4;
        player.scaleY = 0.4;
        stage.addChild(player);

        robot01.x = 400;
        robot01.y = 110;
        robot01.scaleX = 0.4;
        robot01.scaleY = 0.4;
        stage.addChild(robot01);

        robot02.x = 600;
        robot02.y = 110;
        robot02.scaleX = 0.4;
        robot02.scaleY = 0.4;
        stage.addChild(robot02);

        robot03.x = 700;
        robot03.y = 110;
        robot03.scaleX = 0.4;
        robot03.scaleY = 0.4;
        stage.addChild(robot03);

        text1.x = 410;
        text1.y = 200;
        stage.addChild(text1);

    }



});