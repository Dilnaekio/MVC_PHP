<?php
require "ModelClass.php";
require "LivreClass.php";

class BookManager extends Model
{
    private $booksList;

    public function addBook($book)
    {
        $this->booksList[] = $book;
    }

    /**
     * Get the value of booksList
     */
    public function getBooksList()
    {
        return $this->booksList;
    }

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

    public function getBookById($id)
    {
        foreach ($this->booksList as $book) {
            if ($book->getId() == $id) {
                return $book;
            }
        }
    }

    public function ajoutLivreBD($title, $nbPages, $img)
    {
        $sql = "INSERT INTO books (title_book, nb_pages_book, img_book) VALUES (:title, :pages, :img)";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":title" => $title,
            ":pages" => $nbPages,
            ":img" => $img
        ]);
    }

    public function supprimerLivreBD($id)
    {
        $sql = "DELETE from books where id_book = :id";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":id" => $id
        ]);
    }

    public function modifierLivreBD($id, $titre, $nbPages, $image)
    {
        $sql = "UPDATE books SET title_book = :titre, nb_pages_book = :pages, img_book = :img WHERE id_book = :id";
        $req = $this->getBdd()->prepare($sql);
        $req->execute([
            ":titre" => $titre,
            ":pages" => $nbPages,
            ":img" => $image,
            ":id" => $id
        ]);
    }
}
