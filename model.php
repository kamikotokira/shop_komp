<?php
require_once 'config.php';


function get_db_connection()
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    return $pdo;
}


function get_all_records($table)
{
    $pdo = get_db_connection();
    $stmt = $pdo->query("SELECT * FROM $table");
    return $stmt->fetchAll();
}


function get_record_by_id($table, $id)
{
    $pdo = get_db_connection();
    $primary_key = get_primary_key($table);

    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $primary_key = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}


function create_record($table, $data)
{
    $pdo = get_db_connection();

    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $values = array_values($data);

    $stmt = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
    $stmt->execute($values);
    return $pdo->lastInsertId();
}


function update_record($table, $id, $data)
{
    $pdo = get_db_connection();
    $primary_key = get_primary_key($table);

    $set = [];
    $values = [];

    foreach ($data as $column => $value) {
        $set[] = "$column = ?";
        $values[] = $value;
    }

    $values[] = $id;
    $set = implode(', ', $set);

    $stmt = $pdo->prepare("UPDATE $table SET $set WHERE $primary_key = ?");
    return $stmt->execute($values);
}


function delete_record($table, $id)
{
    $pdo = get_db_connection();
    $primary_key = get_primary_key($table);

    $stmt = $pdo->prepare("DELETE FROM $table WHERE $primary_key = ?");
    return $stmt->execute([$id]);
}


function get_primary_key($table)
{
    $parts = explode('_', $table);
    $entity = array_pop($parts);
    return $entity . 'ID';
}


function get_suppliers()
{
    return get_all_records('supplier');
}


function get_supplier($id)
{
    return get_record_by_id('supplier', $id);
}


function get_products()
{
    return get_all_records('product');
}


function get_product($id)
{
    return get_record_by_id('product', $id);
}


function get_order_requests()
{
    $pdo = get_db_connection();
    $stmt = $pdo->query("
        SELECT orq.*, s.Name AS SupplierName 
        FROM order_request orq
        JOIN supplier s ON orq.SupplierID = s.SupplierID
    ");
    return $stmt->fetchAll();
}


function get_order_request($id)
{
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("
        SELECT orq.*, s.Name AS SupplierName 
        FROM order_request orq
        JOIN supplier s ON orq.SupplierID = s.SupplierID
        WHERE orq.RequestID = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch();
}


function delete_supplier_cascade($id)
{
    $pdo = get_db_connection();
    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("
            DELETE ii FROM invoice_item ii
            JOIN invoice i ON ii.InvoiceID = i.InvoiceID
            WHERE i.SupplierID = ?
        ");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM invoice WHERE SupplierID = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("
            DELETE ri FROM request_item ri
            JOIN order_request o ON ri.RequestID = o.RequestID
            WHERE o.SupplierID = ?
        ");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM order_request WHERE SupplierID = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM supplier WHERE SupplierID = ?");
        $stmt->execute([$id]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Ошибка удаления поставщика: " . $e->getMessage());
        return false;
    }
}


function delete_product_cascade($id)
{
    $pdo = get_db_connection();
    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("DELETE FROM request_item WHERE ProductID = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM invoice_item WHERE ProductID = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM receipt_item WHERE ProductID = ?");
        $stmt->execute([$id]);

        $stmt = $pdo->prepare("DELETE FROM product WHERE ProductID = ?");
        $stmt->execute([$id]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Ошибка удаления товара: " . $e->getMessage());
        return false;
    }
}


function delete_order_request_cascade($id)
{
    $pdo = get_db_connection();
    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("DELETE FROM request_item WHERE RequestID = ?");
        $stmt->execute([$id]);

        $invoices = $pdo->prepare("SELECT InvoiceID FROM invoice WHERE RequestID = ?");
        $invoices->execute([$id]);

        while ($invoice = $invoices->fetch()) {
            $stmt = $pdo->prepare("DELETE FROM invoice_item WHERE InvoiceID = ?");
            $stmt->execute([$invoice['InvoiceID']]);

            $stmt = $pdo->prepare("DELETE FROM invoice WHERE InvoiceID = ?");
            $stmt->execute([$invoice['InvoiceID']]);
        }

        $stmt = $pdo->prepare("DELETE FROM order_request WHERE RequestID = ?");
        $stmt->execute([$id]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Ошибка удаления заявки: " . $e->getMessage());
        return false;
    }
}