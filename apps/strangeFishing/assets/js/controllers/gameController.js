import { initRandomFish } from "../utils/randomFish.js";
import { showActionBox } from "../ui/actionBox.js";
import { closeActionBox } from '../ui/actionBox.js';
import { playBackgroundSound,
         playLoseSound,
         playPointSound,
         playWinSound,
         playBeginSound,
         playCancelSound } from '../audio/soundManager.js';

export function initFishGameController() {
    const btnStartGame = document.getElementById('btnStartGame');
    const btnCancelGame = document.getElementById('btnCancelGame')
    const hudTimer = document.getElementById('hudTimer');
    const scoreBoard = document.getElementById('scoreBoard');

    const fishes = [];
    const root = document.getElementById('fishingGameRoot');
    let isPlaying = false;
    let gameTimer = null;
    let spawnTimer = null;
    let timeLeft = 30;
    let score = 0;
    let numberFishes = 10;

    demoFishes();
    animate();

    // DEMO FISHES
    function demoFishes() {
        for (let i = 0; i < numberFishes; i++) {
            const name = `Fish_${i + 1}`;
            const fish = initRandomFish(name);
            clickScore(fish);
            fishes.push(fish);
        }
    }

    // CLEAR SCREEN
    function clearFishes() {
        fishes.length = 0;
        document.querySelectorAll('.fishing-game__fish')
            .forEach(el => el.remove());
    }

    // ANIMATE
    function animate() {
        fishes.forEach(fish => fish.move());
        requestAnimationFrame(animate);
    }

    btnStartGame.addEventListener('click', () => { actionGame(); });

    btnCancelGame.addEventListener('click', () => { cancelGame(); });

    function clickScore(fish) {
        fish.onMouseDown(() => {
            if (!isPlaying) return;

            fish.hide();
            score++;
            playPointSound();

            scoreBoard.textContent = `Score: ${score}`;

            if (fishes.length === score) {
                winBox();

                clearInterval(gameTimer);
                clearInterval(spawnTimer);

                isPlaying = false;
                btnStartGame.style.display = 'block';
                btnCancelGame.style.display = 'none';
            }
        });
    }

    function spawnFish(durationMs, unitsPerTick, frequencyMs) {

        clearInterval(spawnTimer);

        const startTime = performance.now();

        spawnTimer = setInterval(() => {

            const now = performance.now();
            const elapsed = now - startTime;

            // Fish Generation
            for (let i = 0; i < unitsPerTick; i++) {
                const name = `Fish_0${fishes.length + 1}`;
                const fish = initRandomFish(name);
                clickScore(fish);
                fishes.push(fish);
            }  // STOP
            if (elapsed >= durationMs) {
                clearInterval(spawnTimer);
            }
        }, frequencyMs);
    }

    function resetGame() {
        clearFishes();
        demoFishes();

        clearInterval(gameTimer);
        clearInterval(spawnTimer);
    }

    function actionGame() {
        playBackgroundSound();
        playBeginSound();
        root.classList.add('playing');
        console.log(fishes.length);
        if (fishes.length != numberFishes) {
            clearFishes();
            demoFishes();
        }
        
        isPlaying = true;
        // if (message) { message.textContent = ''; }

        timeLeft = 30;
        const durationMs = timeLeft * 1000;
        spawnFish(durationMs, 2, 1500);

        score = 0;
        scoreBoard.textContent = `Score: ${score}`;

        fishes.forEach(fish => {
            fish.show();
        });

        btnStartGame.style.display = 'none';
        btnCancelGame.style.display = 'block';

        gameTimer = setInterval(() => {
            timeLeft--;
            hudTimer.textContent = timeLeft;
            if (timeLeft <= 0) {

                isPlaying = false;

                if (score != fishes.length) { timeOverBox(); }

                clearInterval(gameTimer);
                clearInterval(spawnTimer);

                btnStartGame.style.display = 'block';
                btnCancelGame.style.display = 'none';
            }
        }, 1000);

    }

    function cancelGame() {
        console.log(fishes.length);
        isPlaying = false;
        root.classList.remove('playing');

        playCancelSound();
        showActionBox({
            title: 'CANCEL GAME',
            message: 'Start new game?',
            type: 'decision',
            actions: [
                {
                    label: 'YES',
                    action: () => {
                        clearFishes();
                        demoFishes();
                        actionGame(); }
                },
                {
                    label: 'NO',
                    action: () => { closeActionBox(); }
                }
            ]
        });

        clearInterval(gameTimer);
        clearInterval(spawnTimer);
        // clearFishes();

        timeLeft = 30;
        hudTimer.textContent = timeLeft;
        score = 0;

        btnStartGame.style.display = 'block';
        btnCancelGame.style.display = 'none';

        scoreBoard.textContent = `Score: ${score}`;
       // demoFishes();

    }

    function winBox() {
        playWinSound();
        root.classList.remove('playing');
        showActionBox({
            title: 'VICTORY. You fished all the fishes!',
            message: 'Play again?',
            type: 'decision',
            actions: [
                {
                    label: 'YES',
                    action: () => {
                        clearFishes();
                        demoFishes();
                        actionGame();       
                        hudTimer.textContent = 30;                                        
                    }
                },
                {
                    label: 'NO',
                    action: () => {
                        hudTimer.textContent = 30;
                        resetGame(); }
                }
            ]
        });
    }

    function timeOverBox() {
        playLoseSound();
        root.classList.remove('playing');
        showActionBox({            
            title: 'TIME-OVER - YOU LOSER!!',
            message: 'Play again?',
            type: 'decision',
            actions: [
                {
                    label: 'YES',
                    action: () => {
                        clearFishes();
                        demoFishes();
                        actionGame();
                        hudTimer.textContent = 30;
                    }
                },
                {
                    label: 'NO',
                    action: () => {
                        closeActionBox();
                        hudTimer.textContent = 30;
                    }

                }
            ]
        });
    }
}
