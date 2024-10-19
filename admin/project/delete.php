<?php session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}


include('../main/conn.php');

$id = $_GET['id'];
$img = $_GET['img'];

$sql = "DELETE FROM portfolio WHERE id = $id";



// Include your database connection and other necessary files here

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['image']) && is_numeric($_GET['id'])) {
    $project_id = $_GET['id'];
    $imageFilename = $_GET['image'];

    // Construct the full image path
    $uploadDir = 'images/';
    $imagePath = $uploadDir . $imageFilename;

    // Unlink (delete) the image file from the server
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            // Image successfully deleted from the server
        } else {
            echo "Error deleting image from the server.";
        }
    } else {
        echo "Image not found on the server.";
    }

    // Execute a DELETE query to remove the project from the database
    $deleteQuery = "DELETE FROM project WHERE id = $project_id";

    if (mysqli_query($conn, $deleteQuery)) {
        // Project deleted successfully
        header("Location: ../project-list.php"); // Redirect to the projects list page or any other desired page
        exit();
    } else {
        // Handle database error
        echo "Error deleting project: " . mysqli_error($conn);
    }
} else {
    // Handle invalid parameters
    echo "Invalid request.";
}


?>




