<?php
session_start();
require_once 'connect.php';
if(isset( $_POST['authors'] ) )
{
    $author = $_POST['authors'];
    $select = $dbh->prepare('SELECT literature.name as "book", literature.isbn, literature.publisher,
    literature.year, literature.quantity, authors.name FROM literature INNER JOIN book_authors ON book_authors.fid_book = literature.id_book
    INNER JOIN authors on authors.id_author = book_authors.fid_authors WHERE authors.name = :name');
    $select->execute(array(':name' => $author));
    $table = $select->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($table)) {
        $book = array();
        $ISBN = array();
        $publish = array();
        $book_year = array();
        $book_quantity = array();
        $author_name = array();
        foreach ($table as $item) {
            $book[] = $item['book'];
            $ISBN[] = $item['isbn'];
            $publish[] = $item['publisher'];
            $book_year[] = $item['year'];
            $book_quantity[] = $item['quantity'];
            $author_name[] = $item['name'];
        }
        $_SESSION['book_authors'] = [
            "book" => $book,
            "ISMN" => $ISBN,
            "publish" => $publish,
            "book_year" => $book_year,
            "book_quantity" => $book_quantity,
            "author_name" => $author_name
        ];
        header('Location: ../index.php');
    }
    else{
            $_SESSION['message'] = 'Такой автор не написал книгу';
            header('Location: ../index.php');
        }
}
else{
    $_SESSION['message'] = 'Вы не выбрали автора';
    header('Location: ../index.php');
}