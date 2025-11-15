<?php
include 'projects.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_finished = $_POST['date_finished'];

    // =============================
    //  IMAGE UPLOAD HANDLING
    // =============================

    $imageName = ""; // default if no image uploaded

    if (!empty($_FILES['image']['name'])) {

        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $fileTmp = $_FILES["image"]["tmp_name"];

        // Get file extension
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ["jpg", "jpeg", "png", "gif", "webp"];

        // Validate extension
        if (!in_array($ext, $allowed)) {
            die("❌ Invalid image type. Allowed: JPG, PNG, GIF, WEBP");
        }

        // Generate unique filename
        $newFilename = uniqid("img_", true) . "." . $ext;
        $targetPath = $targetDir . $newFilename;

        // Ensure uploads/ exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($fileTmp, $targetPath)) {
            $imageName = $newFilename; // save filename in DB
        } else {
            die("❌ Failed to upload image.");
        }
    }

    // =============================
    //  SAVE PROJECT TO DATABASE
    // =============================

    $stmt = $conn->prepare("INSERT INTO projects (title, description, date_finished, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $date_finished, $imageName);

    if ($stmt->execute()) {
        header("Location: view_project.php");
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
