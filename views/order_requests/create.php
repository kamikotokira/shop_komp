<div class="header">
    <h2>Создать заявку</h2>
    <div>
        <a href="index.php" class="btn">На главную</a>
        <a href="index.php?entity=order_request&action=index" class="btn">Назад к списку</a>
    </div>
</div>

<form method="POST" class="form">
    <div class="form-group">
        <label for="SupplierID">Поставщик:</label>
        <select name="SupplierID" id="SupplierID" required>
            <?php foreach ($suppliers as $supplier): ?>
                <option value="<?= $supplier['SupplierID'] ?>">
                    <?= htmlspecialchars($supplier['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="Date">Дата:</label>
        <input type="date" name="Date" id="Date" value="<?= date('Y-m-d') ?>" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn">Сохранить</button>
        <a href="index.php?entity=order_request&action=index" class="btn">Отмена</a>
    </div>
</form>