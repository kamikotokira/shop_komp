-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2025 г., 19:58
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `computer_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `invoice`
--

CREATE TABLE `invoice` (
  `SupplierID` int(11) NOT NULL,
  `RequestID` int(11) DEFAULT NULL,
  `InvoiceID` int(11) NOT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `TotalAmount` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `invoice`
--

INSERT INTO `invoice` (`SupplierID`, `RequestID`, `InvoiceID`, `DeliveryDate`, `TotalAmount`) VALUES
(3, 3, 3, '2023-10-22', 156000.0000),
(4, 4, 4, '2023-10-23', 74000.0000),
(5, 5, 5, '2023-10-24', 125000.0000);

-- --------------------------------------------------------

--
-- Структура таблицы `invoice_item`
--

CREATE TABLE `invoice_item` (
  `InvoiceID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `PurchasePrice` decimal(19,4) DEFAULT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `invoice_item`
--

INSERT INTO `invoice_item` (`InvoiceID`, `Quantity`, `PurchasePrice`, `ProductID`) VALUES
(3, 8, 12000.0000, 5),
(3, 5, 9000.0000, 6),
(4, 6, 7000.0000, 7),
(4, 4, 8000.0000, 8),
(5, 5, 10000.0000, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `order_request`
--

CREATE TABLE `order_request` (
  `SupplierID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `order_request`
--

INSERT INTO `order_request` (`SupplierID`, `RequestID`, `Date`) VALUES
(3, 3, '2023-10-17'),
(4, 4, '2023-10-18'),
(5, 5, '2023-10-19');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Category` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Category`) VALUES
(2, 'Видеокарта NVIDIA GeForce RTX 3080', 'Видеокарты'),
(3, 'Материнская плата ASUS ROG Strix Z690-E', 'Материнские платы'),
(4, 'Оперативная память Kingston Fury 32GB DDR5', 'Оперативная память'),
(5, 'SSD накопитель Samsung 980 PRO 1TB', 'SSD'),
(6, 'Блок питания Cooler Master MWE Gold 850W', 'Блоки питания'),
(7, 'Корпус NZXT H510 Flow', 'Корпуса'),
(8, 'Кулер для процессора Noctua NH-D15', 'Охлаждение'),
(10, 'Клавиатура Logitech G Pro X', 'Периферия');

-- --------------------------------------------------------

--
-- Структура таблицы `receipt`
--

CREATE TABLE `receipt` (
  `ReceiptID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `TotalAmount` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `receipt`
--

INSERT INTO `receipt` (`ReceiptID`, `Date`, `TotalAmount`) VALUES
(1, '2023-10-25', 320000.0000),
(2, '2023-10-26', 245000.0000),
(3, '2023-10-27', 180000.0000),
(4, '2023-10-28', 95000.0000),
(5, '2023-10-29', 135000.0000);

-- --------------------------------------------------------

--
-- Структура таблицы `receipt_item`
--

CREATE TABLE `receipt_item` (
  `ProductID` int(11) NOT NULL,
  `ReceiptID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `SalePrice` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `receipt_item`
--

INSERT INTO `receipt_item` (`ProductID`, `ReceiptID`, `Quantity`, `SalePrice`) VALUES
(2, 1, 1, 70000.0000),
(3, 2, 1, 25000.0000),
(4, 2, 3, 9000.0000),
(5, 3, 2, 14000.0000),
(6, 3, 1, 10000.0000),
(7, 4, 1, 8000.0000),
(8, 4, 1, 9000.0000),
(10, 5, 2, 12000.0000);

-- --------------------------------------------------------

--
-- Структура таблицы `request_item`
--

CREATE TABLE `request_item` (
  `RequestID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `RequestedPrice` decimal(19,4) DEFAULT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `request_item`
--

INSERT INTO `request_item` (`RequestID`, `Quantity`, `RequestedPrice`, `ProductID`) VALUES
(3, 8, 12000.0000, 5),
(3, 5, 9000.0000, 6),
(4, 6, 7000.0000, 7),
(4, 4, 8000.0000, 8),
(5, 5, 10000.0000, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `ContactInfo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Name`, `ContactInfo`) VALUES
(2, 'Электроника ООО', 'г. Санкт-Петербург, пр. Технологический, 10, тел: +7 (812) 987-65-43'),
(3, 'IT-Ресурс', 'г. Екатеринбург, ул. Процессорная, 5, тел: +7 (343) 555-44-33'),
(4, 'Компьютерные решения', 'г. Новосибирск, ул. Видеокартная, 15, тел: +7 (383) 222-33-44'),
(5, 'Техноимпорт', 'г. Казань, ул. Материнская, 3, тел: +7 (843) 777-88-99');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `fk_invoice_supplier` (`SupplierID`);

--
-- Индексы таблицы `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`InvoiceID`,`ProductID`),
  ADD KEY `fk_invoice_item_product` (`ProductID`);

--
-- Индексы таблицы `order_request`
--
ALTER TABLE `order_request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `fk_order_request_supplier` (`SupplierID`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Индексы таблицы `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`ReceiptID`);

--
-- Индексы таблицы `receipt_item`
--
ALTER TABLE `receipt_item`
  ADD PRIMARY KEY (`ProductID`,`ReceiptID`),
  ADD KEY `fk_receipt_item_receipt` (`ReceiptID`);

--
-- Индексы таблицы `request_item`
--
ALTER TABLE `request_item`
  ADD PRIMARY KEY (`RequestID`,`ProductID`),
  ADD KEY `fk_request_item_product` (`ProductID`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_order_request` FOREIGN KEY (`RequestID`) REFERENCES `order_request` (`RequestID`),
  ADD CONSTRAINT `fk_invoice_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Ограничения внешнего ключа таблицы `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `fk_invoice_item_invoice` FOREIGN KEY (`InvoiceID`) REFERENCES `invoice` (`InvoiceID`),
  ADD CONSTRAINT `fk_invoice_item_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Ограничения внешнего ключа таблицы `order_request`
--
ALTER TABLE `order_request`
  ADD CONSTRAINT `fk_order_request_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Ограничения внешнего ключа таблицы `receipt_item`
--
ALTER TABLE `receipt_item`
  ADD CONSTRAINT `fk_receipt_item_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `fk_receipt_item_receipt` FOREIGN KEY (`ReceiptID`) REFERENCES `receipt` (`ReceiptID`);

--
-- Ограничения внешнего ключа таблицы `request_item`
--
ALTER TABLE `request_item`
  ADD CONSTRAINT `fk_request_item_order` FOREIGN KEY (`RequestID`) REFERENCES `order_request` (`RequestID`),
  ADD CONSTRAINT `fk_request_item_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
