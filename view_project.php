<?php
include 'projects.php'; // Database connection

// ✅ Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // sanitize input
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

<!-- 🏠 Home, ⬅ Back to Form -->
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
// Fetch all projects
$sql = "SELECT * FROM projects ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['title']); ?></td>
        <td><?= htmlspecialchars($row['description']); ?></td>
        <td><?= htmlspecialchars($row['date_finished']); ?></td>

        <!-- ✅ FIXED IMAGE CODE -->
        <td>
            <img src="uploads/<?= htmlspecialchars($row['image']); ?>"
                 style="width:120px;height:120px;border:2px solid cyan;">
        </td>

        <!-- 🗑️ Delete link -->
        <td>
            <a href="view_projects.php?delete=<?= $row['id']; ?>"
               class="delete-link"
               onclick="return confirm('Are you sure you want to delete this project?');">
               Delete
            </a>
        </td>
    </tr>

<?php
    }
} else {
    echo "<tr><td colspan='6'>No projects found.</td></tr>";
}
?>

</table>

</body>
</html>
