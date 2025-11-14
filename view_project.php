<?php
include 'projects.php'; // Database connection

// ✅ Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // sanitize
    $conn->query("DELETE FROM projects WHERE id = $id");
    header("Location: view_projects.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Projects</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>

<h2>All Projects</h2>

<!-- 🏠 Home, ⬅ Back to Form Buttons -->
<div class="top-buttons">
    <a href="../WEBSITE/home.php"><button>🏠 Home</button></a>
    <a href="create_project.php"><button>⬅ Back to Form</button></a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date Finished</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php
    // ✅ Fetch all projects
    $sql = "SELECT * FROM projects ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date_finished']) . "</td>";
        
            // Show image preview if file exists
            $imgPath = !empty($row['image']) ? 'uploads/' . $row['image'] : 'uploads.jpg';
            echo "<td><img src='$imgPath' alt='' width='100'></td>";

             // 🗑️ DELETE BUTTON with confirmation and dynamic ID
        echo "<td>
                <a href=\"view_projects.php?delete={$row['id']}\" 
                   onclick=\"return confirm('Are you sure you want to delete this project?');\">
                   Delete
                </a>
              </td>";

        echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No projects found.</td></tr>";
    }
    ?>
</table>

</body>
</html>