<?php

class LivreController
{
    private $livreManager;

    public function __construct()
    {
        $this->livreManager = new BookManager;
        $this->livreManager->loadBooks();
    }

    public function afficherLivres(){
        $books = $this->livreManager->getBooksList();
        require "view/livresView.php";
    }
}