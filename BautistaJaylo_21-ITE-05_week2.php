<?php

class Book {
    public $title;
    protected $author;
    private $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}";
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function __call($name, $arguments) {
        echo nl2br("Stock updated for '{$this->title}' with arguments: " . implode(", ", $arguments) . "\n");
    }
}

class Library {
    private $books = [];
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function addBook(Book $book) {
        $this->books[$book->title] = $book;
    }

    public function removeBook($title) {
        unset($this->books[$title]);
        echo nl2br("Book '$title' removed from the library.\n");
    }

    public function listBooks() {
        foreach ($this->books as $book) {
            echo nl2br($book->getDetails() . "\n");
        }
    }

    public function __destruct() {
        echo nl2br("The library '{$this->name}' is now closed.\n");
    }
}

$library = new Library("City Library");
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 10.99);
$book2 = new Book("1984", "George Orwell", 8.99);

$library->addBook($book1);
$library->addBook($book2);

$book1->setPrice(12.99);
$book1->updateStock(50);

echo nl2br("Books in the library:\n");
$library->listBooks();

$library->removeBook("1984");

echo nl2br("Books in the library after removal:\n");
$library->listBooks();

unset($library);
