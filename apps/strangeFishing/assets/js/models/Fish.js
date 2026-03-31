export class Fish {

    constructor({ name, image, x, y, movementType, container, amplitude, frequency, size }) {
        this.name = name;
        this.image = image;

        // Postion
        this.x = x;
        this.y = y;

        this.movementType = movementType; // String
        this.container = container;

        // DIRECTION
        this.directionX = 1;
        this.directionY = 1;

        // SPEED
        this.speed = 2;

        this.amplitude = amplitude;
        this.frequency = frequency;

        this.size = size;
        
        // CREATES HTML ELEMENT
        this.element = document.createElement('div');
        this.element.className = 'fishing-game__fish';

        // SET IMG INSIDE ELEMENT
        this.img = document.createElement('img');
        this.img.src = this.image;
        this.img.className = 'fishing-game__fish-base';

        // THE SHINNING
        this.shineImg = document.createElement('img');
        this.shineImg.src = this.image;
        this.shineImg.className = 'fishing-game__fish-shine';
        
        this.element.appendChild(this.img);
        this.element.appendChild(this.shineImg);


        this.element.style.width = this.size + 'px';
        this.element.style.height = this.size + 'px';

        // SET ELEMENT IN DOM
        this.container.appendChild(this.element);

        // POSITIONER
        this.updatePosition();
    }

    /* =========================
       UI METHODS
    ========================= */

    show() {
        this.element.style.display = 'block';
    }

    hide() {
        this.element.style.display = 'none';
    }

    onMouseDown(callback) {
        this.element.addEventListener('mousedown', callback);
    }



    // MAIN METHOD SUMMONED EACHFRAME
    move() {
        const fishWidth = this.element.clientWidth;
        const fishHeight = this.element.clientHeight;

        switch (this.movementType) {
            case 'horizontal':
                this.moveHorizontal(fishWidth, fishHeight);
                break;
            case 'zigzagX':
                this.movezigzagX(fishWidth, fishHeight);
                break;
            case 'zigzagY':
                this.movezigzagY(fishWidth, fishHeight);
                break;
            case 'vertical':
                this.moveVertical(fishWidth, fishHeight);
                break;
            case 'diagonal':
                this.moveDiagonal(fishWidth, fishHeight);
                break;
        }
        // ACTUALIZE POSTION ON SCREEN
        this.updatePosition();
    }

    moveHorizontal(fishWidth, fishHeight) {
        this.x += this.speed * this.directionX;
        this.handleBounds(fishWidth, fishHeight);
    }

    movezigzagX(fishWidth, fishHeight) {
        this.x += this.speed * this.directionX; //** */
        // SENOIDAL MOVEMENT FOR ZIGZAG MOVEMENT.
        this.y += Math.sin(this.x * this.frequency) * this.amplitude * this.directionY;
        this.handleBounds(fishWidth, fishHeight);
    }

    movezigzagY(fishWidth, fishHeight) {
        this.y += this.speed * this.directionY; //** ese '+ 1' es experimental */
        // SENOIDAL MOVEMENT FOR ZIGZAG MOVEMENT.
        this.x += Math.sin(this.y * this.frequency) * this.amplitude * this.directionX;
        this.handleBounds(fishWidth, fishHeight);
    }

    moveVertical(fishWidth, fishHeight) {
        this.y += this.speed * this.directionY;
        this.handleBounds(fishWidth, fishHeight);
    }

    moveDiagonal(fishWidth, fishHeight) {
        // SIMULTANEUS MOVEMENT.
        this.x += this.speed * this.directionX;
        this.y += this.speed * this.directionY;
        this.handleBounds(fishWidth, fishHeight);
    }

    handleBounds(fishWidth, fishHeight) {
        // HORIZONTAL RICOCHET
        if (this.x <= 0) {
            this.directionX *= -1;
            this.flip();
            // Secure position
            this.x = 0;
            }
        if (this.x >= this.container.clientWidth - fishWidth) {
            this.directionX *= -1;
            this.flip();        
            // Secure position
            this.x = this.container.clientWidth - fishWidth;
        }
        // VERTICAL RIC.
        if (this.y <= 0) {
            this.directionY *= -1;
            this.y = 0;
        }
        if ( this.y >= this.container.clientHeight - fishHeight) {
            this.directionY *= -1;
            this.y = this.container.clientHeight - fishHeight;
        }
    }

    flip() { this.element.style.transform = `scaleX(${this.directionX})`; }

    // UPDATE POSITION IN DOM
    updatePosition() {
        this.element.style.left = `${this.x}px`;
        this.element.style.top = `${this.y}px`;
    }
}
