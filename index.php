<?php
session_start();
require_once 'include/publisher.php';
require_once 'include/select-author.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа №1</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
</head>
<body>
<div class="Top-text">
    <p><u>Вариант 0</u>. Создать и заполнить произвольными данными БД для хранения информации об информационных ресурсах библиотеки.<br> </p>
    <p>Сформировать запросы, которые будут выводить на экран информацию о:<br></p>

</div>
<div class="dropdown">
    <div class="dropdown-content">
        <div class="Ul">
            <ol class="ol">
                <li>книгах указанного издательства;</li>
                <li>книгах, журналах и газетах, опубликованных за указанный временной период (учитывать год издания);</li>
                <li>книгах указанного автора;</li>
            </ol>
        </div>
    </div>
</div>
<div class="box">

    <form class = "select"  action="include/book_publisher.php" method="post">
        <label for="pulisher"><b>Выберите издательство:</b> </label>
        <select name="publisher" class="select-publisher">
            <option hidden disabled selected>Виды:</option>
            <?php
            for($i=0;$i<count($_SESSION['publisher']);$i++):?>
                <option value="<?=$_SESSION['publisher'][$i]?>"><?=$_SESSION['publisher'][$i]?></option>
            <?php endfor; ?>

        </select><br>
        <div class="div-btn">
            <button type="submit" class="select-btn" >Выбрать</button>
        </div>
    </form>

    <form class="select" action="include/year.php" method="post" >
        <label for="year"><b>Выберите период издания:</b><br></label>
        <div class="div-year">
            <select class="select-year" name="year[]" multiple>
                <?php for($i = 2000; $i <= date('Y'); $i++): ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php endfor; ?>
            </select><br>
        </div>
        <div class="year-btn">
            <button type="submit" class="select-btn" >Выбрать</button>
        </div>
    </form>

    <form class="select" action="include/book-authors.php" method="post">
        <label for="year"><b>Выберите необходимого автора:</b><br></label>
        <div class="div-year">
            <select name="authors" class="select-author">
                <option hidden disabled selected>Автор:</option>
                <?php
                for($i=0;$i<count($_SESSION['authors']);$i++):?>
                    <option value="<?=$_SESSION['authors'][$i]?>"><?=$_SESSION['authors'][$i]?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="div-btn">
            <button type="submit" class="select-btn" >Выбрать</button>
        </div>
    </form>

</div>

<?php
if (isset($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}
unset($_SESSION['message']);
?>
<div class="margin"></div>
<?php
if(isset($_SESSION['book'])) {
    echo "<table class='book-table'>";

    echo "<tr><th>Название</th><th>Номер</th><th>Издатель</th><th>Год издания</th><th>Страницы</th><th>Автор</th></tr>";
    for ($i = 0; $i < count($_SESSION['book']['title']); $i++) {
        echo "<tr>
                    <td>" . $_SESSION['book']['title'][$i] . "</td>
                    <td>" . $_SESSION['book']['isbn'][$i] . "</td>
                    <td>" . $_SESSION['book']['publishe'][$i] . "</td>
                    <td>" . $_SESSION['book']['year'][$i] . "</td>
                    <td>" . $_SESSION['book']['quantity'][$i] . "</td>
                    <td>" . $_SESSION['book']['name'][$i] . "</td>
                   </tr>";
    }
    echo "</table>";
}
unset($_SESSION['book']);
?>
<?php
if(isset($_SESSION['record'])) {
    echo "<table class='book-table'>";

    echo "<tr><th>Название</th><th>Дата</th><th>Год издания</th><th>Издатель</th><th>Страницы</th><th>Номер ISBN</th><th>Номер</th><th>Ресурс</th><th>Автор</th></tr>";
    for ($i = 0; $i < count($_SESSION['record']['litname']); $i++) {
        echo "<tr>
                    <td>" . $_SESSION['record']['litname'][$i] . "</td>
                    <td>" . $_SESSION['record']['litdate'][$i] . "</td>
                    <td>" . $_SESSION['record']['lityear'][$i] . "</td>
                    <td>" . $_SESSION['record']['litpublish'][$i] . "</td>
                    <td>" . $_SESSION['record']['litquantity'][$i] . "</td>
                    <td>" . $_SESSION['record']['litisbn'][$i] . "</td>
                    <td>" . $_SESSION['record']['litnumber'][$i] . "</td>
                    <td>" . $_SESSION['record']['litliterate'][$i] . "</td>
                    <td>" . $_SESSION['record']['author_name'][$i] . "</td>
                   </tr>";
    }
    echo "</table>";
}
unset($_SESSION['record']);
?>
<?php
if(isset($_SESSION['book_authors'])) {
    echo "<table class='book-table'>";
    echo "<tr><th>Название</th><th>Номер</th><th>Издатель</th><th>Год издания</th><th>Страницы</th><th>Автор</th></tr>";
    for ($i = 0; $i < count($_SESSION['book_authors']['book']); $i++) {
        echo "<tr>
                    <td>" . $_SESSION['book_authors']['book'][$i] . "</td>
                    <td>" . $_SESSION['book_authors']['ISMN'][$i] . "</td>
                    <td>" . $_SESSION['book_authors']['publish'][$i] . "</td>
                    <td>" . $_SESSION['book_authors']['book_year'][$i] . "</td>
                    <td>" . $_SESSION['book_authors']['book_quantity'][$i] . "</td>
                    <td>" . $_SESSION['book_authors']['author_name'][$i] . "</td>
                   </tr>";
    }
    echo "</table>";
}
unset($_SESSION['book_authors']);
?>
</body>
</html>


