<div class="header">
    <h2>Редактировать товар</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=product&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<form method="POST" class="form">
    <div class="form-group">
        <label for="Name">Название:</label>
        <input type="text" name="Name" id="Name" value="<?= htmlspecialchars($product['Name']) ?>" required>
    </div>
    <div class="form-group">
        <label for="Category">Категория:</label>
        <input type="text" name="Category" id="Category" value="<?= htmlspecialchars($product['Category']) ?>" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn">Сохранить</button>
        <a href="index.php?entity=product&action=index" class="btn">Отмена</a>
    </div>
</form>