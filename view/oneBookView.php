<?php
ob_start();
$title = $book->getTitle();

?>
<main class="container">
    <h1><?= $book->getTitle(); ?></h1>
    <section class="card">
        <figure>
            <!-- TODO : faire le lien img avec URL -->
            <img src="<?= URL.$book->getImg(); ?>" alt="<?= $book->getTitle(); ?>">
        </figure>

        <article class="card-body">
            <p class="card-text"><?= $book->getNbPages(); ?></p>
        </article>
    </section>
</main>

<?php
$content = ob_get_clean();
require_once "view/template.php";
