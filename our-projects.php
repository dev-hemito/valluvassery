<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('links.php'); ?>
</head>

<body id="bg">
    <?php include('header.php'); ?>

    <?php

    include('admin/main/conn.php');

    // Check if an 'id' parameter is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $project_id = $_GET['id'];

        // Query to fetch project data based on the project_id
        $query = "SELECT * FROM project WHERE id = $project_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Assign fetched data to variables
            $details = $row['details'];
            $projectName = $row['name'];
            $specification = $row['specification'];

            // You may need to adjust the image path based on your folder structure
            $imagePath = 'admin/images/' . $row['image'];
        } else {
            // Handle the case where the project with the given ID doesn't exist
            echo "Project not found.";
        }
    } else {
        // Handle the case where 'id' parameter is not provided or is not numeric
        echo "Invalid project ID.";
    }
    ?>



    <div class="page-content bg-white">


        <div class="dz-bnr-inr style-1 overlay-white-dark" style="background-image: url(images/banner/bnr5.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1><?php echo  $projectName ?></h1>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Projects</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
        </div>

        <!-- Our Portfolio -->
        <section class="content-inner-2 line-img pt-0 pb-5 section-title style-1">
            <div class="container pr-spec-bg mb-5">
                <div class="row">
                    <div class="col-md-7">
                        <p class="pr-spec text-justify"><?php echo html_entity_decode($specification); ?>
                        </p>
                    </div>
                    <div class="col-md-5">
                        <div class="project-details-box">
                            <?php echo htmlspecialchars_decode($details); ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container">

                <?php
                if ($project_id == 7) {
                    $directory = 'admin/images/vypin/';
                    $images = glob($directory . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE); // Get all image files from the directory

                    if ($images) {
                        echo '<div class="gallery-items row our-project-gallery align-items-center section-head-bx lightgallery">';

                        foreach ($images as $imageFileName) {
                            // Extract the file name from the full path
                            $imageFileName = basename($imageFileName);

                            echo '<div class="dz-box style-1 col-lg-4 col-md-6">';
                            echo '<div class="dz-media">';
                            echo '<img src="' . $directory . $imageFileName . '" alt="">'; // Display the image
                            echo '</div>';
                            echo '<div class="dz-info">';
                            echo '<span data-exthumbimage="' . $directory . $imageFileName . '" data-src="' . $directory . $imageFileName . '" class="view-btn lightimg" title="Image Title"></span>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>'; // Close the gallery-items div
                    } else {
                        echo '<p>No images found for this project.</p>'; // Handle case where no images are found
                    }
                }
                ?>

<?php
                if ($project_id == 8) {
                    $directory = 'admin/images/studio-jaaqDLF/';
                    $images = glob($directory . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE); // Get all image files from the directory

                    if ($images) {
                        echo '<div class="gallery-items row our-project-gallery align-items-center section-head-bx lightgallery">';

                        foreach ($images as $imageFileName) {
                            // Extract the file name from the full path
                            $imageFileName = basename($imageFileName);

                            echo '<div class="dz-box style-1 col-lg-4 col-md-6">';
                            echo '<div class="dz-media">';
                            echo '<img src="' . $directory . $imageFileName . '" alt="">'; // Display the image
                            echo '</div>';
                            echo '<div class="dz-info">';
                            echo '<span data-exthumbimage="' . $directory . $imageFileName . '" data-src="' . $directory . $imageFileName . '" class="view-btn lightimg" title="Image Title"></span>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>'; // Close the gallery-items div
                    } else {
                        echo '<p>No images found for this project.</p>'; // Handle case where no images are found
                    }
                }
                ?>


                <?php

                $imagesPerPage = 9;

                // Check if project ID is provided and is numeric
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $project_id = $_GET['id'];

                    // Get the current page number from the URL parameter
                    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

                    // Calculate the offset for the SQL query based on the current page
                    $offset = ($currentPage - 1) * $imagesPerPage;

                    // Fetch gallery items for the specified project with pagination
                    $sql = "SELECT img FROM gallery WHERE project = $project_id LIMIT $offset, $imagesPerPage";
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any gallery items
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="gallery-items row our-project-gallery align-items-center section-head-bx lightgallery">';

                        // Loop through each gallery item
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imageFileName = $row['img'];

                            // Display the gallery item in the specified format
                            echo '<div class="dz-box style-1 col-lg-4 col-md-6">';
                            echo '<div class="dz-media">';
                            echo '<img src="admin/images/' . $imageFileName . '" alt="">';
                            echo '</div>';
                            echo '<div class="dz-info">';
                            echo '<span data-exthumbimage="admin/images/' . $imageFileName . '" data-src="admin/images/' . $imageFileName . '" class="view-btn lightimg" title="Image Title"></span>';
                            echo '</div>';
                            echo '</div>';
                        }

                        echo '</div>';

                        // Display pagination controls
                        $totalImagesQuery = "SELECT COUNT(*) as total FROM gallery WHERE project = $project_id";
                        $totalImagesResult = mysqli_query($conn, $totalImagesQuery);
                        $totalImages = mysqli_fetch_assoc($totalImagesResult)['total'];
                        $totalPages = ceil($totalImages / $imagesPerPage);

                        echo '<div class="col-md-12 text-center mt-4">';
                        echo '<ul class="pagination justify-content-center">';
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="?id=' . $project_id . '&page=' . $i . '">' . $i . '</a></li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    } else {
                    }
                } else {
                    echo 'Invalid project ID.';
                }
                ?>

            </div>
        </section>



    </div>

    <?php include('footer.php'); ?>

    </div>


    <?php include('scripts.php'); ?>

</body>

</html>