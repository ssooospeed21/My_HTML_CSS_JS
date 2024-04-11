<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $workplace = $_POST['workplace'];
    $position = $_POST['position'];
    $work_phone = $_POST['work_phone'];
    $has_business_card = isset($_POST['has_business_card']) ? 1 : 0;

    // Проверка наличия аккаунта
    if (isset($_POST['create_account'])) {
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();
        $user_id = $db->lastInsertId();
        setcookie('user_id', $user_id, time() + 86400, '/');
    } else {
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['id'];
        setcookie('user_id', $user_id, time() + 86400, '/');
    }

    // Вставка данных заказа в таблицу orders
    $stmt = $db->prepare("INSERT INTO orders (user_id, full_name, phone, email, address, workplace, position, work_phone, has_business_card, visid) VALUES (:user_id, :full_name, :phone, :email, :address, :workplace, :position, :work_phone, :has_business_card, 1)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':workplace', $workplace);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':work_phone', $work_phone);
    $stmt->bindParam(':has_business_card', $has_business_card);
    $stmt->execute();
    // Получение ID заказа
    $order_id = $db->lastInsertId();
    setcookie('order_id', $order_id, time() + 86400, '/');

    // Перенаправление на страницу с подтверждением
    header("Location: conformation.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Оформление заказа</title>
    <style>
        body{
            background: cadetblue;
            color: darkslategrey;
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tac+One&display=swap" rel="stylesheet">
</head>
<body>
<header style="display: flex; align-items: center; justify-content: space-around;">
    <div style="display: flex; align-items: center"><img src="../img/cactus-svgrepo-com.svg" width="60" height="60"><p style="font-family: 'Tac One', sans-serif; font-size: 36px">Cactu!</p></div>
    <div style="font-size: 24px">Order now!</div>
</header>
<section style="display: flex; flex-direction: column; align-items: center; gap: 40px">
    <h2>Оформление заказа</h2>
    <form method="post" action="" style="display: flex; align-items: center; gap: 100px; background: lightgray; padding: 40px; border-radius: 30px">
        <div style="display: flex; flex-direction: column; gap: 20px">
            <label style="color: darkslategrey; font-size: 20px">ФИО:</label>
            <input type="text" name="full_name" required  style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            <label style="color: darkslategrey; font-size: 20px">Телефон:</label>
            <input type="tel" name="phone" required pattern="[0-9]{11}" style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            <label style="color: darkslategrey; font-size: 20px">Email:</label>
            <input type="email" name="email" required style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
        </div>
        <div style="display: flex; flex-direction: column; gap: 20px">
            <label style="color: darkslategrey; font-size: 20px">Адрес:</label>
            <input type="text" name="address" required style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            <label style="color: darkslategrey; font-size: 20px">Место работы:</label>
            <input type="text" name="workplace" required style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            <label style="color: darkslategrey; font-size: 20px">Должность:</label>
            <input type="text" name="position" required style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
        </div>
        <div style="display: flex; flex-direction: column; gap: 20px">
            <label style="color: darkslategrey; font-size: 20px">Рабочий телефон:</label>
            <input type="tel" name="work_phone" required pattern="[0-9]{11}" style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            <div style="display: flex; align-items: center;">
                <label style="color: darkslategrey; font-size: 20px">Личная визитка:</label>
                <input type="checkbox" name="has_business_card">
            </div>
            <div style="display: flex; align-items: center;">
                <label style="color: darkslategrey; font-size: 20px">Создать аккаунт:</label>
                <input type="checkbox" name="create_account" onclick="togglePassword(this)">
            </div>
            <div id="password_field" style="display: none;">
                <label style="color: darkslategrey; font-size: 20px">Пароль:</label>
                <input type="password" name="password" style="border: 1px solid black; border-radius: 20px; padding: 10px 15px">
            </div>
        </div>
        <button type="submit" style="border: 1px solid black; padding: 20px; font-size: 16px; border-radius: 20px">Отправить</button>
    </form>
</section>
<script>
    function togglePassword(checkbox) {
        let passwordField = document.getElementById('password_field');
        passwordField.style.display = checkbox.checked ? 'block' : 'none';
    }
</script>
</body>
</html>
