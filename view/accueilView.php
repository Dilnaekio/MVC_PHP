<?php ob_start() ?>

<main class="container">
    <section>
        <p>KOUKOU, il n'y a rien sur cette page, go cliquer sur "livres"</p>
    </section>

</main>

<?php $title = "Accueil";
$content = ob_get_clean();
require_once "view/template.php";
