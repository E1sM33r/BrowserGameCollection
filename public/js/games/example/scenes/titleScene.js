class titleScene extends Phaser.Scene{
    constructor() {
        super({key:"titleScene"});

    }

    preload(){

    }

    create(){
        const text = this.add.text(400,150, 'Title Screen');
        text.setOrigin(0.5, 0.5);

        this.input.on('pointerdown', function (event) {
            this.scene.start("gameScene");
        }, this);
    }

}