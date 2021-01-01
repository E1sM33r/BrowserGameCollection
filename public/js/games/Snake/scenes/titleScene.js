class titleScene extends Phaser.Scene{
    constructor() {
        super({key:"titleScene"});

    }

    preload(){

    }

    create(){
        const text = this.add.text(320,240, 'Title Screen', { font: '20px Impact', fill: '#000' });
        text.setOrigin(0.5, 0.5);

        this.input.on('pointerdown', function (event) {
            this.scene.start("gameScene");
        }, this);
    }

}