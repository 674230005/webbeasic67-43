<?php
require_once "Book.php";
require_once "Database.php";

class BookStore
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getBooks()
    {
        $stmt = $this->conn->prepare("SELECT * FROM books ORDER BY id DESC");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['title'],
                $row['author'],
                $row['price'],
                $row['category'],
                $row['color']
            );
        }
        return $books;
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new Book(
            $row['id'],
            $row['title'],
            $row['author'],
            $row['price'],
            $row['category'],
            $row['color']
        );
    }
}
?>