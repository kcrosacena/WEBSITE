<?php
include "projects.php"; // your database connection

$title = $_POST['title'];
$description = $_POST['description'];
$date_finished = $_POST['date_finished'];

$imageName = $_FILES['image']['name'];
$tempPath = $_FILES['image']['tmp_name'];

$uploadDir = "uploads/";

// Make sure folder exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$finalPath = $uploadDir . basename($imageName);

move_uploaded_file($tempPath, $finalPath);

$sql = "INSERT INTO projects (title, description, date_finished, image)
        VALUES ('$title', '$description', '$date_finished', '$imageName')";

mysqli_query($conn, $sql);

header("Location: view_project.php");
exit();
?>
