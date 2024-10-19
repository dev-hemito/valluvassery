<?php session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}


include('main/conn.php');



?>



<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="main/style.css">


</head>




<body>

    <div class="row">
        <div class="col-3">
            <?php include('main/menu.php'); ?>
        </div>
        <div class="col-9">



            <section>
                <div class="container">
                    <div class="col-lg-8 mx-auto login-form bg-light p-3 m-3 mt-5 rounded">
                        <h3>New Project</h3>

                        <?php
                        // Include your database connection and other necessary files here

                        // Check if an 'id' parameter is provided in the URL
                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                            $project_id = $_GET['id'];

                            // Query to fetch project data based on the project_id
                            $query = "SELECT * FROM project WHERE id = $project_id";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) === 1) {
                                $row = mysqli_fetch_assoc($result);

                                // Assign fetched data to variables
                                $projectName = $row['name'];
                                $projectType = $row['type'];
                                $details = $row['details'];
                                $amenities = $row['amenities'];
                                $location = $row['location'];
                                $specification = $row['specification'];
                                // You may need to adjust the image path based on your folder structure
                                $imagePath = 'images/' . $row['image'];
                            } else {
                                // Handle the case where the project with the given ID doesn't exist
                                echo "Project not found.";
                            }
                        } else {
                            // Handle the case where 'id' parameter is not provided or is not numeric
                            echo "Invalid project ID.";
                        }
                        ?>

                        <form method="POST" enctype="multipart/form-data" action="project/update.php">
                            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                            <input type="text" placeholder="Project Name" name="project-name" value="<?php echo $projectName; ?>">
                            <div class="img-upload position-relative">
                                <div id="imagePreview" class="image-preview">
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $projectName; ?>">
                                </div>
                                <h5 class="choose-img">Click to choose Thumb Image</h5>
                                <input type="file" name="image" id="imageFile" accept="image/png, image/gif, image/jpeg, image/webp, image/*">
                            </div>
                            <br>

                            <input type="text" placeholder="type" name="type" value="<?php echo $projectType; ?>">
                            
                            <label for="" class="mt-3">Specifications</label>
                                <textarea name="specification" id="" cols="20" rows="5"><?php echo $specification; ?></textarea>

                                <label for="" class="mt-3">Details</label>
                                <textarea name="details" id="" cols="20" rows="5"><?php echo $details; ?></textarea>

                            <button type="submit">Update</button>
                        </form>

                


                    </div>

                </div>
            </section>

        </div>
    </div>


    <script src="main/script.js"></script>


</body>

</html>