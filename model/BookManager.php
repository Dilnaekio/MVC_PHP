<?php
require "ModelClass.php";
require "BookClass.php";

// Classe qui va gérer toutes les données liées aux livres
class BookManager extends Model
{
    private $booksList;

    // Méthode pour ajouter un livre dans l'array dédié

    public function addBook($book)
    {
        $this->booksList[] = $book;
    }

    // Méthode pour récupérer la liste de livres
    public function getBooksList()
    {
        return $this->booksList;
    }

    // Méthode pour charger les livres en base de données et les enregistrer dans l'array dédié
    public function loadBooks()
    {
        $sql = "SELECT * FROM books";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([]);

        $data = $req->fetchAll(PDO::FETCH_OBJ);

        foreach ($data as $book) {
            $newBook = new Books($book->id_book, $book->title_book, $book->nb_pages_book, $book->img_book);
            $this->addBook($newBook);
        }
    }

    // Récupérer un livre dans l'array dédié en fonction de son ID
    public function getBookById($id)
    {
        foreach ($this->booksList as $book) {
            if ($book->getId() == $id) {
                return $book;
            } else {
                throw new Exception ("Le livre demandé n'existe pas !");
            }
        }
    }

    // Méthode pour ajouter un livre en base de données
    public function addBookDB($title, $nbPages, $img)
    {
        $sql = "INSERT INTO books (title_book, nb_pages_book, img_book) VALUES (:title, :pages, :img)";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":title" => $title,
            ":pages" => $nbPages,
            ":img" => $img
        ]);
    }

    // Méthode pour supprimer un livre en base de données en fonction de l'ID donnée
    public function deleteBookDB($id)
    {
        $sql = "DELETE from books where id_book = :id";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":id" => $id
        ]);
    }

    // Méthode pour modifier les informations d'un livre en base de données en fonction de l'ID donnée
    public function modifyBookDB($id, $title, $nbPages, $img)
    {
        $sql = "UPDATE books SET title_book = :title, nb_pages_book = :pages, img_book = :img WHERE id_book = :id";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":title" => $title,
            ":pages" => $nbPages,
            ":img" => $img,
            ":id" => $id
        ]);
    }
}
