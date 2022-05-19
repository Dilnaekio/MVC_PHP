<?php
require "model/BookManager.php";
require "GlobalController.php";

class LivreController
{
    private $livreManager;

    public function __construct()
    {
        $this->livreManager = new BookManager;
        $this->livreManager->loadBooks();
    }

    public function afficherLivres()
    {
        $books = $this->livreManager->getBooksList();
        require "view/livresView.php";
    }

    public function afficherLivre($id)
    {
        $book = $this->livreManager->getBookById($id);
        require "view/oneBookView.php";
    }

    public function ajoutLivre()
    {
        require "view/ajoutLivre.php";
    }

    public function supprimerLivre($id)
    {
        $img = $this->livreManager->getBookById($id)->getImg();
        unlink("public/images/".$img);
        $this->livreManager->supprimerLivreBD($id);
        header("location: ".URL."livres");
    }

    public function ajoutLivreValidation()
    {
        $img = $_FILES['addBookImg'];
        $folder = "public/images/";
        $newImg = GlobalController::ajoutImage($_POST["addBookName"], $img, $folder);
        $this->livreManager->ajoutLivreBD($_POST["addBookName"], $_POST["addBookPages"], $newImg);
        header("location: ".URL."livres");
    }
}
