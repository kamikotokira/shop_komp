<div class="header">
    <h2>Добавить поставщика</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=supplier&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<form method="POST" class="form">
    <div class="form-group">
        <label for="Name">Название</label>
        <input type="text" name="Name" id="Name" required>
    </div>

    <div class="form-group">
        <label for="ContactInfo">Контактная информация</label>
        <textarea name="ContactInfo" id="ContactInfo" rows="4"></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn">
            <i class="icon">✓</i> Сохранить
        </button>
        <a href="index.php?entity=supplier&action=index" class="btn secondary">
            <i class="icon">←</i> Отмена
        </a>
    </div>
</form>