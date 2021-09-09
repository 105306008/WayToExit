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


        let panel = new createjs.Bitmap(repo.getResult('panel'));

        let text = new createjs.Text();
        text.text = 'A calculator. \n\nNothing special.';
        text.font = '25px Zpix';


        panel.x = 300;
        panel.y = 30;
        panel.scaleX = 0.4;
        panel.scaleY = 0.4;
        stage.addChild(panel);

        text.x = 400;
        text.y = 30;
        stage.addChild(text);
    }



});