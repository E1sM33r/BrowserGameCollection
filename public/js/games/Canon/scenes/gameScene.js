var score = 0;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
var scoreText;
let highscoreLabel;
var timer;

function destroyTarget (ball, target)
{
    target.disableBody(true, true);
    score += 1;
    scoreText.setText('Score: ' + score);
}
function destroyTarget2 (ball, target)
{
    target.disableBody(true, true);
    score += 2;
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
        this.load.image('target2', '/js/games/Canon/assets/Target2.png');
        this.load.image('obstacle', '/js/games/Canon/assets/obstacle.png');
        this.load.image('obstacle2', '/js/games/Canon/assets/BoxLong.png');
        this.load.image('obstacle3', '/js/games/Canon/assets/sticky.png');

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

        var x9 = Phaser.Math.Between(10, 600);
        var y9 = Phaser.Math.Between(10, 100);
        var target9 = this.physics.add.image(x9,y9,'target2');
        target9.body.setAllowGravity(false);

        var x10 = Phaser.Math.Between(10, 600);
        var y10 = Phaser.Math.Between(10, 100);
        var target10 = this.physics.add.image(x10,y10,'target2');
        target10.body.setAllowGravity(false);

        var shooter = this.add.image(130, 440, 'shooter').setDepth(1);
        var body = this.add.image(129, 464, 'body').setDepth(1).setScale(2.0);
        var ball = this.physics.add.image(body.x , body.y, 'ball').setScale(1);
        ball.setBounce(0.9).setCollideWorldBounds(true);
        ball.disableBody(true, true);

        var xObstacle1 = Phaser.Math.Between(50, 600);
        var yObstacle1 = Phaser.Math.Between(100, 300);
        var obstacle = this.physics.add.image(xObstacle1, yObstacle1, 'obstacle').setScale(0.08).setImmovable(true);
        obstacle.body.setAllowGravity(false);

        var xObstacle2 = Phaser.Math.Between(50, 600);
        var yObstacle2 = Phaser.Math.Between(100, 300);
        var obstacle2 = this.physics.add.image(xObstacle2, yObstacle2, 'obstacle2').setScale(0.07).setImmovable(true).setAngle(45);
        obstacle2.body.setAllowGravity(false);

        var xObstacle3 = Phaser.Math.Between(50, 600);
        var yObstacle3 = Phaser.Math.Between(100, 300);
        var obstacle3 = this.physics.add.image(xObstacle3, yObstacle3, 'obstacle3').setScale(2).setImmovable(true).setBounce(0);
        obstacle3.body.setAllowGravity(false);

        var angle;


        scoreText = this.add.text(10, 10, 'Score: 0', { font: '20px Impact', fill: '#000' }).setDepth(1);
        highscoreLabel = this.add.text(520, 10, 'Highscore: ' + highscore, { font: '20px Impact', fill: '#000' }).setDepth(1);

        timer = this.time.delayedCall(15000, this.gameOver, [], this);

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
        this.physics.add.collider(
            ball,
            target9,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget2(_ball, _target);
                }
            })
        this.physics.add.collider(
            ball,
            target10,
            function(_ball, _target){
                if(_ball.body.touching && _target.body.touching){
                    destroyTarget2(_ball, _target);
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
        this.physics.add.collider(ball, obstacle3);

        //für durchschuss animation

        //this.physics.add.overlap(ball, target, destroyTarget, null, this);

    }


    update (){

        scoreText.setText('Score: ' + score + '\nTime: ' + Math.floor(15000 - timer.getElapsed()));



    }

    gameOver ()
    {
        this.input.off('pointermove');
        this.input.off('pointerup');
        this.scene.start("gameOverScene");
    }

}



