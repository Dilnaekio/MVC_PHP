<?php 
ob_start();

?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th colspan="2">Actions</th>
    </tr>
    
    <?php
    foreach($books as $book) {
    ?>
        <tr>
            <td class="align-middle"><img src="<?= $book->getImg(); ?>" alt="" width="60px;"></td>
            <td class="align-middle"><?= $book->getTitle(); ?></td>
            <td class="align-middle"><?= $book->getNbPages(); ?></td>
            <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
            <td class="align-middle"><a href="" class="btn btn-danger">Supprimer</a></td>
        </tr>
    <?php } ?>
</table>
<a href="" class="btn btn-success d-block">Ajouter</a>

<?php $title = "Accueil";
$content = ob_get_clean();
require_once "view/template.php";
