<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>magaz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
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
<main>
    <div class="wrapper">
        <img src="../img/Herobanner.svg" height="643" width="1440" alt="">
    </div>
    <form class="wrapper toys" style="display: flex; gap: 200px; margin-left: 20px;" method="post" action="">
    <?php
        session_start();

        $conn = new mysqli('localhost', 'root', '', 'maga');
        if ($conn->connect_error) {
            die('Error' . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM Products");

        while ($row = $result->fetch_assoc()) {
            $toy_id = $row['toy_id'];
            $toy_name = $row['toy_name'];
            $toy_price = $row['toy_price'];
            $count = $row['count'];
            $img = $row['img'];

            echo "<div class='toyblock' style='display: flex; flex-direction: column; align-items: center;'>
            <img src='$img' width='320' height='269' alt=''>
            <div class='texttoyblock' style='gap: 185px; font-size: 20px;'>
                <p class='text1' name='toyname'>$toy_name</p>
                <p class='text2'>$toy_price rub</p>
            </div>
            <div class='buttonblock' style='gap: 162px; font-size: 20px;'>
                <p name='count'>$count pc.</p>
            <button class='buttontoys' type='submit' name='addToCart' value='$toy_id'>add to cart</button>
                </div>
        </div>";
        }
        ?>
    </form>
</main>
<footer class="wrapper"></footer>
</body>
</html>
