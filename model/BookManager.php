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
        $db = $this->getBdd();
        $sql = "SELECT * FROM books";
        $req = $db->prepare($sql);
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
}
