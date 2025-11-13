<!doctype html>
<html lang="uk">
<head>
  <meta charset="utf-8">
  <title>Бібліотека</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    td, th { border: 1px solid #ddd; padding: 8px; }
    img { max-height: 60px; }
    .filters { display:flex; gap:8px; margin-bottom:12px; }
    .filters input { padding:6px 8px; }
  </style>
</head>
<body>
  <h1>Список книг</h1>

  <div class="filters">
    <input type="text" id="title"  placeholder="Почніть вводити назву"  value="<?= htmlspecialchars($title ?? '', ENT_QUOTES) ?>">
    <input type="text" id="author" placeholder="Почніть вводити автора" value="<?= htmlspecialchars($author ?? '', ENT_QUOTES) ?>">
    <button type="button" id="clearBtn">Скинути</button>
  </div>

  <table>
    <thead>
    <tr>
      <th>Обкладинка</th><th>Назва</th><th>Автор</th><th>Рік</th><th>Стор.</th><th>Опис</th>
    </tr>
    </thead>
    <tbody id="booksBody">
      <?php include __DIR__ . '/partials/books_tbody.php'; ?>
    </tbody>
  </table>

<script>
(function(){
  const title  = document.getElementById('title');
  const author = document.getElementById('author');
  const body   = document.getElementById('booksBody');
  const clear  = document.getElementById('clearBtn');

  let t;
  function debounce(fn, ms=250){
    clearTimeout(t); t = setTimeout(fn, ms);
  }

  async function update(){
    const params = new URLSearchParams({
      ajax: '1',
      title: title.value.trim(),
      author: author.value.trim()
    });
    const resp = await fetch('index.php?' + params.toString(), { headers: { 'X-Requested-With': 'fetch' } });
    const html = await resp.text();
    body.innerHTML = html;
  }

  title.addEventListener('input',  () => debounce(update));
  author.addEventListener('input', () => debounce(update));

  clear.addEventListener('click', () => {
    title.value = ''; author.value = ''; update();
  });
})();
</script>
</body>
</html>