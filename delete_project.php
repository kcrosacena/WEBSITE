<?php
include 'db_connect.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // 1. Get image filename from database
    $imgQuery = $conn->prepare("SELECT image FROM projects WHERE id = ?");
    $imgQuery->bind_param("i", $id);
    $imgQuery->execute();
    $imgQuery->store_result();
    $imgQuery->bind_result($image);
    $imgQuery->fetch();
    $imgQuery->close();

    // 2. Delete image file if it exists
    $imagePath = "uploads/" . $image;

    if (!empty($image) && file_exists($imagePath)) {
        unlink($imagePath);  // delete file
    }

    // 3. Delete record from database
    $delete = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $delete->bind_param("i", $id);
    $delete->execute();
    $delete->close();

    // 4. Redirect
    header("Location: view_project.php");
    exit();
}
?>
