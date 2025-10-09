<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,200&display=swap"
          rel="stylesheet">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<?php
session_name('podcasts');
session_start();
require "link.php";
?>
<script>
    let islogged = localStorage.getItem('islogged') === 'true';
    if (islogged) {
        <?php
        $_SESSION['islogged'] = true;
        ?>
    } else {
        window.location.href = "../index.html";
    }
</script>
<header>
    <div class="wrapper header">
        <img alt="" height="33" src="../img/IMAGElogo.svg" width="160">
        <input class="header-search" name="search" type="text" placeholder="Поиск ..." onkeyup="searchProducts(this.value)">
        <nav class="nav">
            <div class="header-menu">
                <a class="header-menu-text" id="artist" href="loadnewcontent.php">New Podcast</a>
                <a class="header-menu-text" href="mainpage.php">Home</a>
                <a class="header-menu-text" href="isfavorites.php">Favourites</a>
                <a class="header-menu-text" onclick="window.location.href='../index.html';localStorage.clear();<?php session_destroy()?>">Logout</a>
            </div>
        </nav>
        <div class="burger">
            <span></span>
        </div>
    </div>
    <script>
        document.querySelector('.burger').addEventListener('click', function () {
            this.classList.toggle('active');
            document.querySelector('.nav').classList.toggle('open');
        });

        let artist = localStorage.getItem('isartist');
        if (artist === '0'){
            let art = document.querySelector('#artist');
            art.style.display = 'none';
        }

        function searchProducts(query) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?q=' + encodeURIComponent(query), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('contentArea').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</header>
<main class="wrapper scndpart-content" id="contentArea">
    <?php
    $try = $conn->query("SELECT * FROM content");
    while ($row = mysqli_fetch_assoc($try)) {
        echo "<div class='scndpart-content-block'>";
        echo "<div><img class='scndpart-img' alt='' src='" . $row["img"] . "'></div>";
        echo "<div class='scndpart-content-block-mainpart'>";
        echo "<div class='scndpart-content-block-smallrect'>" . $row["tag"] . "</div>";
        echo "<div class='scndpart-content-block-hsmalltext'>Episode " . $row["id"] . "</div>";
        echo "<div class='scndpart-content-block-htext'>" . $row["name"] . "</div>";
        echo "<div class='scndpart-content-block-maintext'>" . $row["description"] . "</div>";
        echo "<div class='scndpart-content-block-button' style='max-width: none; display:flex; gap: 10px'><audio controls src='" . $row["file"] . "'></audio><form action='addfav.php' method='post'><button name='idadd' class='mainpage-addonfav-button'  value='" . $row["id"] . "'>add on favs</button></form></div>";
        echo "</div></div>";
    }
    ?>
</main>
<footer>
    <div class="wrapper footer">
        <div class="footer-frstcont">
            <img alt="" height="46" src="../img/IMAGElogo.svg" width="224">
            <div class="footer-contact">
                <a><img alt="" src="../img/IMAGEinsta.svg"></a>
                <a><img alt="" src="../img/IMAGEtwitter.svg"></a>
                <a><img alt="" src="../img/IMAGEfacebook.svg"></a>
            </div>
        </div>
        <div class="footer-scndcont">
            <div class="footer-scndcont-content">
                <a class="footer-scndcont-text">Home</a>
                <a class="footer-scndcont-text">About</a>
                <a class="footer-scndcont-text">Episodes</a>
                <a class="footer-scndcont-text">Contact</a>
            </div>
            <div class="footer-scndcont-content">
                <a class="footer-scndcont-text">Team</a>
                <a class="footer-scndcont-text">Appearence</a>
                <a class="footer-scndcont-text">Changelog</a>
                <a class="footer-scndcont-text">Credit</a>
                <a class="footer-scndcont-text">Was made by us with :(</a>
                <a class="footer-scndcont-text">Licenses</a>
            </div>
        </div>
        <div>
            <div class="frstpart-social">
                <a style="cursor: pointer"><img alt="" src="../img/IMAGEspoty.svg"></a>
                <a style="cursor: pointer"><img alt="" src="../img/IMAGEbeatl.svg"></a>
                <a style="cursor: pointer"><img alt="" src="../img/IMAGEsoundcloud.svg"></a>
                <a style="cursor: pointer"><img alt="" src="../img/IMAGEapplemus.svg"></a>
                <a style="cursor: pointer"><img alt="" src="../img/IMAGEradio.svg"></a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
