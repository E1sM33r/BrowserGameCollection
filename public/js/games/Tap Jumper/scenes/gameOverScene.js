class gameOverScene extends Phaser.Scene {
    constructor() {
        super({key:"gameOverScene"});

    }

    preload(){

    }

    create(){
        const Score = this.add.text(400, 150, 'Score: 0', { fontSize: '32px', fill: '#FFF' });
        Score.setOrigin(0.5, 0.5);
        if (score<0){
            score = 0;
        }
        Score.setText('Score: ' + score);

        if(score>highscore){
            const newHighscore = this.add.text(400, 200, 'New Highscore!', { fontSize: '32px', fill: '#FFF' });
            newHighscore.setOrigin(0.5, 0.5);
            highscore = score;

            if (document.getElementById("highscore")){
                document.getElementById('highscore').value = highscore;
                document.getElementById("highscoreForm").submit();
            }
        }
        score = -3;

        const restartText = this.add.text(400,350, 'Click to restart');
        restartText.setOrigin(0.5, 0.5);

        this.input.on('pointerdown', function (event) {
            isGameOver = false;
            this.scene.start("gameScene");
        }, this);
    }

}