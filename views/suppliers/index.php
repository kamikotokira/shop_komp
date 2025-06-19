<div class="header">
    <h2>Поставщики</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=supplier&action=create" class="btn">Добавить поставщика</a>
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
            <th>Название</th>
            <th>Контактная информация</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($suppliers as $supplier): ?>
            <tr>
                <td><?= htmlspecialchars($supplier['SupplierID']) ?></td>
                <td><?= htmlspecialchars($supplier['Name']) ?></td>
                <td><?= htmlspecialchars($supplier['ContactInfo']) ?></td>
                <td class="actions">
                    <a href="index.php?entity=supplier&action=view&id=<?= $supplier['SupplierID'] ?>"
                        class="btn">Просмотр</a>
                    <a href="index.php?entity=supplier&action=edit&id=<?= $supplier['SupplierID'] ?>"
                        class="btn">Редактировать</a>
                    <a href="index.php?entity=supplier&action=delete&id=<?= $supplier['SupplierID'] ?>" class="btn danger"
                        onclick="return confirm('Удалить поставщика?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>