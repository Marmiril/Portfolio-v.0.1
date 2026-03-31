import { Fish } from './models/Fish.js';
import { fishTypes } from './data/fishTypes.js';
import { initRandomFish } from './utils/randomFish.js'
import { initFishGameController } from './controllers/gameController.js';

// GAME CONTAINER
const root = document.getElementById('fishingGameRoot');

// START ANIMATION

initFishGameController();

