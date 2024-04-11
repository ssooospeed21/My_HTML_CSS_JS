<?php
$link = mysqli_connect('localhost', 'root', '', 'maga');
if (!$link) die('error');

$conn = new mysqli('localhost', 'root', '', 'maga');
if ($conn->connect_error){
    die('Error' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = $_POST['login'];
    $psresult = $conn->query("SELECT * FROM Users WHERE login='$login'");
    while ($psrow = $psresult->fetch_assoc()){
        $id = $psrow['id'];
        $login = $psrow['login'];
        $hash = $psrow['parol'];
    }
    setcookie('id', $id);
    $password = password_verify($_POST['pass'], $hash);
    if ($password){
        header('Location: store.php');
        exit();
    } else {
        echo 'Неверный логин или пароль.';
    }
}


$conn->close();