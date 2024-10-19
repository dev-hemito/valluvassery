<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

include('../main/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $projectName = !empty($_POST['project-name']) ? htmlspecialchars($_POST['project-name'], ENT_QUOTES, 'UTF-8') : null;

    $type = !empty($_POST['type']) ? htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8') : null;

    $specification = !empty($_POST['specification']) ? htmlspecialchars($_POST['specification'], ENT_QUOTES, 'UTF-8') : null;


    $details = !empty($_POST['details']) ? htmlspecialchars($_POST['details'], ENT_QUOTES, 'UTF-8') : null;

    
    $uploadDir = '../images/';

    // Get the file details
    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Generate a unique file name based on current time
    $uniqueFileName = time() . '_' . $fileName;

    // Construct the target file path
    $targetFilePath = $uploadDir . $uniqueFileName;

    // Upload the file to the target path
    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        // Insert project data into the database
        $sql = "INSERT INTO project (name, type, details, image, status, specification) VALUES ('$projectName', '$type' ,'$details', '$uniqueFileName', 1, '$specification')";
        
        if (mysqli_query($conn, $sql)) {
            header("location: ../project-list.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $error = "Error uploading the image.";
    }
}

// Handle errors here if needed
?>
