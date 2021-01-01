class gameOverScene extends Phaser.Scene {
    constructor() {
        super({key:"gameOverScene"});

    }

    preload(){

    }

    create(){
        const Score = this.add.text(320, 100, 'Score: 0', { font: '20px Impact', fill: '#000' });
        Score.setOrigin(0.5, 0.5);
        Score.setText('Score: ' + score);

        if(score>highscore){
            const newHighscore = this.add.text(320, 175, 'New Highscore!', { font: '20px Impact', fill: '#000' });
            newHighscore.setOrigin(0.5, 0.5);
            highscore = score;
            score = 0;

            if (document.getElementById("highscore")){
                document.getElementById('highscore').value = highscore;
                document.getElementById("highscoreForm").submit();
            }
        }

        score = 0;

        const restartText = this.add.text(320,250, 'Click to restart', { font: '20px Impact', fill: '#000' });
        restartText.setOrigin(0.5, 0.5);

        this.input.on('pointerdown', function (event) {
            this.scene.start("gameScene");
        }, this);
    }

}