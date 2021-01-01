var config = {
    type: Phaser.AUTO,
    width: 800,
    height: 600,
    parent: 'game-window',
    physics: {
        default: 'arcade',
        arcade: {
            gravity: { y: 300 },
            debug: false
        }
    },
    scene: [ titleScene, gameScene, gameOverScene ]
};


var game = new Phaser.Game(config);






