<?php

if (empty($_GET['page'])) {
    require "view/accueilView.php";
} else {
    switch ($_GET['page']) {
        case "accueil":
            require "view/accueilView.php";
            break;

        case "livres":
            require "view/livresView.php";
            break;
    }
}
