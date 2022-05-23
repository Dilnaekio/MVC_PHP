<?php
ob_start();

?>

<p><?= $e->getMessage(); ?></p>

<?php $title = "Erreurs";
$content = ob_get_clean();
require_once "view/template.php";
