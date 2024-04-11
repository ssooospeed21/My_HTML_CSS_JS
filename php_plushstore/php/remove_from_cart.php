<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        // Удаление товара из сессии PHP
        session_start();
        $productKey = array_search($productId, array_column($_SESSION['cart'], 'id'));

        if ($productKey !== false) {
            unset($_SESSION['cart'][$productKey]);
        }
    }
}