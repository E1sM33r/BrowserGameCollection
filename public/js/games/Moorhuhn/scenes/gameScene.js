let bird;
let bomb;
let hourglass;
let score = 0;
let highscore = 0;
let ammo = 5;
let reloadTime = 500;
let shootCooldown = 500;
let timer = 60;
let reloading = false;
let gameOver = false;
let shooting = false;
let canShoot = true;
let muteSound = true;
let scoreLabel;
let ammoLabel;
let timerLabel;
let reloadLabel;
let highscoreLabel;
let keyR;
let keyM;
let nextShot;
let shootSound;
let reloadSound;
let reloadFinishSound;
let rowCheck = [false, false, false, false, false, false, false, false, false, false]


class gameScene extends Phaser.Scene {
    constructor() {
        super({key: "gameScene"});

    }

    preload(){
        this.load.audio('shot', '/js/games/Moorhuhn/assets/shot.mp3');
        this.load.audio('reload', '/js/games/Moorhuhn/assets/reload.mp3');
        this.load.audio('reloadFinished', '/js/games/Moorhuhn/assets/reloadFinished.mp3');
        this.load.spritesheet('birdRed', '/js/games/Moorhuhn/assets/birdRed.png', { frameWidth: 46, frameHeight: 32 });
        this.load.spritesheet('birdGray', '/js/games/Moorhuhn/assets/birdGray.png', { frameWidth: 44, frameHeight: 32 });
        this.load.spritesheet('birdBlue', '/js/games/Moorhuhn/assets/birdBlue.png', { frameWidth: 44, frameHeight: 32 });
        this.load.spritesheet('bomb', '/js/games/Moorhuhn/assets/bomb.png', { frameWidth: 32, frameHeight: 32 });
        this.load.spritesheet('hourglass', '/js/games/Moorhuhn/assets/hourglass.png', { frameWidth: 32, frameHeight: 32 });
    }

