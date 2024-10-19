<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include('../main/conn.php');

$errors = [];  // Array to store error messages
$successMessage = '';  // Success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure a project is selected
    if (!isset($_POST['project-name']) || empty(trim($_POST['project-name']))) {
        $errors[] = "Please select a project.";
    } else {
        $projectName = htmlspecialchars($_POST['project-name'], ENT_QUOTES, 'UTF-8');
    }

    $uploadDir = '../images/';
    $allowedTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
    $files = $_FILES['image']; // Multiple files array

    if (empty($errors)) {
        $successCount = 0;
        foreach ($files['name'] as $key => $fileName) {
            // Check if file was uploaded without error
            if ($files['error'][$key] !== UPLOAD_ERR_OK) {
                $errors[] = "Error uploading file: $fileName. Error Code: " . $files['error'][$key];
                continue;
            }

            $fileTmpName = $files['tmp_name'][$key];
            $fileType = mime_content_type($fileTmpName);

            // Validate file type
            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = "Invalid file type for $fileName. Only PNG, JPEG, GIF, and WEBP files are allowed.";
                continue;
            }

            // Sanitize and generate a unique file name
            $fileName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', basename($fileName));
            $uniqueFileName = time() . '_' . $fileName;

            // Construct the target file path
            $targetFilePath = $uploadDir . $uniqueFileName;

            // Upload the file
            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                // Insert project data into the database for each file
                $sql = "INSERT INTO gallery (img, project) VALUES ('$uniqueFileName', '$projectName')";

                if (mysqli_query($conn, $sql)) {
                    $successCount++;
                } else {
                    $errors[] = "Database error for $fileName: " . mysqli_error($conn);
                }
            } else {
                $errors[] = "Error moving uploaded file: $fileName.";
            }
        }

        // Set success message
        if ($successCount > 0) {
            $successMessage = "$successCount files uploaded successfully.";
        }
    }
}

// Fetch project names for the dropdown
$projectQuery = "SELECT id, name FROM project";
$projectResult = mysqli_query($conn, $projectQuery);
$projects = mysqli_fetch_all($projectResult, MYSQLI_ASSOC);

?>

<!-- Echo the errors and success messages within the same page -->
<?php if (!empty($errors)) { ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
<?php } ?>

<?php if (!empty($successMessage)) { ?>
    <div class="alert alert-success">
        <p><?php echo $successMessage; ?></p>
    </div>
<?php } ?>

<form method="POST" enctype="multipart/form-data" action="">
    <select name="project-name" required>
        <option value="" disabled selected>Select a project</option>
        <?php foreach ($projects as $project) { ?>
            <option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
        <?php } ?>
    </select>

    <div class="img-upload position-relative">
        <div id="imagePreview" class="image-preview"></div>
        <h5 class="choose-img">Click to choose Thumb Image</h5>
        <input type="file" name="image[]" multiple accept="image/png, image/gif, image/jpeg, image/webp, image/*" id="imageFile" required>
    </div>
    <br>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
