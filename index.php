<?php
session_start();
require_once 'model.php';

$entity = $_GET['entity'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

if ($entity !== 'home') {
    $controller_file = __DIR__ . "/controllers/{$entity}_controller.php";

    if (file_exists($controller_file)) {
        require_once $controller_file;

        $function_name = "{$entity}_{$action}";

        if (function_exists($function_name)) {
            call_user_func($function_name);
            exit;
        }
    }

    header("Location: index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление компьютерным магазином</title>
    <style>
        body {
            background-color: #f5f9fc;
            color: #2c3e50;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background: linear-gradient(135deg, #f5f9fc 0%, #e6f2ff 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 0 25px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eaeef5;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header h2 {
            color: #2c3e50;
            font-size: 26px;
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .header>div {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.2);
            gap: 8px;
        }

        .btn:hover {
            background: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.3);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn.danger {
            background: #e74c3c;
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
        }

        .btn.danger:hover {
            background: #c0392b;
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.3);
        }

        .btn.secondary {
            background: #95a5a6;
            box-shadow: 0 4px 10px rgba(149, 165, 166, 0.2);
        }

        .btn.secondary:hover {
            background: #7f8c8d;
            box-shadow: 0 6px 15px rgba(149, 165, 166, 0.3);
        }

        .form {
            max-width: 700px;
            margin: 20px auto 30px;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            border: 1px solid #eaeef5;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .form-group label::before {
            content: "•";
            color: #3498db;
            font-size: 20px;
            margin-right: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #dce4ec;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9fbfd;
            color: #2c3e50;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
            background: #fff;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
            border-top: 1px solid #eaeef5;
            padding-top: 25px;
        }

        .details {
            background: #f9fbfd;
            padding: 30px;
            border-radius: 12px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid #eaeef5;
        }

        .detail-card {
            margin: 18px 0;
            padding: 22px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #3498db;
            font-size: 16px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.03);
            display: flex;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #2980b9;
        }

        .detail-card strong {
            min-width: 220px;
            color: #2c3e50;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .detail-card strong::after {
            content: ":";
            margin-right: 10px;
            color: #7f8c8d;
        }

        .alert {
            padding: 18px 22px;
            margin-bottom: 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
        }

        .alert.success {
            background-color: #f0faf5;
            color: #0d6832;
            border: 1px solid #c5e7d4;
        }

        .alert.success::before {
            background: #27ae60;
        }

        .alert.success i {
            color: #27ae60;
            font-size: 20px;
        }

        .alert.error {
            background-color: #fdf3f5;
            color: #c91a3a;
            border: 1px solid #f5d0d7;
        }

        .alert.error::before {
            background: #e74c3c;
        }

        .alert.error i {
            color: #e74c3c;
            font-size: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eaeef5;
        }

        .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            width: 36px;
            height: 36px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 50%;
            color: #3498db;
            font-size: 18px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            animation: fadeIn 0.4s ease-out;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            animation: fadeIn 0.5s ease-out;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header>div {
                width: 100%;
                justify-content: flex-start;
            }

            .form {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .detail-card {
                flex-direction: column;
                gap: 8px;
                padding: 18px;
            }

            .detail-card strong {
                min-width: auto;
                margin-bottom: 5px;
            }

            .detail-card strong::after {
                content: "";
                margin-right: 0;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .form {
                padding: 20px;
            }

            .details {
                padding: 20px;
            }

            .header h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class="alert success">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['error'])) {
        echo '<div class="alert error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    <div class="container">
        <div class="header">
            <h1>Система управления компьютерным магазином</h1>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li> <!-- Новая кнопка -->
                <li><a href="index.php?entity=supplier&action=index">Поставщики</a></li>
                <li><a href="index.php?entity=product&action=index">Товары</a></li>
                <li><a href="index.php?entity=order_request&action=index">Заявки</a></li>
            </ul>
        </nav>

        <div class="content">
            <?php if ($entity === 'home'): ?>
                <div class="welcome">
                    <h2>Добро пожаловать в систему управления!</h2>
                    <p>Используйте навигацию выше для управления данными компьютерного магазина.</p>
                    <p>Доступные функции:</p>
                    <ul>
                        <li>Управление поставщиками (добавление, редактирование, удаление)</li>
                        <li>Управление товарами (добавление, редактирование, удаление)</li>
                        <li>Управление заявками (создание, просмотр, редактирование, удаление)</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>