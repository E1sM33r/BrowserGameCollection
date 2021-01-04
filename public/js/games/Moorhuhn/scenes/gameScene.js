let bird;
let score = 0;
let highscore = 0;
if(document.getElementById("oldHighscore")){
    highscore = document.getElementById('oldHighscore').value;
}
let ammo = 5;
let scoreLabel;
let ammoLabel;
let timerLabel;
let reloadLabel;
let reloading = false;
let gameOver = false;
let shooting = false;
let canShoot = true;
let timedEvent;
let keyR;
let timer = 60;
let timerDecrease;
let nextShot;
let reloadTime = 500;
let shootCooldown = 500;


class gameScene extends Phaser.Scene {
    constructor() {
        super({key: "gameScene"});

    }

    preload(){
        this.load.image('bird', '/js/games/Moorhuhn/assets/bird.png');
    }

    create(){
        //Hintergrund setzen
        this.cameras.main.setBackgroundColor('#71c5cf');

        //Cursor ändern
        this.input.setDefaultCursor('url(/js/games/Moorhuhn/assets/crosshair.png), pointer');

        //Label für Score und Munition setzen
        scoreLabel = this.add.text(10, 10, 'Score: 0', { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        ammoLabel = this.add.text(670, 10, 'Schuss: 5', { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        timerLabel = this.add.text(400, 10, 'Time: ' + timer, { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        timerLabel.setOrigin(0.5, 0);
        reloadLabel = this.add.text(400, 250, '', { font: "35px Arial", fill: "#ffffff" }).setDepth(1);
        reloadLabel.setOrigin(0.5, 0.5);

        //Timer setzen
        timerDecrease = this.time.addEvent({ delay: 1000, callback: this.decreaseTimer, callbackScope: this, loop: true });


        //Vögel erstellen, einer pro Sekunde
        timedEvent = this.time.addEvent({ delay: 1000, callback: this.addBird, callbackScope: this, loop: true });

        //Steuerung: Linksklick=Schießen, R=Reload
        nextShot = this.time.now;
        this.input.on('pointerdown', this.shoot, this);
        keyR = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.R);

    }

    update(){

        if (Phaser.Input.Keyboard.JustDown(keyR)){
            if (!reloading) {
                if (ammo<5) {
                    this.reload();
                }
            }
        }

        if (timer == 0){
            gameOver = true;
        }

        if (gameOver){
            this.scene.start("gameOverScene");
        }

        if (ammo == 0){
            if (!reloading){
                this.reload();
            }
            reloading = true;
        }

        if (shooting){
            this.shoot();
            shooting = false;
        }

        if (nextShot<this.time.now){
            canShoot = true;
        }else{
            canShoot = false;
        }
    }

    decreaseTimer(){
        timer--;
        timerLabel.setText('Time: ' + timer);
    }

    addBird(){
        //Random Direction, Height and Speed
        let direction = Math.floor(Math.random() * 2);
        let height = Math.floor(Math.random() * 300) + 50;
        let speed = Math.floor(Math.random() * 100) + 150;


        if (direction == 0){
            bird = this.physics.add.sprite(-50, height, 'bird').setInteractive({ cursor: 'url(/js/games/Moorhuhn/assets/crosshairRed.png), pointer' });
            bird.input.hitArea.setTo(-14, -14, 32, 32);
            bird.on('pointerdown', this.birdHit);
            bird.body.velocity.x = speed;
            bird.checkWorldBounds = true;
            bird.outOfBoundsKill = true;
        }else{
            bird = this.physics.add.sprite(850, height, 'bird').setInteractive({ cursor: 'url(/js/games/Moorhuhn/assets/crosshairRed.png), pointer' });
            bird.input.hitArea.setTo(-14, -14, 32, 32);
            bird.on('pointerdown', this.birdHit);
            bird.body.velocity.x = -speed;
            bird.checkWorldBounds = true;
            bird.outOfBoundsKill = true;
        }
    }

    birdHit(){
        if (!reloading) {
            if (canShoot) {
                this.destroy();
                score++;
                scoreLabel.setText('Score: ' + score);
                shooting = true;
            }
        }
    }

    shoot(){
        if (!reloading) {
            if (canShoot) {
                ammo--;
                ammoLabel.setText('Schuss: ' + ammo);
                nextShot = this.time.now + shootCooldown;
            }
        }
    }

    reload(){
        reloading = true;
        reloadLabel.setText('Reloading...');
        this.time.addEvent({ delay: reloadTime, callback: function(){
                ammo++;
                ammoLabel.setText('Schuss: ' + ammo);
                if (ammo == 5){
                    reloading = false;
                    reloadLabel.setText('');
                }
            }, callbackScope: this, repeat: (4-ammo) });
    }
}

