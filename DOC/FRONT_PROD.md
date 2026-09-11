## APP/VIEWS/LAYOUTS/

## base.php
```php

<?php
if(!isset($view)) {
    http_response_code(500);
    exit('View not defined');
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Portfolio</title>
        
        <link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    </head>

    <body>

        <?php require_once BASE_PATH . '/app/views/partials/header.php'; ?>

        <main class="main">
            <?php require_once $view; ?>
        </main>

        <?php require_once BASE_PATH . '/app/views/partials/footer.php'; ?>

        <!-- JS Global -->
         <script type="module" src="<?= BASE_URL ?>/assets/js/main.js"></script>

    </body>

</html>

```

## VIEWS/PARTIALS============================

## header.php
```php
<?php
$currentView = $_GET['v'] ?? 'home';
?>

<header class="header">

    <div class="header-container">

        <div class="logo">
            <a href="<?= INDEX_URL ?>?v=home">
                Ángel Plata Benítez
            </a>
        </div>

        <nav>
            <?php if ($currentView !== 'home'): ?>
                <a href="<?= INDEX_URL ?>?v=home">Home</a>
            <?php endif ?>
            <?php if ($currentView !== 'gallery'): ?>
                <a href="<?= INDEX_URL ?>?v=gallery">Gallery</a>
            <?php endif ?>
            <?php if ($currentView !== 'writsList'): ?>
                <a href="<?= INDEX_URL ?>?v=writsList">Writings</a>
            <?php endif ?>
            <?php if ($currentView !== 'minigames'): ?>
                <a href="<?= INDEX_URL ?>?v=minigames">Minigames</a>
            <?php endif ?>
        </nav>
    </div>
</header>

```

## footer.php
```php
<footer>
    <p>&copy; <?= date("Y") ?> Ag Sys</p>
</footer>

```

## VIEWS=================================================

## gallery.php
```php
<?php

$imagesDir = BASE_PATH . '/public/assets/img/gallery';
$images = scandir($imagesDir);

?>


<section class="gallery">

    <div class="gallery-header">
        <h1>Gallery</h1>
    </div>

    <div class="gallery-grid">

        <?php foreach ($images as $image): ?>

            <?php
            if (pathinfo($image, PATHINFO_EXTENSION) !== 'jpg') {
                continue;
            }
            ?>
            <div class="gallery-item">
                <img
                    src="<?= BASE_URL ?>/assets/img/gallery/<?= $image ?>"
                    data-full="<?= BASE_URL ?>/assets/img/gallery/<?= $image ?>"
                    class="gallery-img"
                    alt="">
            </div>
        <?php endforeach ?>
    </div>

    <div id="lightbox" class="lightbox hidden">
        <img id="lightbox-img" src="" alt="">
    </div>

</section>

```

