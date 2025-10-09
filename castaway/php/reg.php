<?php
session_name('podcasts');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'link.php';
    $password = password_hash($_POST['pswrd'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $login = $_POST['login'];
    $admin = 0;
    if (isset($_POST['isartist'])){
        $admin = 1;
    }
    $result = $conn->query("SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'");
    if ($result->num_rows > 0) {
        echo "<script>alert('Логин или адрес электронной почты уже используется!'); console.log('error, login - $login or email - $email are used by other user.'); window.location.href='../index.html#regast';</script>";
    } else {
        $conn->query("INSERT INTO `users` (`id`, `login`, `email`, `pswrd`, `favs`, `adm`) VALUES (NULL, '$login', '$email', '$password', NULL, $admin)");
        $idi = $conn->query("SELECT `id` FROM `users` WHERE `login` = '$login'");
        while ($tryres = mysqli_fetch_assoc($idi)){
            $id = $tryres['id'];
        }
        $_SESSION['islogged'] = true;
        $_SESSION['user'] = $id;
        echo "<script>localStorage.setItem('islogged', 'true'); localStorage.setItem('user', '$id'); localStorage.setItem('isartist', '$admin'); console.log('passed.'); window.location.href='mainpage.php';</script>";
    }
    $conn->close();
}