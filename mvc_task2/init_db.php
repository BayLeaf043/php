<?php
// init_db.php — запускається один раз
$path = __DIR__ . '/data';
if (!is_dir($path)) mkdir($path, 0777, true);

$dsn = 'sqlite:' . $path . '/library.db';
$pdo = new PDO($dsn);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Вмикаємо зовнішні ключі
$pdo->exec('PRAGMA foreign_keys = ON');

// --- Схема ---
$pdo->exec("
CREATE TABLE IF NOT EXISTS authors (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name TEXT NOT NULL,
    last_name  TEXT NOT NULL,
    country    TEXT
);
CREATE TABLE IF NOT EXISTS books (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    author_id  INTEGER NOT NULL,
    title      TEXT NOT NULL,
    description TEXT,
    publish_year INTEGER,
    pages        INTEGER,
    cover_path   TEXT,                 -- шлях до файлу обкладинки (public/...)
    FOREIGN KEY(author_id) REFERENCES authors(id)
      ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE INDEX IF NOT EXISTS idx_books_title ON books(title);
CREATE INDEX IF NOT EXISTS idx_authors_last_name ON authors(last_name);
");

$pdo->beginTransaction();
$pdo->exec("DELETE FROM books; DELETE FROM authors;");

$authors = [
    ['Ернест', 'Хемінгуей', 'Америка'],
    ['Чарльз', 'Дікенс', 'Англія'],
    ['Джордж', 'Орвелл', 'Англія'],
    ['Марк', 'Твен', 'Америка'],
    ['Агата', 'Крісті', 'Англія'],
    ['Стівен', 'Кінг', 'Америка'],
];
$insA = $pdo->prepare("INSERT INTO authors(first_name,last_name,country) VALUES (?,?,?)");
foreach ($authors as $a) { $insA->execute($a); }

$authorId = fn($last) => $pdo->query("SELECT id FROM authors WHERE last_name = ".$pdo->quote($last))->fetchColumn();

$books = [
    [$authorId('Хемінгуей'),   'Старий і море', 'В основі роману розповідь про кубинського рибалку Сантьяго, його боротьбу з гігантською рибиною, що стала найбільшою здобиччю в його житті.', 1952, 104, 'public/book1.jpg'],
    [$authorId('Хемінгуей'),   'І сонце сходить', 'Роман, заснований на реальних подіях, які відбувалися в житті автора.', 1925, 288, 'public/book2.jpg'],
    [$authorId('Дікенс'),   'Пригоди Ніколаса Ніклбі', 'Розповідь ведеться про життя чесного і порядного молодого чоловіка Ніколаса Ніклбі, який повинен підтримувати матір і сестру після смерті батька.', 1839, 928, 'public/book3.jpg'],
    [$authorId('Дікенс'),   'Крамниця старожитностей', 'Твір розповідає про життя Нелл Трент і її дідуся —лондонського антиквара.', 1841, 608, 'public/book4.jpg'],
    [$authorId('Орвелл'),   '1984', 'Тематично роман зосереджений на наслідках тоталітаризму, масового стеження та репресивного регулювання людей і поведінки в суспільстві.', 1948, 416, 'public/book5.jpg'],
    [$authorId('Твен'),   'Пригоди Тома Соєра', 'Твір розповідає про пригоди хлопчака на імя Том Соєр із містечка Сент-Пітерсберґ на півдні Сполучених Штатів. Події роману відбуваються напередодні Громадянської війни в Сполучених Штатах.', 1876, 275, 'public/book6.jpg'],
    [$authorId('Крісті'),   'Таємнича пригода в Стайлзі', 'Детективний роман', 1916, 288, 'public/book7.jpg'],
    [$authorId('Кінг'),   'Сяйво', 'Роман американського письменника Стівена Кінга, написаний у жанрах психологічного жаху та готичної літератури', 1977, 447, 'public/book8.jpg'],
  
];
$insB = $pdo->prepare("INSERT INTO books(author_id,title,description,publish_year,pages,cover_path)
                       VALUES (?,?,?,?,?,?)");
foreach ($books as $b) { $insB->execute($b); }

$pdo->commit();

echo "✅ SQLite база створена: data/library.db\n";
echo "Авторів: " . $pdo->query("SELECT COUNT(*) FROM authors")->fetchColumn() . "\n";
echo "Книг: "   . $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn()   . "\n";

?>


