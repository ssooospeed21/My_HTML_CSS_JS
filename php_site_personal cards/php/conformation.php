<?php
include "db.php";
$usid = $_COOKIE['user_id'];
$orderid = $_COOKIE['order_id'];
$stmt = $db->prepare("SELECT visid, full_name, workplace, position, phone, email, work_phone FROM orders WHERE user_id = :usid AND id = :orderid");
$stmt->bindParam(':usid', $usid);
$stmt->bindParam(':orderid', $orderid);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

$image = imagecreatefromjpeg('../img/visfinal'.$order['visid'].'.jpg');

$color = imagecolorallocate($image, 0, 30, 50);

$font_path = "Roboto-Regular.ttf";
$x = 200;
$y = 200;
imagettftext($image, 20, 0, 450, 380, $color, $font_path, $order['full_name']);
imagettftext($image, 40, 0, 520, 430, $color, $font_path, $order['workplace']);
imagettftext($image, 30, 0, 360, 770, $color, $font_path, $order['full_name']);
imagettftext($image, 30, 0, 450, 950, $color, $font_path, $order['position']);
imagettftext($image, 20, 0, 720, 840, $color, $font_path, $order['phone']);
imagettftext($image, 20, 0, 720, 890, $color, $font_path, $order['email']);
imagettftext($image, 20, 0, 720, 940, $color, $font_path, $order['work_phone']);
imagettftext($image, 20, 0, 720, 990, $color, $font_path, $order['workplace']);

imagejpeg($image, '../img/visfinal_with_text.jpg');

imagedestroy($image);
?>


<!DOCTYPE html>
<html lang="ru">
<style>
    body{
        background: cadetblue;
        color: darkslategrey;
    }
</style>
<head>
    <title>Заказ оформлен</title>
</head>
<body>
<section style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 40px 0; gap: 40px">
    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h2>Заказ успешно оформлен</h2>
        <p>Благодарим за ваш заказ. Мы свяжемся с вами в ближайшее время.</p>
    </div>
    <div>
        <img src="../img/visfinal_with_text.jpg?<?php echo time(); ?>" alt="" height="500" width="500">
    </div>
    <a href="../index.html" style="border: 1px solid black; padding: 20px; font-size: 16px; border-radius: 20px; background: white; text-decoration: none; color: darkslategrey">На главную</a>
</section>
</body>
</html>

