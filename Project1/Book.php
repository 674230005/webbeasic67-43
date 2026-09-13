<?php
class Book
{
    private $id;
    private $title;
    private $author;
    private $price;
    private $category;
    private $color;

    public function __construct($id, $title, $author, $price, $category, $color)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->category = $category;
        $this->color = $color;
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getAuthor() { return $this->author; }
    public function getPrice() { return $this->price; }
    public function getCategory() { return $this->category; }
    public function getColor() { return $this->color; }
}
?>