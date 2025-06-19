<div class="header">
    <h2>Заявки</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=order_request&action=create" class="btn">Создать заявку</a>
    </div>
</div>

<?php if (isset($message)): ?>
    <div class="alert success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Поставщик</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?= htmlspecialchars($request['RequestID']) ?></td>
                <td><?= htmlspecialchars($request['Date']) ?></td>
                <td><?= htmlspecialchars($request['SupplierName']) ?></td>
                <td class="actions">
                    <a href="index.php?entity=order_request&action=view&id=<?= $request['RequestID'] ?>"
                        class="btn">Просмотр</a>
                    <a href="index.php?entity=order_request&action=edit&id=<?= $request['RequestID'] ?>"
                        class="btn">Редактировать</a>
                    <a href="index.php?entity=order_request&action=delete&id=<?= $request['RequestID'] ?>"
                        class="btn danger" onclick="return confirm('Удалить заявку?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>