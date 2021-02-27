var snake;
var food;
var cursors;
var score =0;
var highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
var scoreText;
let highscoreLabel;

var UP = 0;
var DOWN = 1;
var LEFT = 2;
var RIGHT = 3;

class gameScene extends Phaser.Scene{
    constructor() {
        super({key:"gameScene"});

    }

    preload ()
    {
        this.load.image('food', '/js/games/Snake/assets/food.png');
        this.load.image('snake', '/js/games/Snake/assets/snake.png');
        this.load.image('specialFood', '/js/games/Snake/assets/specialFood.png');
        this.load.image('specialFood2', '/js/games/Snake/assets/specialFood2.png');
    }

    create ()
    {
        var Food = new Phaser.Class({

            Extends: Phaser.GameObjects.Image,

            initialize:

                function Food (scene, x, y){
                    Phaser.GameObjects.Image.call(this, scene)

                    this.setTexture('food');
                    this.setPosition(x*16, y*16);
                    this.setOrigin(0);

                    this.total = 0;

                    scene.children.add(this);
                },


            eat: function (){
                score++;

                scoreText.setText('Score: ' + score);
                if( score % 10 === 0){
                    this.setTexture('specialFood2');
                    var x = Phaser.Math.Between(10, 39);
                    var y = Phaser.Math.Between(10, 29);

                    this.setPosition(x * 16, y * 16);
                }else if(score % 5 === 0){
                    this.setTexture('specialFood');
                    var x = Phaser.Math.Between(10, 39);
                    var y = Phaser.Math.Between(10, 29);

                    this.setPosition(x * 16, y * 16);
                }
                else{
                    this.setTexture('food');
                    var x = Phaser.Math.Between(0, 39);
                    var y = Phaser.Math.Between(0, 29);

                    this.setPosition(x * 16, y * 16);
                }

            }
        });


        var Snake = new Phaser.Class({

            initialize:

                function Snake (scene, x, y){
                    this.headPosition = new Phaser.Geom.Point(x,y);

                    this.body = scene.add.group();

                    this.head = this.body.create(x*16, y*16, 'snake');
                    this.head.setOrigin(0);

                    this.alive = true;

                    this.speed = 100;

                    this.moveTime = 0;

                    this.tail = new Phaser.Geom.Point(x, y);

                    this.heading = RIGHT;
                    this.direction = RIGHT;
                },


            update: function(time){
                if(time >= this.moveTime){
                    return this.move(time);
                }
            },


            faceLeft: function(){
                if (this.direction === UP || this.direction === DOWN){
                    this.heading = LEFT;
                }
            },

            faceRight: function(){
                if (this.direction === UP || this.direction === DOWN){
                    this.heading = RIGHT;
                }
            },

            faceUp: function(){
                if (this.direction === LEFT || this.direction === RIGHT){
                    this.heading = UP;
                }
            },

            faceDown: function(){
                if (this.direction === LEFT || this.direction === RIGHT){
                    this.heading = DOWN;
                }
            },

            move: function (time){

                switch (this.heading){
                    case RIGHT:
                        this.headPosition.x = Phaser.Math.Wrap(this.headPosition.x+1, 0 ,40);
                        break;

                    case LEFT:
                        this.headPosition.x = Phaser.Math.Wrap(this.headPosition.x-1, 0 , 40);
                        break;

                    case UP:
                        this.headPosition.y = Phaser.Math.Wrap(this.headPosition.y-1, 0 , 30);
                        break;

                    case DOWN:
                        this.headPosition.y = Phaser.Math.Wrap(this.headPosition.y+1, 0 , 30);
                        break;
                }

                this.direction = this.heading;

                /* ShiftPosition für Anordnung des Körpers (Letzte Zahl gibt die Richtung an, dass jedes Element des Arrays den Wert des vorherigen nimmt (0), oder jedes nachkommende (1))*/

                Phaser.Actions.ShiftPosition(this.body.getChildren(), this.headPosition.x*16, this.headPosition.y*16, 1, this.tail);

                var bodyCollision = Phaser.Actions.GetFirst(this.body.getChildren(), { x: this.head.x, y: this.head.y }, 1);
                if (bodyCollision){
                    console.log('dead');

                    this.alive = false;

                    return false;
                }
                else{

                    this.moveTime = time + this.speed;

                    return true;
                }
            },

            grow: function (){
                var newPart = this.body.create(this.tail.x, this.tail.y, 'snake');

                newPart.setOrigin(0);
            },

            collideWithFood: function (food){

                if (this.head.x === food.x && this.head.y === food.y){
                    this.grow();

                    food.eat();

                    if (this.speed > 20 && food.total % 5 === 0){
                        this.speed -= 3;
                    }

                    return true;
                }
                else{
                    return false;
                }
            },


        });

        scoreText = this.add.text(10, 10, 'score: 0', { font: '20px Impact', fill: '#000' }).setDepth(1);
        highscoreLabel = this.add.text(510, 10, 'Highscore: ' + highscore, { font: '20px Impact', fill: '#000' }).setDepth(1);

        food = new Food(this, 3, 4);

        snake = new Snake (this, 8, 8);

        cursors = this.input.keyboard.createCursorKeys();
    }


    update (time){

        if (!snake.alive){

            this.scene.start("gameOverScene");

            return;
        }

        if (cursors.left.isDown)
        {
            snake.faceLeft();
        }
        else if (cursors.right.isDown)
        {
            snake.faceRight();
        }
        else if (cursors.up.isDown)
        {
            snake.faceUp();
        }
        else if (cursors.down.isDown)
        {
            snake.faceDown();
        }

        if(snake.update(time))
        {
            snake.collideWithFood(food);
        }

    }
}
