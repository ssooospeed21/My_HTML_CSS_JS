<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <title>Корзина</title>
    <script type="text/javascript">
        "use strict"
        function updateCart() {
            let cartContainer = document.getElementById("cart-container");
            let cartBody = document.getElementById("cart-body");

            cartBody.innerHTML = "";

            let cartItems = <?php echo json_encode(isset($_SESSION['cart']) ? $_SESSION['cart'] : array()); ?>;

            cartItems.forEach(function (item) {
                let row = document.createElement("tr");
                row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.price} rub</td>
                <td><button onclick="removeFromCart(${item.id})">Remove</button></td>
            `;
                cartBody.appendChild(row);
            });

            let totalAmount = cartItems.reduce(function (total, item) {
                return total + (item.quantity * item.price);
            }, 0);

            document.getElementById("total-amount").textContent = totalAmount + " rub";
            cartContainer.style.display = cartItems.length > 0 ? "block" : "none";
        }

        function removeFromCart(productId) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove_from_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    updateCart();
                }
            };
            xhr.send('productId=' + productId);
        }

        window.onload = updateCart;
    </script>
</head>
<body>
<header class="wrapper" style="margin-top: 40px;">
    <div style="display: flex; justify-content: space-evenly; align-items: center;">
        <img src="../img/Revelation.logo.svg" alt="">
        <div style="display: flex; gap: 40px; align-items: center; color: gray; font-size: 24px">
            <a href="../index.html">Home</a>
            <a href="trashbox.php">Order</a>
            <a href="store.php">Shop</a>
        </div>
    </div>
</header>
<div id="cart-container" style="display: block !important;">
    <h2>Shopping Cart</h2>
    <table id="cart-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="cart-body">
        </tbody>
    </table>
    <div id="total-price">
        <strong>Total:</strong> <span id="total-amount">0 rub</span>
    </div>
</div>
<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addToCart'])) {
        $conn = new mysqli('localhost', 'root', '', 'maga');
        if ($conn->connect_error){
            die('Error' . $conn->connect_error);
        }

        $selectedToy = $_POST['addToCart'];

        $stmt = $conn->prepare("SELECT toy_id, toy_name, toy_price FROM Products WHERE toy_name = ?");
        $stmt->bind_param("s", $selectedToy);
        $stmt->execute();
        $stmt->bind_result($productId, $productName, $productPrice);

        if ($stmt->fetch()) {
            addToCart($productId, $productName, $productPrice);
            echo "Товар '$selectedToy' добавлен в корзину!";
        } else {
            echo "Товар не найден!";
        }

        $stmt->close();
        $conn->close();
    }
}
function addToCart($productId, $productName, $productPrice) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productKey = array_search($productId, array_column($_SESSION['cart'], 'id'));

    if ($productKey !== false) {
        $_SESSION['cart'][$productKey]['quantity']++;
    } else {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'quantity' => 1,
            'price' => $productPrice
        ];
    }
}
?>
<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>

