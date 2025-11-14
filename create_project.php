<?php
include 'projects.php'; // Make sure this file connects to your database

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_finished = $_POST['date_finished'];

    // === IMAGE UPLOAD ===
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    // Create unique filename to avoid duplicates
    $newImageName = time() . "_" . basename($imageName);

    // Correct upload folder
    $uploadPath = "uploads/" . $newImageName;

    // Move file to uploads folder
    if (move_uploaded_file($imageTmp, $uploadPath)) {

        // Save to database
        $sql = "INSERT INTO projects (title, description, date_finished, image)
                VALUES ('$title', '$description', '$date_finished', '$newImageName')";

        if ($conn->query($sql)) {
            echo "Project uploaded successfully!";
        } else {
            echo "Database Error: " . $conn->error;
        }

    } else {
        echo "Image upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>

<h2>Create a New Project</h2>

<form action="create_project.php" method="POST" enctype="multipart/form-data">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="date_finished">Finish Date:</label><br>
    <input type="date" id="date_finished" name="date_finished" required><br><br>

    <label for="image">Image:</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>

    <input type="submit" value="Create Project">
</form>

<br>

<!-- ✅ View Projects Button -->
<form action="view_project.php" method="get">
    <button type="submit">View Projects</button>
</form>

</body>
</html>
