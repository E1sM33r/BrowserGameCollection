let score = -3;
let labelScore;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
let isGameOver = false;
var bird;
var pipes;
var spacebar;
var timer;
var timedEvent;
var timedEventScore;

function gameOver(){
    isGameOver = true;
}

class gameScene extends Phaser.Scene{
    constructor() {
        super({key:"gameScene"});
    }

    preload ()
    {
        this.load.image('bird', '/js/games/Tap Jumper/assets/bird.png');
        this.load.image('pipe', '/js/games/Tap Jumper/assets/pipe.png')
    }

    create ()
    {
        // Hintergrund festlegen
        this.cameras.main.setBackgroundColor('#71c5cf');

        // Bird erstellen
        bird = this.physics.add.sprite(100, 200, 'bird');
        bird.setCollideWorldBounds(true);
        bird.body.gravity.y = 300;

        // Bird steuern
        spacebar = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.SPACE);

        // Pipes hinzufügen
        pipes = this.add.group();

        this.addRowOfPipes();
        timedEvent = this.time.addEvent({ delay: 1500, callback: this.addRowOfPipes, callbackScope: this, loop: true });

        // Score anzeigen
        labelScore = this.add.text(20, 20, 'Score: 0', { font: "30px Arial", fill: "#ffffff" });
        timedEventScore = this.time.addEvent({ delay: 1500, callback: function(){
            if(score>0){
            labelScore.setText('Score: ' + score);
            }
            }, callbackScope: this, loop: true });

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

    addRowOfPipes() {
        var hole = Math.floor(Math.random() * 7) + 1;

        for (var i = 0; i < 10; i++){
            if (i != hole && i != hole + 1) {
                this.addOnePipe(960, i * 60 + 30);
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
            bird.body.velocity.y = -150;
        }

    }


}

