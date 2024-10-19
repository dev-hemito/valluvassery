<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

include('../main/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $projectName = isset($_POST['project-name']) ? htmlspecialchars($_POST['project-name'], ENT_QUOTES, 'UTF-8') : '';

    $uploadDir = '../images/';

    // Get the file details
    $files = $_FILES['image']; // $_FILES['image'] is now an array

    // Loop through each uploaded file
    foreach ($files['name'] as $key => $fileName) {
        $fileTmpName = $files['tmp_name'][$key];

        // Generate a unique file name based on current time and original file name
        $uniqueFileName = time() . '_' . $fileName;

        // Construct the target file path
        $targetFilePath = $uploadDir . $uniqueFileName;

        // Upload the file to the target path
        if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            // Insert project data into the database for each file
            $sql = "INSERT INTO plan (img, project) VALUES ('$uniqueFileName', '$projectName')";

            if (mysqli_query($conn, $sql)) {
                // Successfully uploaded and inserted into the database
                // You can choose to do additional processing or display a success message here
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file: $fileName<br>";
        }
    }

    // Redirect to the gallery page after all uploads are processed
    header("location: ../floor-plan.php");
}


?>

