let score = -3;
let endScore;
let labelScore;
let highscoreLabel;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
let isGameOver = false;
let birdHit = false;
var bird;
var pipes;
var ground;
var spacebar;
var timer;
var timedEvent;
var timedEventScore;

function gameOver(){
    bird.setTint(0xff0000);
    bird.angle += 10;
    birdHit = true;
    endScore = score;
}

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

        this.addRowOfPipes();
        timedEvent = this.time.addEvent({ delay: 1500, callback: this.addRowOfPipes, callbackScope: this, loop: true });

        // Score anzeigen
        labelScore = this.add.text(20, 20, 'Score: 0', { font: "30px Arial", fill: "#ffffff" }).setDepth(1);
        timedEventScore = this.time.addEvent({ delay: 1500, callback: function(){
            if(score>0){
            labelScore.setText('Score: ' + score);
            }
            }, callbackScope: this, loop: true });
        highscoreLabel = this.add.text(630, 565, 'Highscore: ' + highscore, { font: "26px Arial", fill: "#ffffff" }).setDepth(1);

        // Kollisionen prüfen
        this.physics.add.overlap(bird, pipes, gameOver, null, this);

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
            }
        }
        score += 1;

    }

    update ()
    {
        if(bird.y > 580 || bird.y < 20){
            isGameOver = true;
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

