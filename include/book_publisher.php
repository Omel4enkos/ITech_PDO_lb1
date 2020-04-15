<?php
session_start();
require_once 'connect.php';
if(isset( $_POST['publisher'] ) )
{
    $publisher = $_REQUEST['publisher'];
    $select_book = $dbh->prepare('SELECT literature.name as "Title", literature.isbn, literature.publisher, literature.year,
    literature.quantity, authors.name FROM literature INNER JOIN book_authors on book_authors.fid_book = literature.id_book
    INNER JOIN authors on authors.id_author = book_authors.fid_authors WHERE literature.publisher = :publisher');
    $select_book->execute(array(':publisher' => $publisher));
    $table = $select_book->fetchAll(PDO::FETCH_ASSOC);

    $title = array();
    $isbn = array();
    $publish = array();
    $year = array();
    $quantity = array();
    $name = array();
    foreach ($table as $item) {
        $title[]= $item['Title'];
        $isbn[]= $item['isbn'];
        $publishe[]= $item['publisher'];
        $year[]= $item['year'];
        $quantity[]= $item['quantity'];
        $name[]= $item['name'];
    }
    $_SESSION['book']=[
        "title"=>$title,
        "isbn"=>$isbn,
        "publishe" =>$publishe,
        "year" => $year,
        "quantity" => $quantity,
        "name" => $name
    ];
    header('Location: ../index.php');

}
else{
    $_SESSION['message'] = 'Вы не выбрали издательство';
    header('Location: ../index.php');
}