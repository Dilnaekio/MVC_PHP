<?php
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]));
try {

    require "controller/LivreController.php";
    $controller = new LivreController;

    if (empty($_GET['page'])) {
        require "view/accueilView.php";
    } else {
        $url = explode("/", filter_var($_GET["page"]), FILTER_SANITIZE_URL);
        switch ($url[0]) {
            case "accueil":
                require "view/accueilView.php";
                break;

            case "livres":
                if (count($url)  === 1) {
                    $controller->afficherLivres();
                    break;
                } else {
                    switch ($url[1]) {
                        case "lire":
                            $controller->afficherLivre($url[2]);
                            break;
                        case "ajouter":
                            $controller->ajoutLivre();
                            break;
                        case "modifier":
                            $controller->modifierLivre($url[2]);
                            break;
                        case "modifValider":
                            $controller->modifLivreValidation();
                            break;
                        case "supprimer":
                            $controller->supprimerLivre($url[2]);
                            break;
                        case "valider":
                            $controller->ajoutLivreValidation();
                            break;
                        default:
                            throw new Exception("Aucune sous page trouvée");
                    }
                    break;
                }
            default:
                throw new Exception("Aucune page principale trouvée ". URL);
        }
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
