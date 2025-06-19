<div class="header">
    <h2>Просмотр товара</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=product&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<div class="details">
    <p><strong>ID:</strong> <?= htmlspecialchars($product['ProductID']) ?></p>
    <p><strong>Название:</strong> <?= htmlspecialchars($product['Name']) ?></p>
    <p><strong>Категория:</strong> <?= htmlspecialchars($product['Category']) ?></p>
</div>

<div class="actions">
    <a href="index.php?entity=product&action=edit&id=<?= $product['ProductID'] ?>" class="btn">Редактировать</a>
    <a href="index.php?entity=product&action=delete&id=<?= $product['ProductID'] ?>" class="btn danger"
        onclick="return confirm('Удалить товар?')">Удалить</a>
</div>