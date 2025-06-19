<?php
function order_request_index()
{
    $requests = get_order_requests();

    $message = $_SESSION['message'] ?? null;
    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['message'], $_SESSION['error']);

    include __DIR__ . '/../views/order_requests/index.php';
}

function order_request_view()
{
    $id = $_GET['id'] ?? 0;
    $request = get_order_request($id);

    if (!$request) {
        header("Location: index.php?entity=order_request&action=index");
        exit;
    }

    include __DIR__ . '/../views/order_requests/view.php';
}

function order_request_create()
{
    $suppliers = get_suppliers();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'SupplierID' => $_POST['SupplierID'],
            'Date' => $_POST['Date']
        ];

        $id = create_record('order_request', $data);
        $_SESSION['message'] = "Заявка успешно создана";
        header("Location: index.php?entity=order_request&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/order_requests/create.php';
}

function order_request_edit()
{
    $id = $_GET['id'] ?? 0;
    $request = get_order_request($id);
    $suppliers = get_suppliers();

    if (!$request) {
        header("Location: index.php?entity=order_request&action=index");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'SupplierID' => $_POST['SupplierID'],
            'Date' => $_POST['Date']
        ];

        update_record('order_request', $id, $data);
        $_SESSION['message'] = "Заявка успешно обновлена";
        header("Location: index.php?entity=order_request&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/order_requests/edit.php';
}

function order_request_delete()
{
    $id = $_GET['id'] ?? 0;
    if ($id) {
        if (delete_order_request_cascade($id)) {
            $_SESSION['message'] = "Заявка и все связанные данные успешно удалены";
        } else {
            $_SESSION['error'] = "Ошибка при удалении заявки";
        }
    }
    header("Location: index.php?entity=order_request&action=index");
    exit;
}