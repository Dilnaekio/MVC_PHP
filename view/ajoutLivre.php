<?php
ob_start();
$title = "Ajouter un livre";
?>

<main class="container">
    <section class="card">
        <form action="<?= URL ?>livres/valider" method="post" enctype="multipart/form-data">
            <label for="addBookName">Nom du livre</label>
            <input type="text" name="addBookName" id="addBookName">
            <label for="addBookPages">Nombre de pages</label>
            <input type="text" name="addBookPages" id="addBookPages">
            <label for="addBookImg">Couverture :</label>
            <input type="file" name="addBookImg" id="addBookImg">

            <input type="submit" name="submitAdd" value="Ajouter">
        </form>
    </section>
</main>

<?php
$content = ob_get_clean();
require_once "view/template.php";
