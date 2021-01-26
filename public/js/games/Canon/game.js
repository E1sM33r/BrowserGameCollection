var config = {
    type: Phaser.AUTO,
    width: 640,
    height: 480,
    parent: 'game-window',
    physics: {
        default: 'arcade',
        arcade: {          
            gravity: { y: 500 },
            debug: false,
        }
    },
    scene: [ titleScene, gameScene, gameOverScene ],
};

var game = new Phaser.Game(config);


