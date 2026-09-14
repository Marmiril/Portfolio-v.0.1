<section class="minigames">

    <div class="minigames-header">
        <h1>Minigames</h1>
    </div>

    <div class="minigames-grid">
        <?php
        $minigames = [
            [
                'img' => 'strange_fishing.jpg',
                'href' => BASE_URL . '/apps/strangeFishing/public/index.html',
                'download' => false
            ],
            [
                'img' => 'evolupong.jpg',
                'href' => BASE_URL . '/assets/download/Evolupong.zip',
                'download' => true
            ]
        ];
        foreach ($minigames as $game): ?>
            <a
                href="<?= $game['href'] ?>"
                class="minigame-card"
                <?= $game['download'] ? 'download' : '' ?>>
                <img
                    src="<?= BASE_URL ?>/assets/img/minigames/<?= $game['img'] ?>"
                    class="minigame-img"
                    alt="">
            </a>
        <?php endforeach ?>



    </div>

</section>
