<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Book.php';

class Model {
    private PDO $pdo;
    public function __construct() { $this->pdo = DB::pdo(); }

    // список книг 
    public function getBookList(?string $q = null): array {
        $sql = "
            SELECT b.id, b.title, b.description, b.publish_year, b.pages, b.cover_path,
                   (a.first_name || ' ' || a.last_name) AS author
            FROM books b
            JOIN authors a ON a.id = b.author_id
        ";
        $params = [];
        if ($q !== null && $q !== '') {
            $sql .= " WHERE LOWER(b.title) LIKE :q
                      OR LOWER(a.first_name || ' ' || a.last_name) LIKE :q ";
            $params[':q'] = '%' . mb_strtolower($q) . '%';
        }
        $sql .= " ORDER BY b.title ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $list = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new Book($row);
        }
        return $list;
    }

    // одна книга за id
    public function getBookById(int $id): ?Book {
        $sql = "
            SELECT b.id, b.title, b.description, b.publish_year, b.pages, b.cover_path,
                   (a.first_name || ' ' || a.last_name) AS author
            FROM books b
            JOIN authors a ON a.id = b.author_id
            WHERE b.id = :id
            LIMIT 1
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Book($row) : null;
    }

    public function getBookListByFilters(?string $title = null, ?string $author = null): array {
    $sql = "
        SELECT b.id, b.title, b.description, b.publish_year, b.pages, b.cover_path,
               (a.first_name || ' ' || a.last_name) AS author
        FROM books b
        JOIN authors a ON a.id = b.author_id
        WHERE 1=1
    ";
    $params = [];

    if ($title !== null && $title !== '') {
        // починається з...
        $sql .= " AND b.title LIKE :title ";
        $params[':title'] = $title . '%';
    }
    if ($author !== null && $author !== '') {
        // починається з ім'я+прізвище або прізвище
        $sql .= " AND ((a.first_name || ' ' || a.last_name) LIKE :author
                    OR a.last_name LIKE :author)";
        $params[':author'] = $author . '%';
    }

    $sql .= " ORDER BY b.title ASC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);

    $list = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $list[] = new Book($row);
    }
    return $list;
    }
}
?>