<?php
require_once __DIR__ . '/../model/Model.php';

class Controller {
    private Model $model;
    public function __construct() { $this->model = new Model(); }

    public function invoke() {
    // детальна сторінка
    if (isset($_GET['id'])) {
        $id   = (int)$_GET['id'];
        $book = $this->model->getBookById($id);
        if ($book) { include __DIR__ . '/../view/viewbook.php'; }
        else { http_response_code(404); echo "Книгу не знайдено"; }
        return;
    }

    // параметри фільтра
    $title  = isset($_GET['title'])  ? trim($_GET['title'])  : '';
    $author = isset($_GET['author']) ? trim($_GET['author']) : '';

    $books = $this->model->getBookListByFilters($title, $author);

    // AJAX: повертаємо тільки рядки таблиці
    if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
        include __DIR__ . '/../view/partials/books_tbody.php';
        return;
    }

    // повна сторінка
    include __DIR__ . '/../view/booklist.php';
}
}
?>