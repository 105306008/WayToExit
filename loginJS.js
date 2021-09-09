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
        repo.loadManifest([{id:'bg',src:"MC/BG01.png"}
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


        let spriteSheet = new createjs.SpriteSheet(playerData);
        let player = new createjs.Sprite(spriteSheet, "status");
        let text = new createjs.Text();
        text.text = 'LOGIN';
        text.font = '25px Zpix';


        player.x = 300;
        player.y = 30;
        player.scaleX = 0.4;
        player.scaleY = 0.4;
        stage.addChild(player);

        text.x = 400;
        text.y = 50;
        stage.addChild(text);
    }



});