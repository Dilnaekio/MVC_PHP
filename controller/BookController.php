<?php
require "model/BookManager.php";
require "GlobalController.php";

class BookController
{
    private $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager;
        $this->bookManager->loadBooks();
    }

    public function displayBooks()
    {
        $books = $this->bookManager->getBooksList();
        require "view/livresView.php";
    }

    public function displayBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "view/oneBookView.php";
    }

    public function addBook()
    {
        require "view/ajoutLivre.php";
    }

    public function deleteBook($id)
    {
        $img = $this->bookManager->getBookById($id)->getImg();
        unlink("public/images/" . $img);
        $this->bookManager->supprimerLivreBD($id);

        GlobalController::manageErrors("success", "Votre livre a bien été supprimé");
        header("location: " . URL . "livres");
    }

    public function addBookValidation()
    {
        $img = $_FILES['addBookImg'];
        $folder = "public/images/";
        $newImg = GlobalController::ajoutImage($_POST["addBookName"], $img, $folder);
        $this->bookManager->ajoutLivreBD($_POST["addBookName"], $_POST["addBookPages"], $newImg);
        GlobalController::manageErrors("success", "Votre livre a bien été ajouté");
        header("location: " . URL . "livres");
    }

    public function modifyBook($id)
    {
        $book = $this->bookManager->getBookById($id);
        require "view/modifLivreView.php";
    }

    public function modifyBookValidation()
    {
        $folder = "public/images/";
        $currentImg = $_POST["currentImg"];
        $newImg = $_FILES["modBookImg"];

        if ($newImg["size"] > 0) {
            unlink($currentImg);
            $imgToAdd = GlobalController::ajoutImage($_POST["modBookName"], $newImg, $folder);

            $this->bookManager->modifierLivreBD($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        } else {
            $imgToAdd = $currentImg;
            $this->bookManager->modifierLivreBD($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        }

        GlobalController::manageErrors("success", "Les modifications ont bien été enregistrées");
        header("location: " . URL . "livres");
    }
}
