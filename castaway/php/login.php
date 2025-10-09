<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,200&display=swap"
          rel="stylesheet">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Authorizacion</title>
</head>
<body>
<div style="display: flex; margin-top: 100px">
    <div class="wrapper form" id="regast">
        <div class="form-frstcontainer">
            <div class="form-frstcontainer-smallh">Login</div>
            <div class="form-frstcontainer-bigh">Welcome back!</div>
        </div>
        <div>
            <form class="form-scndcontainer" method="post" action="">
                <label><input class="form-scndcontainer-input" placeholder="Login" type="text" name="login"></label>
                <label><input class="form-scndcontainer-input" placeholder="Password" required type="password" name="pswrd"></label>
                <button class="form-scndcontainer-button">Ready</button>
            </form>
        </div>
    </div>
</div>
<div class="wrapper upl-div">
    <a class="goback" href="../index.html">go back</a>
</div>
<?php
session_name('podcasts');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'link.php';
    $login = $_POST["login"];
    $try = $conn->query("SELECT `id`, `login`, `pswrd`, `adm` FROM `users` WHERE `login` = '$login'");
    while ($tryresult = mysqli_fetch_assoc($try)){
        $id = $tryresult['id'];
        $login = $tryresult['login'];
        $passhash = $tryresult['pswrd'];
        $adm = $tryresult['adm'];
    }
    $password = password_verify($_POST['pswrd'], $passhash);
    if ($password){
        $_SESSION['islogged'] = true;
        $_SESSION['user'] = $id;
        $_SESSION['isadm'] = $adm;
        echo "<script>localStorage.setItem('islogged', 'true'); localStorage.setItem('user', '$id');localStorage.setItem('artist', '$adm'); console.log('passed.'); window.location.href='mainpage.php';</script>";
    } else {
        echo "<script>alert('Неправильный пароль или имя пользователя!'); console.log('error, login - $login are used by other user or incorrect password.'); window.location.href='login.php';</script>";
        exit();
    }
}
?>
</body>
</html>