## skills.php
```php
<section class="cv-page">

    <header class="cv-header">
        <div class="cv-photo-wrapper">
            <img
                src="<?= BASE_URL ?>/assets/img/chad.jpg"
                alt="Ángel Plata"
                class="cv-photo">
        </div>

        <div class="cv-header-info">
            <h1>Ángel Plata Benítez</h1>
            <p>Desarrollador de Aplicaciones Web en ciernes</p>

            <div class="cv-contact">
                <p>(+34) 652 955 515</p>
                <p>angel.plata@outlook.es</p>
            </div>
        </div>
                    <div class="cv-links">
                <a
                    href="https://github.com/Marmiril"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn">Github accuount >>>
                </a>
                <a
                    href="https://www.linkedin.com/in/angelplatabenz"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn">LinkedIn >>>
                </a>
            </div>
    </header>


    <div class="cv-layout">

        <aside class="cv-sidebar">

            <section class="cv-block">
                <h2>Habilidades</h2>

                <ul>
                    <li>Lenguajes & Desarrollo Web: C#, Java, JavaScript, PHP, HTML, CSS.</li>
                    <li>Base de datos: MySQL.</li>
                    <li>Herramientas & Entornos: Visual Studio Code/Visual Studio, Xamm, GitHub.</li>
                    <li>Seguridad Informática: Ciberseguridad aplicada a la empresa, auditoría de sistemas, IA aplicada a la empresa.</li>
                    <li>Suite de Microsoft Office (Word, Excel, PowerPoinr) y manejo de herramientas similares de otras plataformas.</li>
                </ul>

                <ul>
                    <li>Español: nativo (C2)</li>
                    <li>Inglés: fluido (C1) - hablado y escrito</li>
                    <li>Griego: intermedio (B1) - hablado</li>
                    <li>Catalán: básico(A2) - comprensión </li>
                </ul>

                <p>Carnet de conducir: A/B</p>
            </section>

            <section class="cv-block">
                <h2>Formación</h2>

                <ul>
                    <li>Grado Superior en Desarrollo de Aplicaciones Web (cursando)</li>
                    <li>Licenciado en Derecho por la Universidad de Granada, 1998-2003</li>
                    <li>C.A.P (Certificado de Aptitud Pedagógica) en inglés, Universidad de Granada, 2004</li>
                    <li>IA aplicada a la empresa - Academia 080, 2025</li>
                    <li>CiberSeguridad aplicada a la empresa - Academia 080, 2025</li>
                    <li>Auditoría de Seguridad Informática - MainJobs, 2025</li>
                    <li>Bootcamp Agentes IA - Udemy, 2026</li>
                </ul>
            </section>

        </aside>

        <section class="cv-main">

            <section class="cv-block">
                <h2>Acerca de mi</h2>
                <p>
                    Altamente organizado, poseo gran capacidad para la resolución de incidencia yr´paida adaptación
                    a nuevas tecnologías. Interesado en seguir desarrollándome en el ámbito backend, aportando mis
                    habilidades técnincas y manteniendo una actitud constante de aprendizaje.
                </p>

                <ul>
                    <li>Aprendizaje contínuo y adaptación a NNTT.</li>
                    <li>Liderazgo y trabajo en equipo en entornos multiculturales.</li>
                    <li>Comunicación asertiva.</li>
                    <li>Pensamiento analítico y resolutivo.</li>
                    <li>Gestión de archivos, elaboración de reportes.</li>
                </ul>

                <p>Actualmente disponible para entrevistas y abierto a nuevos horizontes profesionales.</p>
            </section>

            <section class="cv-block">
                <h2>Experiencia laboral</h2>

                <article class="cv-job">
                    <h3>Coordinador Comercial</h3>
                    <p><strong>Konecta BTO</strong> - Barcelona | 2016 - 2023</p>
                    <ul>
                        <li>Coordinación y supervisión de equipos comerciales.</li>
                        <li>Análisis de resultado y seguimiento de objetivos.</li>
                        <li>Control de KPIs y gestión administrativa.</li>
                    </ul>
                </article>

                <article class="cv-job">
                    <h3>Propietario y gerente</h3>
                    <p><strong>La Gotera</strong> - Granada | 2013 - 2015</p>
                    <ul>
                        <li>Gestión comercial y financiera del negocio.</li>
                        <li>Atención al cliente y relaciones con proveedores.</li>
                        <li>Implementación de estrategias de marketing.</li>
                    </ul>
                </article>

                <article class="cv-job">
                    <h3>Administrativo</h3>
                    <p><strong>Leeds Properties</strong> - Leeds, UK | 2011 - 2012</p>
                    <ul>
                        <li>Gestión adiministrativa y comercial de propiedades.</li>
                        <li>Atención al cliente y coordinación con otros departamentos.</li>
                        <li>Mantenimiento e inventario</li>
                    </ul>
                </article>

                <article class="cv-job">
                    <h3>Hostelería</h3>
                    <p><strong>La Marisma & Carlos I</strong> - Granada | 2008 - 2011</p>
                    <ul>
                        <li>Atención al cliente y relaciones con proveedores</li>
                    </ul>
                </article>

            </section>

        </section>

    </div>

</section>

```

## home.php
```php
<section class="hero">
    <div class="hero-content">

        <img src="<?= BASE_URL ?>/assets/img/chad.jpg" alt="Profile photo" class="hero-avatar">

        <h1>Ángel Plata Benítez</h1>
        <p class="hero-subtitle">Desarrollador de Aplicaciones Web</p>
        
        <div class="hero-actions">
            <a href="<?= INDEX_URL ?>?v=skills" class="btn">Skills</a>
            <a href="<?= INDEX_URL ?>?v=projects" class="btn">Projects</a>
        </div>

    </div>
</section>

```