    create(){
        //Hintergrund setzen
        this.cameras.main.setBackgroundColor('#71c5cf');

        //Cursor ändern
        this.input.setDefaultCursor('url(/js/games/Moorhuhn/assets/crosshair.png), pointer');

        //Sounds laden
        shootSound = this.sound.add('shot');
        reloadSound = this.sound.add('reload');
        reloadFinishSound = this.sound.add('reloadFinished');

        //Label für Score und Munition setzen
        scoreLabel = this.add.text(10, 10, 'Score: 0', { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        ammoLabel = this.add.text(670, 10, 'Schuss: 5', { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        timerLabel = this.add.text(400, 10, 'Time: ' + timer, { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        highscoreLabel = this.add.text(630, 565, 'Highscore: ' + highscore, { font: "26px Arial", fill: "#ffffff" }).setDepth(1);
        timerLabel.setOrigin(0.5, 0);
        reloadLabel = this.add.text(400, 250, '', { font: "35px Arial", fill: "#ffffff" }).setDepth(1);
        reloadLabel.setOrigin(0.5, 0.5);

        //Timer setzen
        this.time.addEvent({ delay: 1000, callback: this.decreaseTimer, callbackScope: this, loop: true });

        // Flug Animation
        this.anims.create({
            key: 'flyRed',
            frames: this.anims.generateFrameNumbers('birdRed', { start: 0, end: 3 }),
            frameRate: 8,
            repeat: -1
        });
        this.anims.create({
            key: 'flyGray',
            frames: this.anims.generateFrameNumbers('birdGray', { start: 0, end: 3 }),
            frameRate: 8,
            repeat: -1
        });
        this.anims.create({
            key: 'flyBlue',
            frames: this.anims.generateFrameNumbers('birdBlue', { start: 0, end: 3 }),
            frameRate: 8,
            repeat: -1
        });
        this.anims.create({
            key: 'bombFly',
            frames: this.anims.generateFrameNumbers('bomb', { start: 0, end: 3 }),
            frameRate: 8,
            repeat: -1
        });
        this.anims.create({
            key: 'hourglassFly',
            frames: this.anims.generateFrameNumbers('hourglass', { start: 0, end: 3 }),
            frameRate: 8,
            repeat: -1
        });


        //Vögel, Bomben, Sanduhren erstellen, in Intervall
        this.time.addEvent({ delay: 1000, callback: this.addBird, callbackScope: this, loop: true });
        this.time.addEvent({ delay: 4000, callback: this.addBomb, callbackScope: this, loop: true });
        this.time.addEvent({ delay: 10000, callback: this.addHourglass, callbackScope: this, loop: true });

        //Steuerung: Linksklick = Schießen, R = Reload, M = Mute Sound
        nextShot = this.time.now;
        this.input.on('pointerdown', this.shoot, this);
        this.input.mouse.disableContextMenu();
        keyR = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.R);
        keyM = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.M);
    }

    update(){

        if (Phaser.Input.Keyboard.JustDown(keyR)){
            if (!reloading) {
                if (ammo<5) {
                    this.reload();
                }
            }
        }

        if (Phaser.Input.Keyboard.JustDown(keyM)){
            this.sound.mute = muteSound;
            muteSound = !muteSound;
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

    shoot(){
        if (!reloading) {
            if (canShoot) {
                shootSound.play();
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
                    reloadLabel.setText('');
                    reloadFinishSound.play();
                    this.time.addEvent({ delay: 350, callback: function (){reloading = false;}, callbackScope: this, loop: false });
                }else{
                    reloadSound.play();
                }
            }, callbackScope: this, repeat: (4-ammo) });
    }

    getEmptyRow(){
        let randomRow = Math.floor(Math.random() * 10) + 1;
        let rowFound = false;
        let height;

        while (true) {
            if (!rowFound) {
                for (let i = 1; i < 11; i++) {
                    if (i == randomRow) {
                        if (!rowCheck[i]) {
                            height = 36 * i + 32;
                            rowCheck[i] = true;
                            this.rowTimer(i);
                            rowFound = true;
                        } else {
                            if (randomRow < 10) {
                                randomRow++;
                            } else {
                                randomRow = 1;
                            }
                        }
                    }
                }
            }else{
                break;
            }
        }

        return height;
    }

    rowTimer(row){
        this.time.addEvent({ delay: 5000, callback: function (){rowCheck[row] = false;}, callbackScope: this, loop: false });
    }

    addBird(){
        //Random Direction, Height and Speed
        let random = Math.floor(Math.random() * 101);
        let direction = Math.floor(Math.random() * 2);
        let height = this.getEmptyRow();
        let speed = 0;
        let speedDirection = 1;
        let startPosition = 0;
        let birdColor = '';
        let points = 0;
        let anim = '';
        let flip = false;

        if (random <= 70){
            birdColor = 'birdGray';
            anim = 'flyGray';
            speed = Math.floor(Math.random() * 30) + 150;
            points = 1;
        }
        if (random > 70 && random <= 90){
            birdColor = 'birdBlue';
            anim = 'flyBlue';
            speed = Math.floor(Math.random() * 30) + 220;
            points = 2;
        }
        if (random > 90 && random < 100){
            birdColor = 'birdRed';
            anim = 'flyRed';
            speed = Math.floor(Math.random() * 30) + 280;
            points = 5;
        }

        if (direction == 0){
            startPosition = -50;
        }else{
            startPosition = 850;
            speedDirection = -1;
            flip = true;
        }

        // Bird erstellen
        bird = this.physics.add.sprite(startPosition, height, birdColor).setInteractive({ cursor: 'url(/js/games/Moorhuhn/assets/crosshairRed.png), pointer' });
        bird.flipX = flip;
        bird.input.hitArea.setTo(-14, -14, 32, 32);
        bird.setState(points);
        bird.body.velocity.x = speedDirection * speed;
        bird.checkWorldBounds = true;
        bird.outOfBoundsKill = true;
        bird.anims.play(anim, true);
        bird.on('pointerdown', this.birdHit);
    }

    birdHit(){
        if (!reloading) {
            if (canShoot) {
                this.destroy();
                score += this.state;
                scoreLabel.setText('Score: ' + score);
                shooting = true;
            }
        }
    }

    addBomb(){
        let direction = Math.floor(Math.random() * 2);
        let height = this.getEmptyRow();
        let speedDirection = 1;
        let startPosition = 0;
        let flip = false;

        if (direction == 0){
            startPosition = -50;
        }else{
            startPosition = 850;
            speedDirection = -1;
            flip = true;
        }

        bomb = this.physics.add.sprite(startPosition, height, 'bomb').setInteractive({ cursor: 'url(/js/games/Moorhuhn/assets/crosshairRed.png), pointer' });
        bomb.flipX = flip;
        bomb.input.hitArea.setTo(-14, -14, 32, 32);
        bomb.body.velocity.x = speedDirection * 180;
        bomb.checkWorldBounds = true;
        bomb.outOfBoundsKill = true;
        bomb.anims.play('bombFly', true);
        bomb.on('pointerdown', function(){gameOver = true});
    }

    addHourglass(){
        let direction = Math.floor(Math.random() * 2);
        let height = this.getEmptyRow();
        let speedDirection = 1;
        let startPosition = 0;
        let flip = false;

        if (direction == 0){
            startPosition = -50;
        }else{
            startPosition = 850;
            speedDirection = -1;
            flip = true;
        }

        hourglass = this.physics.add.sprite(startPosition, height, 'hourglass').setInteractive({ cursor: 'url(/js/games/Moorhuhn/assets/crosshairRed.png), pointer' });
        hourglass.flipX = flip;
        hourglass.input.hitArea.setTo(-14, -14, 32, 32);
        hourglass.body.velocity.x = speedDirection * 280;
        hourglass.checkWorldBounds = true;
        hourglass.outOfBoundsKill = true;
        hourglass.anims.play('hourglassFly', true);
        hourglass.on('pointerdown', this.addTime);
    }

    addTime(){
        if (!reloading) {
            if (canShoot) {
                this.destroy();
                timer += 5;
                timerLabel.setText('Time: ' + timer);
                shooting = true;
            }
        }
    }
}

