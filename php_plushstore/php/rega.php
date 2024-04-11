<?php
$link = mysqli_connect('localhost', 'root', '', 'maga');
if (!$link) die('error');

$conn = new mysqli('localhost', 'root', '', 'maga');
if ($conn->connect_error){
    die('Error' . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['logen'];
    $password = password_hash($_POST['parol'], PASSWORD_DEFAULT);
    $res = $conn->query("INSERT INTO `Users` (`id`, `login`, `parol`) VALUES (NULL, '$login', '$password');");
    echo 'Регистрация прошла успешно, вернитесь назад.';
}
$conn->close();