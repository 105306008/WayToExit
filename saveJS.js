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


        let saveData = {
            images: ["Chara/SavePoint.png"],
            frames: {width:150, height:160,spacing:10},
            animations: {
                status:[0,5,,0.075],
            },
        }

        let saveSheet = new createjs.SpriteSheet(saveData);
        let savePoint = new createjs.Sprite(saveSheet, "status");
        let text1 = new createjs.Text();
        let text2 = new createjs.Text();
        text1.text = 'NOTICE:Destroy is not allowed.\n\nBe aware of your CHOICE.';
        text1.font = '25px Zpix';

        savePoint.x = 300;
        savePoint.y = 30;
        savePoint.scaleX = 0.4;
        savePoint.scaleY = 0.4;
        stage.addChild(savePoint);



        text1.x = 400;
        text1.y = 30;
        stage.addChild(text1);

    }



});