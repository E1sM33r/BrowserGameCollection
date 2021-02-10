let score = 0;
let endScore;
let labelScore;
let highscoreLabel;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
let isGameOver = false;
let birdHit = false;
let gameOverInit = false;
let scoreCD = false;
let pipeDelay = 2500;
var bird;
var pipes;
var scoreChecks;
var ground;
var spacebar;
var timer = 0;
var timeElapsed = 0;
var timedEvent;



class gameScene extends Phaser.Scene{
    constructor() {
        super({key:"gameScene"});
    }

    preload ()
    {
        this.load.image('pipe', '/js/games/Tap Jumper/assets/pipe.png');
        this.load.image('pipeTop', '/js/games/Tap Jumper/assets/pipeTop.png');
        this.load.spritesheet('bird', '/js/games/Tap Jumper/assets/newBird.png', { frameWidth: 44, frameHeight: 32 });
    }

    create ()
    {
        // Hintergrund festlegen
        this.cameras.main.setBackgroundColor('#71c5cf');

        // Bird erstellen
        bird = this.physics.add.sprite(100, 200, 'bird').setDepth(2);
        bird.setCollideWorldBounds(true);
        bird.body.gravity.y = 500;

        // Bird Animation
        this.anims.create({
            key: 'flyUp',
            frames: this.anims.generateFrameNumbers('bird', { start: 1, end: 3 }),
            frameRate: 8,
            repeat: 0
        });

        this.anims.create({
            key: 'flyDown',
            frames: this.anims.generateFrameNumbers('bird', { start: 1, end: 3 }),
            frameRate: 8,
            repeat: -1
        });

        // Bird steuern
        spacebar = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.SPACE);

        // Pipes hinzufügen
        pipes = this.add.group();
        scoreChecks = this.add.group();

        this.addRowOfPipes();
        timedEvent = this.time.addEvent({ delay: pipeDelay, callback: this.addRowOfPipes, callbackScope: this, loop: true });

        // Score anzeigen
        labelScore = this.add.text(20, 20, 'Score: 0', { font: "30px Arial", fill: "#ffffff" }).setDepth(1);
        highscoreLabel = this.add.text(630, 565, 'Highscore: ' + highscore, { font: "26px Arial", fill: "#ffffff" }).setDepth(1);

        //Timer setzen
        this.time.addEvent({ delay: 1000, callback: this.increaseTimer, callbackScope: this, loop: true });

        // Kollisionen prüfen
        this.physics.add.overlap(bird, pipes, this.gameOver, null, this);
        this.physics.add.overlap(bird, scoreChecks, this.addScore, null, this);

    }

    addScore(){
        if (!scoreCD && !birdHit){
            score++;
            labelScore.setText('Score: ' + score);
            scoreCD = true;
            this.time.addEvent({ delay: 1000, callback: function (){scoreCD=false;}, callbackScope: this, loop: false });
        }
    }

    addOnePipe(x, y) {
        var pipe = this.physics.add.sprite(x, y, 'pipe');

        pipes.add(pipe);

        pipe.body.velocity.x = -200;

        pipe.checkWorldBounds = true;
        pipe.outOfBoundsKill = true;
    }

    addTopPipe(x, y, top = true){
        var pipe = this.physics.add.sprite(x, y, 'pipeTop');

        if (top){
            pipe.angle = 180;
            pipe.flipX = true;
        }

        pipes.add(pipe);

        pipe.body.velocity.x = -200;

        pipe.checkWorldBounds = true;
        pipe.outOfBoundsKill = true;
    }

    addScoreCheck(x, y){
        var scoreCheck = this.physics.add.sprite(x, y, 'pipe');

        scoreChecks.add(scoreCheck);

        scoreCheck.body.velocity.x = -200;

        scoreCheck.checkWorldBounds = true;
        scoreCheck.outOfBoundsKill = true;
        scoreCheck.visible = false;

    }

    addRowOfPipes() {
        var hole = Math.floor(Math.random() * 7) + 1;

        for (var i = 0; i < 10; i++){
            if (i != hole && i != hole + 1) {
                if (i == hole -1){
                    this.addTopPipe(960, i * 60 + 30, true);
                }else if(i == hole +2){
                    this.addTopPipe(960, i * 60 + 30, false);
                }else{
                this.addOnePipe(960, i * 60 + 30);
                }
            }else{
                this.addScoreCheck(1060, i * 60 + 30);
            }
        }
    }

    gameOver(){

        if (!gameOverInit){
            bird.setTint(0xff0000);
            bird.angle += 10;
            birdHit = true;
            endScore = score;
            this.time.addEvent({ delay: 1000, callback: function (){isGameOver = true;}, callbackScope: this, loop: false });
            gameOverInit = true;
        }

    }

    increaseTimer(){
        timer++;
        if (timer == timeElapsed + 10 && pipeDelay>1000){
            pipeDelay-=150;
            timedEvent.delay = pipeDelay;
            timeElapsed+=10;
        }
    }

    update ()
    {
        if(bird.y > 580 || bird.y < 20){
            this.gameOver();
        }

        if (isGameOver){
            this.scene.start("gameOverScene");
        }

        if (Phaser.Input.Keyboard.JustDown(spacebar)){
            if (!birdHit) {
                bird.body.velocity.y = -240;
                bird.anims.play('flyUp', true);
            }
        }

        if (bird.body.velocity.y < 0){
            bird.anims.play('flyDown', true);
        }

        if (bird.body.velocity.y > 0){
            bird.anims.play('flyDown', false);
        }

        if (birdHit){
            bird.angle += 5;
        }

    }


}

