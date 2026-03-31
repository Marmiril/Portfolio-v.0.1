<section class="minigames">

    <div class="minigames-header">
        <h1>Minigames</h1>
    </div>

    <div class="minigames-grid">
        <?php
        $minigames_img = [
            'strange_fishing.jpg'
        ];
        foreach ($minigames_img as $game_img): ?>
            <a href="<?= BASE_URL ?>/apps/StrangeFishing/public/index.html" class="minigame-card">
                <img
                    src="<?= BASE_URL ?>/assets/img/minigames/<?= $game_img ?>"
                    class="minigame-img">
            </a>
        <?php endforeach; ?>
    </div>


</section>