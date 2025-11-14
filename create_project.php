<?php
include 'projects.php'; // Make sure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_finished = $_POST['date_finished'];

    // Store only image file name
    $image = $_FILES['image']['name'];

    // Insert into database
    $sql = "INSERT INTO projects (title, description, date_finished, image)
            VALUES ('$title', '$description', '$date_finished', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>✅ Project added successfully!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $conn->error . "</p>";
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
