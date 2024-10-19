<?php session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}


include('../main/conn.php');

$id = $_GET['id'];
$img = $_GET['img'];

$sql = "DELETE FROM plan WHERE id = $id";


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['img'])) {
    include('../main/conn.php'); // Include your database connection code

    // Sanitize and validate input
    $id = intval($_GET['id']);
    $image = mysqli_real_escape_string($conn, $_GET['img']);

    // Construct the query to delete the image from the database
    $deleteQuery = "DELETE FROM plan WHERE id = $id AND img = '$image'";

    if (mysqli_query($conn, $deleteQuery)) {
        // Deletion was successful
        // You can also delete the physical image file here if it exists
        $imagePath = '../images/' . $image;
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the physical image file
        }

        header("Location: ../floor-plan-list.php"); 
        exit();
    } else {
        // Deletion failed
        echo "Error deleting image: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>




