<?php
$link = mysqli_connect('localhost', 'root', '', 'podcasts');
if (!$link) die('error');
$conn = new mysqli('localhost', 'root', '', 'podcasts');
if ($conn->connect_error){
    die('Error' . $conn->connect_error);
}

