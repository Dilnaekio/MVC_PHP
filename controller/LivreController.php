<?php
require "model/BookManager.php";

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
}
