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
    <title></title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "link.php";
    session_name('podcasts');
    session_start();
    $loginus = $_SESSION['user'];//пофиксил НИХУЯ
    echo "<script>console.log('$loginus')</script>";
    $try = $conn->query("SELECT * FROM users WHERE id = '$loginus'");
    while ($result = mysqli_fetch_assoc($try)) {
        $id = $result['id'];
        $login = $result['login'];
        $email = $result['email'];
        $pswrd = $result['pswrd'];
        $favs = $result['favs']; echo "<script>console.log('$favs')</script>";
        $adm = $result['adm'];
    }
    $newFav = $_POST['idadd'];
    if (!empty($favs)) {
        $favsArray = json_decode($favs, true);
    } else {
        $favsArray = array();
    }
    if ($newFav) {
        $favsArray[] = $newFav;
    }
    $newFavsJSON = json_encode($favsArray); echo "<script>console.log('$newFavsJSON')</script>";
    $conn->query("UPDATE users SET favs = '$newFavsJSON' WHERE id = '$loginus'");
    echo "<script>alert('добавлен в избранное!');window.location.href='mainpage.php'</script>";
    exit();
}
?>
</body>
</html>