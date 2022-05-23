<?php
ob_start();

?>

<main class="container">
    <section>
        <form action="<?= URL ?>livres/modifValider" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idBook" value="<?= $book->getId(); ?>">
            <label for="modBookName">Nom du livre</label>
            <input type="text" name="modBookName" id="modBookName" value="<?= $book->getTitle(); ?>">
            <label for="modBookPages">Nombre de pages</label>
            <input type="text" name="modBookPages" id="modBookPages" value="<?= $book->getNbPages(); ?>">
            <figure>
                <h3>Couverture actuelle :</h3>
                <img src="<?= URL ?>public/images/<?= $book->getImg(); ?>" alt="<?= $book->getTitle() ?>">
                <figcaption><?= $book->getTitle() ?></figcaption>
            </figure>
            <input type="hidden" name="currentImg" value="<?= URL ?>public/images/<?= $book->getImg(); ?>">
            <label for="modBookImg">Couverture :</label>
            <input type="file" name="modBookImg" id="modBookImg">

            <input type="submit" class="btn btn-dark" name="submitMod" value="Valider modification">
        </form>
    </section>
</main>

<?php $title = "Modifier " . $book->getTitle();
$content = ob_get_clean();
require_once "view/template.php";
