<?php
session_start();
// L'URL de base de notre site
define("URL", str_replace("index.php", "", (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]));
try {
    // Instanciation de notre classe controller pour gérer les actions de l'utilisateur
    require "controller/BookController.php";
    require "controller/UserController.php";
    $bookController = new BookController;
    $userController = new UserController;

    // Vérification de base de l'action de l'utilisateur. S'il n'a demandé aucune "page", chargement de l'accueil
    if (empty($_GET['page'])) {
        require "view/homepageView.php";
    } else {
        // Si une page a été demandé, nous explosons l'URL pour en faire un tableau et trouver les actions choisies
        $url = explode("/", filter_var($_GET["page"]), FILTER_SANITIZE_URL);

        // Nous contrôlons si l'utilisateur veut l'accueil ou livres pour charger les vues désirées
        switch ($url[0]) {
            case "accueil":
                require "view/homepageView.php";
                break;

            case "connexion":
                if (count($url) === 1) {
                    $userController->displayFormConnection();
                } else {
                    switch ($url[1]) {
                        case "validation":
                            $userController->checkUserInfos();
                            break;
                    }
                }
                break;

                case "deconnexion":
                    $userController->disconnection();
                    break;

                // Si l'utilisateur veut juste afficher tous les livres, nous appelons le bookController dédié
            case "livres":
                if (count($url)  === 1) {
                    $bookController->displayBooks();
                    break;
                } else {
                    // Si l'URL est plus longue, cela signifie que l'utilisateur veut faire une action dans la partie "livres", nous appelons le bookController dédié en fonction de son choix
                    switch ($url[1]) {
                        case "lire":
                            $bookController->displayBook($url[2]);
                            break;
                        case "ajouter":
                            $bookController->addBook();
                            break;
                        case "modifier":
                            $bookController->modifyBook($url[2]);
                            break;
                        case "modifValider":
                            $bookController->modifyBookValidation();
                            break;
                        case "supprimer":
                            $bookController->deleteBook($url[2]);
                            break;
                        case "valider":
                            $bookController->addBookValidation();
                            break;
                            // Si l'utilisateur veut une action non programmée, nous lui renvoyons une nouvelle Exception
                        default:
                            throw new Exception("Aucune sous page trouvée");
                    }
                    break;
                }
                // Si l'utilisateur veut une action non programmée, nous lui renvoyons une nouvelle Exception
            default:
                throw new Exception("Aucune page principale trouvée " . URL);
        }
    }
} catch (Exception $e) {
    // Si une Exception a été trouvée dans le code, la page dédiée aux erreurs sera chargée et affichera l'Exception trouvée
    require "view/errorsView.php";
}
