<?php
class Book {
    public int $id;
    public string $title;
    public string $author;       // "Ім'я Прізвище"
    public ?string $description;
    public ?int $publish_year;
    public ?int $pages;
    public ?string $cover_path;

    public function __construct(array $row) {
        $this->id           = (int)$row['id'];
        $this->title        = $row['title'];
        $this->author       = $row['author'];
        $this->description  = $row['description'] ?? '';
        $this->publish_year = $row['publish_year'] !== null ? (int)$row['publish_year'] : null;
        $this->pages        = $row['pages'] !== null ? (int)$row['pages'] : null;
        $this->cover_path   = $row['cover_path'] ?? null;
    }
}
?>