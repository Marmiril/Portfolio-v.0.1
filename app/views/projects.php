<section class="projects">

    <div class="projects-header">
        <h1>Projects</h1>
    </div>

    <div class="projects-grid">
        <?php
        $projects_img = [
            'tale_teller.jpg'
        ];
        foreach ($projects_img as $project_img): ?>
            <a href="<?= BASE_URL ?>/apps/TaleTeller/index.php" class="project-card">
                <img src="<?= BASE_URL ?>/assets/img/projects/<?= $project_img ?>"
                    class="project-img">
            </a>
        <?php endforeach ?>
    </div>
</section>
