<?php
function supplier_index()
{
    $suppliers = get_suppliers();

    $message = $_SESSION['message'] ?? null;
    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['message'], $_SESSION['error']);

    include __DIR__ . '/../views/suppliers/index.php';
}

function supplier_view()
{
    $id = $_GET['id'] ?? 0;
    $supplier = get_supplier($id);

    if (!$supplier) {
        header("Location: index.php?entity=supplier&action=index");
        exit;
    }

    include __DIR__ . '/../views/suppliers/view.php';
}

function supplier_create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'Name' => $_POST['Name'],
            'ContactInfo' => $_POST['ContactInfo']
        ];

        $id = create_record('supplier', $data);
        header("Location: index.php?entity=supplier&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/suppliers/create.php';
}

function supplier_edit()
{
    $id = $_GET['id'] ?? 0;
    $supplier = get_supplier($id);

    if (!$supplier) {
        header("Location: index.php?entity=supplier&action=index");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'Name' => $_POST['Name'],
            'ContactInfo' => $_POST['ContactInfo']
        ];

        update_record('supplier', $id, $data);
        header("Location: index.php?entity=supplier&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/suppliers/edit.php';
}

function supplier_delete()
{
    $id = $_GET['id'] ?? 0;
    if ($id) {
        if (delete_supplier_cascade($id)) {
            $_SESSION['message'] = "Поставщик и все связанные данные успешно удалены";
        } else {
            $_SESSION['error'] = "Ошибка при удалении поставщика";
        }
    }
    header("Location: index.php?entity=supplier&action=index");
    exit;
}