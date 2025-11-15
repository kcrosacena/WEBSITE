<?php
include 'projects.php';

// Fetch all projects
$sql = "SELECT * FROM projects ORDER BY id DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Database query error: " . htmlspecialchars($conn->error));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Projects</title>

    <!-- Separate CSS file -->
    <link rel="stylesheet" href="view_project.css">
</head>
<body>

<h2>All Projects</h2>

<div class="top-buttons">
    <a href="../WEBSITE/home.php"><button>🏠 Home</button></a>
    <a href="create_project.php"><button>⬅ Back to Form</button></a>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date Finished</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    <?php
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $id = (int)$row['id'];
            $title = htmlspecialchars($row['title']);
            $description = htmlspecialchars($row['description']);
            $date_finished = htmlspecialchars($row['date_finished']);
            $imageFilename = htmlspecialchars($row['image']);

            // Build image path
            $imagePath = "..//upload.php/project image" . $imageFilename;
            if (empty($imageFilename) || !file_exists($imagePath)) {
                $imagePath = "uploads/placeholder.png";
            }

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$description}</td>";
            echo "<td>{$date_finished}</td>";
            echo "<td><img class='project-thumb' src='{$imagePath}'></td>";
            echo "<td><a href='delete_project.php?delete={$id}' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
        }

    } else {
        echo "<tr><td colspan='6'>No projects found.</td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
