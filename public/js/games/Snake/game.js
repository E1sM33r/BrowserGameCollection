var config = {
    type: Phaser.WEBGL,
    width: 640,
    height: 480,
    backgroundColor: '#F1F1F1',
    parent: 'game-window',
    scene: [ titleScene, gameScene, gameOverScene ]
};

var game = new Phaser.Game(config);








