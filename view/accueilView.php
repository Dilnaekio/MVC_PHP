<?php ob_start() ?>

<p>AccueilView.php</p>

<?php $title = "Accueil";
$content = ob_get_clean();
require_once "view/template.php";