<?php
function product_index()
{
    $products = get_products();

    $message = $_SESSION['message'] ?? null;
    $error = $_SESSION['error'] ?? null;
    unset($_SESSION['message'], $_SESSION['error']);

    include __DIR__ . '/../views/products/index.php';
}

function product_view()
{
    $id = $_GET['id'] ?? 0;
    $product = get_product($id);

    if (!$product) {
        header("Location: index.php?entity=product&action=index");
        exit;
    }

    include __DIR__ . '/../views/products/view.php';
}


function product_create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'Name' => $_POST['Name'],
            'Category' => $_POST['Category']
        ];

        $id = create_record('product', $data);
        $_SESSION['message'] = "Товар успешно добавлен";
        header("Location: index.php?entity=product&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/products/create.php';
}

function product_edit()
{
    $id = $_GET['id'] ?? 0;
    $product = get_product($id);

    if (!$product) {
        header("Location: index.php?entity=product&action=index");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'Name' => $_POST['Name'],
            'Category' => $_POST['Category']
        ];

        update_record('product', $id, $data);
        $_SESSION['message'] = "Товар успешно обновлен";
        header("Location: index.php?entity=product&action=view&id=$id");
        exit;
    }

    include __DIR__ . '/../views/products/edit.php';
}

function product_delete()
{
    $id = $_GET['id'] ?? 0;
    if ($id) {
        if (delete_product_cascade($id)) {
            $_SESSION['message'] = "Товар и все связанные данные успешно удалены";
        } else {
            $_SESSION['error'] = "Ошибка при удалении товара";
        }
    }
    header("Location: index.php?entity=product&action=index");
    exit;
}