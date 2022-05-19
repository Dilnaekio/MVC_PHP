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
        $db = Model::getBdd();
        $sql = "SELECT * FROM books";
        $req = $db->prepare($sql);
        $req->execute([]);

        $data = $req->fetchAll(PDO::FETCH_OBJ);

        foreach ($data as $book) {
            $newBook = new Books($book->title_book, $book->nb_pages_book, $book->img_book);
            $this->addBook($newBook);
        }
    }
}
