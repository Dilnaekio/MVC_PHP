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
        unlink("public/images/" . $img);
        $this->livreManager->supprimerLivreBD($id);
        header("location: " . URL . "livres");
    }

    public function ajoutLivreValidation()
    {
        $img = $_FILES['addBookImg'];
        $folder = "public/images/";
        $newImg = GlobalController::ajoutImage($_POST["addBookName"], $img, $folder);
        $this->livreManager->ajoutLivreBD($_POST["addBookName"], $_POST["addBookPages"], $newImg);
        header("location: " . URL . "livres");
    }

    public function modifierLivre($id)
    {
        $book = $this->livreManager->getBookById($id);
        require "view/modifLivreView.php";
    }

    public function modifLivreValidation()
    {
        $folder = "public/images/";
        $currentImg = $_POST["currentImg"];
        var_dump($currentImg);

        $newImg = $_FILES["modBookImg"];
        var_dump($newImg);

        if ($newImg["size"] > 0) {
            unlink($currentImg);
            $imgToAdd = GlobalController::ajoutImage($_POST["modBookName"], $newImg, $folder);

            $this->livreManager->modifierLivreBD($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        } else {
            $imgToAdd = $currentImg;
            $this->livreManager->modifierLivreBD($_POST["idBook"], $_POST["modBookName"], $_POST["modBookPages"], $imgToAdd);
        }

        header("location: " . URL . "livres");
    }
}
