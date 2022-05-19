<?php
require "controller/LivreController.php";
$controller = new LivreController;

if (empty($_GET['page'])) {
    require "view/accueilView.php";
} else {
    switch ($_GET['page']) {
        case "accueil":
            require "view/accueilView.php";
            break;

        case "livres":
            $controller->afficherLivres();
            break;
    }
}
