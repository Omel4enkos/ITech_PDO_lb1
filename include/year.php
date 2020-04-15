<?php
session_start();
require_once 'connect.php';
if(isset( $_POST['year'] ) ) {
    $count = count($_POST['year']);
    $first_year = $_POST['year'][0];
    $last_year = $_POST['year'][$count-1];
    $first_date = $first_year;
    $first_date .="-01-01";
    $last_date = $last_year;
    $last_date .="-01-01";
    if($first_year===$last_year){
        $_SESSION['message'] = 'Вы не выбрали конечный год издания';
        header('Location: ../index.php');
    }
    else{
        $select = $dbh->prepare('SELECT literature.name as "litname", literature.date, literature.year,literature.publisher, literature.quantity,
    literature.isbn, literature.number, literature.literate, authors.name FROM literature LEFT JOIN resource
    ON resource.id_resource = literature.fid_resource LEFT JOIN book_authors on book_authors.fid_book = literature.id_book
    LEFT JOIN authors on authors.id_author = book_authors.fid_authors where literature.year BETWEEN :first_year and :last_year
    or DATE(literature.date) BETWEEN :first_date AND :last_date');
        $select->execute(array(':first_year' => $first_year, ':last_year' => $last_year, ':first_date' =>$first_date, ':last_date'=>$last_date));
        $table = $select->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($table)){
            $litname = array();
            $litdate = array();
            $lityear = array();
            $litpublish = array();
            $litquantity = array();
            $litisbn = array();
            $litnumber = array();
            $litliterate = array();
            $author_name = array();
            foreach ($table as $item) {
                $litname[]= $item['litname'];
                $litdate[]= $item['date'];
                $lityear[]= $item['year'];
                $litpublish[]= $item['publisher'];
                $litquantity[]= $item['quantity'];
                $litisbn[]= $item['isbn'];
                $litnumber[]= $item['number'];
                $litliterate[]= $item['literate'];
                $author_name[]= $item['name'];
            }
            $_SESSION['record']=[
                "litname"=>$litname,
                "litdate"=>$litdate,
                "lityear" =>$lityear,
                "litpublish" => $litpublish,
                "litquantity" => $litquantity,
                "litisbn" => $litisbn,
                "litnumber" => $litnumber,
                "litliterate" => $litliterate,
                "author_name" => $author_name,
            ];
            header('Location: ../index.php');
        }
        else{
            $_SESSION['message'] = 'Нет данных с такими годами';
            header('Location: ../index.php');
        }
    }
}
else{
    $_SESSION['message'] = 'Вы не выбрали года издания';
    header('Location: ../index.php');
}
