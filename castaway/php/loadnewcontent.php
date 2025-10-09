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
<div style="display: flex; margin-top: 100px">
    <div class="wrapper upl" id="upload">
        <div class="form-frstcontainer">
            <div class="upl-bigh">Upload your new podcast</div>
        </div>
        <form class="upl-scndcontainer" method="post" action="" enctype="multipart/form-data">
            <div class="upl-div">
                <label><input class="upl-scndcontainer-input" placeholder="Podcast name" type="text" name="podcastname"></label>
                <label><select class="upl-scndcontainer-input" name="tagselect">
                        <option>music</option>
                        <option>talks</option>
                    </select>
                </label>
            </div>
            <div>
                <label><textarea class="upl-scndcontainer-textarea" placeholder="Description" name="description"></textarea></label>
            </div>
            <div class="upl-div">
                <label>
                    <p class="upl-smallh">Audio file</p>
                    <input class="upl-scndcontainer-file" type="file" id="myfile" name="upl-audio" accept="audio/*">
                </label>
                <label>
                    <p class="upl-smallh">Upload Cover</p>
                    <input class="upl-scndcontainer-file" type="file" id="myfile" name="upl-image" accept="image/*">
                </label>
            </div>
            <div class="">
                <button class="upl-scndcontainer-button">Upload</button>
            </div>
        </form>
    </div>
</div>
<div class="wrapper upl-div">
    <a class="goback" href="../php/mainpage.php">go back</a>
</div>
<?php
require 'link.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $podcastName = $_POST['podcastname'];
    $tag = $_POST['tagselect'];
    $description = $_POST['description'];

    $audioTargetDir = "../aud/";
    $imageTargetDir = "../img/pdcsts/";

    $audioTargetFile = $audioTargetDir . basename($_FILES["upl-audio"]["name"]);
    $imageTargetFile = "";

    if (move_uploaded_file($_FILES["upl-audio"]["tmp_name"], $audioTargetFile)) {
        echo "The audio file has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your audio file.";
    }

    if (!empty($_FILES["upl-image"]["name"])) {
        $imageTargetFile = $imageTargetDir . basename($_FILES["upl-image"]["name"]);
        if (move_uploaded_file($_FILES["upl-image"]["tmp_name"], $imageTargetFile)) {
            echo "The image file has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your image file.";
        }
    }

    $sql = "INSERT INTO content (id, name, img, description, file, tag) VALUES (NULL, '$podcastName', '$imageTargetFile', '$description', '$audioTargetFile', '$tag')";

    if ($conn->query($sql) === TRUE) {
        echo "New podcast created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
</body>
</html>