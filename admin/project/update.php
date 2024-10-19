<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

include('../main/conn.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'project_id' is provided in the form data
    if (isset($_POST['project_id']) && is_numeric($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        // Get form data and sanitize it
        $projectName = isset($_POST['project-name']) ? htmlspecialchars($_POST['project-name'], ENT_QUOTES, 'UTF-8') : '';
        $type = isset($_POST['type']) ? htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8') : '';

        $elevation = isset($_POST['elevation']) ? htmlspecialchars($_POST['elevation'], ENT_QUOTES, 'UTF-8') : '';
        $amenities = isset($_POST['amenities']) ? htmlspecialchars($_POST['amenities'], ENT_QUOTES, 'UTF-8') : '';
        $location = isset($_POST['location']) ? htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8') : '';
        $specification =  isset($_POST['specification']) ? htmlspecialchars($_POST['specification'], ENT_QUOTES, 'UTF-8') : '';


        $details = !empty($_POST['details']) ? htmlspecialchars($_POST['details'], ENT_QUOTES, 'UTF-8') : null;


        // Check if a new image file is uploaded
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $uploadDir = '../images/';
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];

            // Generate a unique file name based on current time
            $uniqueFileName = time() . '_' . $fileName;

            // Construct the target file path
            $targetFilePath = $uploadDir . $uniqueFileName;

            // Upload the new file
            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                // Remove the old image if necessary (Assuming the image column in the database is named 'image')
                // Get the old image file name from the database for deletion
                $query = "SELECT image FROM project WHERE id = $project_id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $oldImageFileName = $row['image'];

                    // Remove the old image file
                    $oldImagePath = $uploadDir . $oldImageFileName;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Update the image column in the database with the new image path
                $updateImageQuery = "UPDATE project SET image = '$uniqueFileName' WHERE id = $project_id";
                mysqli_query($conn, $updateImageQuery);
            } else {
                echo "Error uploading the new image.";
            }
        }

        // Update other project data in the database (excluding image)
        $updateQuery = "UPDATE project SET 
                        name = '$projectName', 
                        type = '$type', 
                        details = '$details', 
                        amenities = '$amenities', 
                        location = '$location' ,
                        specification = '$specification' 
                        WHERE id = $project_id";

        if (mysqli_query($conn, $updateQuery)) {
            // Redirect back to the edit form or any other appropriate page
            header("Location: ../project-list.php");
        } else {
            echo "Error updating project data: " . mysqli_error($conn);
        }
    } else {
        // Handle the case where 'project_id' is not provided or is not numeric
        echo "Invalid project ID.";
    }
}
