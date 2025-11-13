<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($book->title) ?></title>
  <style>
    img { max-width: 240px; display:block; margin-bottom: 12px; }
    a { display:inline-block; margin-bottom:12px; }
  </style>
</head>
<body>
  <a href="index.php">← Повернутись до списку</a>

  <?php if (!empty($book->cover_path)): ?>
  <img src="/<?= htmlspecialchars($book->cover_path, ENT_QUOTES) ?>" alt="cover">
<?php endif; ?>

  <h1><?= htmlspecialchars($book->title) ?></h1>
  <p><b>Автор:</b> <?= htmlspecialchars($book->author) ?></p>
  <p><b>Рік видання:</b> <?= $book->publish_year ?? '—' ?></p>
  <p><b>Кількість сторінок:</b> <?= $book->pages ?? '—' ?></p>
  <p><b>Опис:</b><br><?= nl2br(htmlspecialchars($book->description)) ?></p>
</body>
</html>