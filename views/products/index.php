<div class="header">
    <h2>Товары</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=product&action=create" class="btn">Добавить товар</a>
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
            <th>Категория</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['ProductID']) ?></td>
                <td><?= htmlspecialchars($product['Name']) ?></td>
                <td><?= htmlspecialchars($product['Category']) ?></td>
                <td class="actions">
                    <a href="index.php?entity=product&action=view&id=<?= $product['ProductID'] ?>" class="btn">Просмотр</a>
                    <a href="index.php?entity=product&action=edit&id=<?= $product['ProductID'] ?>"
                        class="btn">Редактировать</a>
                    <a href="index.php?entity=product&action=delete&id=<?= $product['ProductID'] ?>" class="btn danger"
                        onclick="return confirm('Удалить товар?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>