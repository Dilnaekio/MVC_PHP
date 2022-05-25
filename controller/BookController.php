<?php
require "model/BookManager.php";
require "GlobalController.php";

// Classe controller qui va appeler les méthodes du manager de livres en fonction des actions de l'utilisateur via le routeur index.php
class BookController
{
    private $bookManager;

    // Instancie la classe BookManager pour charger les livres stockés en base de données puis les enregistrer dans un array
    public function __construct()
    {
        $this->bookManager = new BookManager;
        $this->bookManager->loadBooks();
    }

    // Méthode pour afficher tous les livres stockés + charger la vue dédiée
    public function displayBooks()
    {
        $books = $this->bookManager->getBooksList();
        require "view/booksView.php";
    }

    // Méthode pour afficher un livre en fonction de l'ID donnée + charger la vue dédiée
    public function displayBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "view/oneBookView.php";
    }

    // Méthode pour charger la page où nous pourrons ajouter un livre en base de données
    public function addBook()
    {
        require "view/addBook.php";
    }

    // Méthode pour ajouter (valider) en base de données le livre, son image + afficher un message de succès + redirection vers la page des livres
    public function addBookValidation()
    {
        $img = $_FILES['addBookImg'];
        $folder = "public/images/";
        $newImg = GlobalController::addImg($_POST["addBookName"], $img, $folder);
        $this->bookManager->addBookDB($_POST["addBookName"], $_POST["addBookPages"], $newImg);
        GlobalController::manageErrors("success", "Votre livre a bien été ajouté");
        header("location: " . URL . "livres");
    }

    // Méthode qui va permettre la suppression d'un livre en base de données en fonction de l'ID donnée + supprimer localement son image + afficher un message de réussite et redirection sur la page des livres
    public function deleteBook($id)
    {
        $img = $this->bookManager->getBookById($id)->getImg();
        unlink("public/images/" . $img);
        $this->bookManager->deleteBookDB($id);

        GlobalController::manageErrors("success", "Votre livre a bien été supprimé");
        header("location: " . URL . "livres");
    }

    // Méthode pour charger la vue de modification pour permettre la modification des données d'un livre donné par l'ID passée
    public function modifyBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "view/modifyBookView.php";
    }

    // Méthode pour valider les modifications, les enregistrer en base de données et changer/supprimer l'image aux besoins + redirection vers la page des livres
    public function modifyBookValidation()
    {
        $folder = "public/images/";
        $currentImg = $_POST["currentImg"];
        $newImg = $_FILES["modBookImg"];

        if ($newImg["size"] > 0) {
            unlink($currentImg);
            $imgToAdd = GlobalController::addImg($_POST["modBookName"], $newImg, $folder);

            $this->bookManager->modifyBookDB($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        } else {
            $imgToAdd = $currentImg;
            $this->bookManager->modifyBookDB($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        }

        GlobalController::manageErrors("success", "Les modifications ont bien été enregistrées");
        header("location: " . URL . "livres");
    }
}
