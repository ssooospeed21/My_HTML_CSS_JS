<?php
require 'link.php';
if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $stmt = $conn->prepare("SELECT * FROM content WHERE name LIKE ?");
    $searchQuery = "%" . $query . "%";
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
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
}
?>
