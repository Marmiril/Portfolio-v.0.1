import { Fish } from '../models/Fish.js';

export function initRandomFish(name) {

    
    const r = Math.floor(Math.random() * (6 - 1 + 1)) + 1;
    const image = `../assets/img/fish0${r}.png`;

    const root = document.getElementById('fishingGameRoot');

    const width = root.clientWidth;
    const height = root.clientHeight;

    const randX = getRandom(0, width);
    const randY = getRandom(0, height);

    const size = getRandom(0, 1) === 0 ? 70 : 120;

    const fishWidth = size;
    const fishHeight = size;

    const movementTypes = [
        "horizontal",
        "vertical",
        "zigzagX",
        "zigzagY",
        "diagonal"
    ];

    const index = getRandom(0, movementTypes.length - 1);
    const movementType = movementTypes[index];   
    
    const margin = 50;

    let x = randX > width - fishWidth ? width - fishWidth : randX;
    let y = randY > height - fishWidth ? height - fishWidth : randY;    

    if (movementType === 'vertical') {
        x = getRandom(margin, width - fishWidth - margin)
    }

    
    if (movementType === 'horizontal') {
        y = getRandom(margin, height - fishHeight - margin)
    }

    const amplitude = getRandom(5, 15) + 0.15;
    const frequency = Math.random() * (0.15 - 0.05) + 0.05;


    return new Fish ({
        name,
        image,
        x,
        y,
        movementType,
        amplitude,
        frequency,
        size,
        container: root
    });
}

function getRandom(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };
