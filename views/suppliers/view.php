<div class="header">
    <h2>Просмотр поставщика</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=supplier&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<div class="details">
    <div class="detail-card">
        <strong>ID</strong>
        <span><?= htmlspecialchars($supplier['SupplierID']) ?></span>
    </div>
    <div class="detail-card">
        <strong>Название</strong>
        <span><?= htmlspecialchars($supplier['Name']) ?></span>
    </div>
    <div class="detail-card">
        <strong>Контактная информация</strong>
        <span><?= htmlspecialchars($supplier['ContactInfo']) ?></span>
    </div>
</div>

<div class="actions">
    <a href="index.php?entity=supplier&action=edit&id=<?= $supplier['SupplierID'] ?>" class="btn">Редактировать</a>
    <a href="index.php?entity=supplier&action=delete&id=<?= $supplier['SupplierID'] ?>" class="btn danger"
        onclick="return confirm('Удалить поставщика?')">Удалить</a>
</div>