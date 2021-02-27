var config = {
    type: Phaser.WEBGL,
    width: 640,
    height: 480,
    parent: 'game-window',
    backgroundColor: '#F1F1F1',
    scene: [ titleScene, gameScene, gameOverScene ]
};

var game = new Phaser.Game(config);








