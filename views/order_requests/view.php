<div class="header">
    <h2>Просмотр заявки #<?= htmlspecialchars($request['RequestID']) ?></h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=order_request&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<div class="details">
    <p><strong>ID:</strong> <?= htmlspecialchars($request['RequestID']) ?></p>
    <p><strong>Дата:</strong> <?= htmlspecialchars($request['Date']) ?></p>
    <p><strong>Поставщик:</strong> <?= htmlspecialchars($request['SupplierName']) ?></p>
</div>

<div class="actions">
    <a href="index.php?entity=order_request&action=edit&id=<?= $request['RequestID'] ?>" class="btn">Редактировать</a>
    <a href="index.php?entity=order_request&action=delete&id=<?= $request['RequestID'] ?>" class="btn danger"
        onclick="return confirm('Удалить заявку?')">Удалить</a>
</div>