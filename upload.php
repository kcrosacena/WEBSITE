<?php
if (isset($_POST['submit'])) {
    // Check if the file is an image
    if ($_FILES['project_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['project_image']['tmp_name'];
        $fileName = $_FILES['project_image']['name'];
        $fileSize = $_FILES['project_image']['size'];
        $fileType = $_FILES['project_image']['type'];
        
        // Specify the folder where the image will be uploaded
        $uploadFolder = 'uploads/';
        
        // Ensure the upload folder exists
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0755, true);
        }

        // Create a unique filename to avoid conflicts
        $newFileName = uniqid('project_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $destPath = $uploadFolder . $newFileName;

        // Move the uploaded file to the desired folder
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // File uploaded successfully
            echo "File uploaded successfully!";
            // Save the image path in the database (example: MySQL)
            // Insert your code to store $newFileName in your database here
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "No file uploaded or error with the file.";
    }
}
?>
