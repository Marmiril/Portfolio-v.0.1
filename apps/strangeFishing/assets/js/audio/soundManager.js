const backgroundSound = new Audio('../assets/audio/background.mp3');
const loseSound = new Audio('../assets/audio/lose.mp3');
const pointSound = new Audio('../assets/audio/point.mp3');
const winSound = new Audio('../assets/audio/win.mp3');
const beginSound = new Audio('../assets/audio/begin.mp3');
const cancelSound = new Audio('../assets/audio/cancel.mp3');

backgroundSound.loop = true;

export function playBackgroundSound() {
    backgroundSound.play();
}

export function playLoseSound() {
    loseSound.currentTime = 0;
    loseSound.play();
}

export function playPointSound() {
    pointSound.currentTime = 0;
    pointSound.play();
}

export function playWinSound() {
    winSound.currentTime = 0;
    winSound.play();
}

export function playBeginSound() {
    beginSound.currentTime = 0;
    beginSound.play();
}

export function playCancelSound() {
    cancelSound.currentTime = 0;
    cancelSound.play();
}