## minigames.php
```php
<section class="minigames">

    <div class="minigames-header">
        <h1>Minigames</h1>
    </div>

    <div class="minigames-grid">
        <?php
        $minigames = [
            [
                'img' => 'strange_fishig.jpg',
                'href' => BASE_URL . '/apps/StrangeFishing/public/index.html',
                'download' => false
            ],
            [
                'img' => 'evplupong.jpg',
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
                    src="<?= BASE_URL ?>/assets/img/minigames/<?php $game['img'] ?>"
                    class="minigame-img"
                    alt="">
            </a>
        <?php endforeach ?>



    </div>

</section>
```

## projects.php
```php
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
            <a href="<? BASE_URL ?>/apps/TaleTeller/index.php" class="project-card">
                <img src="<? BASE_PATH ?>/assets/img/projects/<?= $project_img ?>"
                    class="project-img">
            </a>
        <?php endforeach ?>
    </div>
</section>

```

## writing.php
```php
<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(404);
    exit('Writing not found');
}

$file = BASE_PATH . "/app/data/writings/$id.txt";

if (!file_exists($file)) {
    http_response_code(404);
    exit('Writing not found');
}

$bg = BASE_URL . "/assets/img/writings/$id.jpg";

$lines = file($file);
$title = trim($file[0] ?? 'Untitle');

$contentLines = array_slice($lines, 2);

$content = '';

foreach ($contentLines as $line) {
    $line = trim($line);
    if ($line !== '') {
        $content .= '<p>' . htmlspecialchars($line) . '</p>';
    }
}
?>
<section class="writing-wrapper">
    <div class="writing-bg" style="background-image: url('<?= $bg ?>')"></div>

    <div class="writing">
        <h1><?= htmlspecialchars($title) ?></h1>

        <div class="writing-content">
            <?= $content ?>
        </div>
    </div>

</section>

```

## wirtsList.php
```php
<?php

$writsDir = BASE_PATH . '/app/data/writings';
$files = scandir($writsDir);

?>

<section class="gallery">

    <div class="gallery-header">
        <h1>The Writings</h1>
    </div>

    <div class="gallery-grid">
        <?php foreach($files as $file): ?>

            <?php
            if (pathinfo($file, PATHINFO_EXTENSION) !== 'txt') {
                continue;
            }

            $id = pathinfo($file, PATHINFO_FILENAME);
            $path = $writsDir . '/' . $file;

            $lines = file($path);
            $title = trim($lines[0] ?? 'Sin título');

            $img = BASE_URL . "/assets/img/writings/$id.jpg";
            ?>
            
            <a href="<?= INDEX_URL ?>?v=writing&id=<?= $id ?>" class="gallery-item">
            
                <img src="<?= $img ?> " alt="<?= htmlspecialchars($title) ?>">

                <h3 class="writing-title">
                    <?= htmlspecialchars($title) ?>
                </h3>

            </a>
        
        <?php endforeach ?>

    </div>
</section>

```

## CONFIG

## config.php
```php
<?php

define('BASE_PATH', dirname(__DIR__));

define('BASE_URL', '');

define('INDEX_URL', '/index.php');

```


## PUBLIC

## index.php
```php
<?php

// config.php load
require_once dirname(__DIR__) . '/config/config.php';

// View
$viewKey = $_GET['v'] ?? 'home';

// Views map
$views = [
    'home'      => BASE_PATH . '/app/views/home.php',
    'skills'    => BASE_PATH . '/app/views/skills.php',
    'gallery'   => BASE_PATH . '/app/views/gallery.php',
    'writsList' => BASE_PATH . '/app/views/writsList.php',
    'writing'   => BASE_PATH . '/app/views/writing.php',
    'projects'  => BASE_PATH . '/app/views/projects.php',
    'contact'   => BASE_PATH . '/app/views/contact.php',
    'minigames' => BASE_PATH . '/app/views/minigames.php'
];

// Validation
if (!isset($views[$viewKey])) {
    http_response_code(404);
    exit('View not found');
}

$view = $views[$viewKey];

// Render layout
require_once BASE_PATH . '/app/views/layouts/base.php';

```
