<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]));
try {

    require "controller/BookController.php";
    $controller = new BookController;

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
                    $controller->displayBooks();
                    break;
                } else {
                    switch ($url[1]) {
                        case "lire":
                            $controller->displayBook($url[2]);
                            break;
                        case "ajouter":
                            $controller->addBook();
                            break;
                        case "modifier":
                            $controller->modifyBook($url[2]);
                            break;
                        case "modifValider":
                            $controller->modifyBookValidation();
                            break;
                        case "supprimer":
                            $controller->deleteBook($url[2]);
                            break;
                        case "valider":
                            $controller->addBookValidation();
                            break;
                        default:
                            throw new Exception("Aucune sous page trouvée");
                    }
                    break;
                }
            default:
                throw new Exception("Aucune page principale trouvée " . URL);
        }
    }
} catch (Exception $e) {
    require "view/errorsView.php";
}
