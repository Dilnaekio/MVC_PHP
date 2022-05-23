<?php
ob_start();
$title = $book->getTitle();

?>
<main class="container">
    <section class="card">
        <figure>
            <img src="<?= URL . $book->getImg(); ?>" alt="<?= $book->getTitle(); ?>">
        </figure>

        <article class="card-body">
            <p class="card-text">Pages : <?= $book->getNbPages(); ?></p>
        </article>
    </section>
</main>

<?php
$content = ob_get_clean();
require_once "view/template.php";
