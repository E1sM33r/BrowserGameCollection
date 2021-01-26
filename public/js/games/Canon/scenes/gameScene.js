var score = 0;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
var scoreText;
var timer;

function destroyTarget (ball, target)
{
    target.disableBody(true, true);
    score += 1;
    scoreText.setText('Score: ' + score);
}

class gameScene extends Phaser.Scene {
    constructor() {
        super({key: "gameScene"});

    }

    preload() {
        this.load.image('background', '/js/games/Canon/assets/sky.png');
        this.load.image('shooter', '/js/games/Canon/assets/shooter.png');
        this.load.image('body', '/js/games/Canon/assets/ground.png');
        this.load.image('ball', '/js/games/Canon/assets/ball.png');
        this.load.image('target', '/js/games/Canon/assets/star.png');
        this.load.image('obstacle', '/js/games/Canon/assets/obstacle.png');
    }

    create() {


        this.add.image(320, 256, 'background').setScale(2);


        var x = Phaser.Math.Between(10, 600);
        var y = Phaser.Math.Between(10, 300);
        var target = this.physics.add.image(x,y,'target');
        target.body.setAllowGravity(false);

        var x2 = Phaser.Math.Between(10, 600);
        var y2 = Phaser.Math.Between(10, 300);
        var target2 = this.physics.add.image(x2,y2,'target');
        target2.body.setAllowGravity(false);

        var x3 = Phaser.Math.Between(10, 600);
        var y3 = Phaser.Math.Between(10, 300);
        var target3 = this.physics.add.image(x3,y3,'target');
        target3.body.setAllowGravity(false);

        var x4 = Phaser.Math.Between(10, 600);
        var y4 = Phaser.Math.Between(10, 300);
        var target4 = this.physics.add.image(x4,y4,'target');
        target4.body.setAllowGravity(false);

        var x5 = Phaser.Math.Between(10, 600);
        var y5 = Phaser.Math.Between(10, 300);
        var target5 = this.physics.add.image(x5,y5,'target');
        target5.body.setAllowGravity(false);

        var x6 = Phaser.Math.Between(10, 600);
        var y6 = Phaser.Math.Between(10, 300);
        var target6 = this.physics.add.image(x6,y6,'target');
        target6.body.setAllowGravity(false);

        var x7 = Phaser.Math.Between(10, 600);
        var y7 = Phaser.Math.Between(10, 300);
        var target7 = this.physics.add.image(x7,y7,'target');
        target7.body.setAllowGravity(false);

        var x8 = Phaser.Math.Between(10, 600);
        var y8 = Phaser.Math.Between(10, 300);
        var target8 = this.physics.add.image(x8,y8,'target');
        target8.body.setAllowGravity(false);

        var shooter = this.add.image(130, 440, 'shooter').setDepth(1);
        var body = this.add.image(129, 464, 'body').setDepth(1).setScale(2.0);
        var ball = this.physics.add.image(body.x , body.y, 'ball').setScale(1);
        ball.setBounce(0.9).setCollideWorldBounds(true);
        ball.disableBody(true, true);
        var obstacle = this.physics.add.image(300, 300, 'obstacle').setScale(0.08).setImmovable(true);
        obstacle.body.setAllowGravity(false);
        var obstacle2 = this.physics.add.image(100, 100, 'obstacle').setScale(0.08).setImmovable(true);
        obstacle2.body.setAllowGravity(false);
        var angle;


        scoreText = this.add.text(10, 10, 'Score: 0', { font: '20px Impact', fill: '#000' });

        timer = this.time.delayedCall(8000, this.gameOver, [], this);

        this.physics.add.collider(
            ball,
            target,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target2,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target3,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target4,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target5,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target6,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target7,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target8,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget(_ball, _target);
                }
            })


        this.input.on('pointermove', function (pointer) {
            angle = Phaser.Math.Angle.BetweenPoints(body, pointer);
            shooter.rotation = angle;
        });

        this.input.on('pointerup', function () {
            ball.enableBody(true, body.x, body.y -25, true, true);
            this.physics.velocityFromRotation(angle, 700, ball.body.velocity);
        }, this);


        this.physics.add.collider(ball, obstacle);
        this.physics.add.collider(ball, obstacle2);

        //für durchschuss animation
        //this.physics.add.overlap(ball, target, destroyTarget, null, this);

    }


    update (){
        scoreText.setText('Score: ' + score + '\nTime: ' + Math.floor(8000 - timer.getElapsed()));

    }

    gameOver ()
    {
        this.input.off('pointermove');
        this.input.off('pointerup');
        this.scene.start("gameOverScene");
    }

}

