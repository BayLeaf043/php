<?php if (empty($books)): ?>
  <tr><td colspan="6">Нічого не знайдено.</td></tr>
<?php else: foreach ($books as $b): ?>
  <tr>
    <td>
      <?php if (!empty($b->cover_path)): ?>
        <img src="/<?= htmlspecialchars($b->cover_path, ENT_QUOTES) ?>" alt="cover" style="max-height:60px">
      <?php endif; ?>
    </td>
    <td>
      <a href="index.php?id=<?= (int)$b->id ?>">
        <?= htmlspecialchars($b->title) ?>
      </a>
    </td>
    <td><?= htmlspecialchars($b->author) ?></td>
    <td><?= $b->publish_year ?? '—' ?></td>
    <td><?= $b->pages ?? '—' ?></td>
    <td><?= htmlspecialchars($b->description) ?></td>
  </tr>
<?php endforeach; endif; ?>