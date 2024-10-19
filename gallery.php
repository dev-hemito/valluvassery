<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('links.php'); ?>
</head>

<body id="bg">
    <?php include('header.php'); ?>


    <div class="page-content bg-white">


        <div class="dz-bnr-inr style-1 overlay-white-dark" style="background-image: url(images/banner/bnr5.jpg);">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>OUR Gallery</h1>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Gallery</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
        </div>


        <section class="content-inner-2 line-img pb-1 section-title style-1" data-name="Portfolio">
    <div class="container">
        
<div class="row">
            <?php

            include('admin/main/conn.php');

            $projectQuery = "SELECT * FROM project  ORDER BY id DESC";
            $projectResult = mysqli_query($conn, $projectQuery);

            while ($projectRow = mysqli_fetch_assoc($projectResult)) {
                $projectId = $projectRow['id'];
                $projectName = $projectRow['name'];
                $type = $projectRow['type'];
                $projectImage = $projectRow['image'];
                $projectImagePath = 'admin/images/' . $projectImage;
                $projectSpecification = $projectRow['specification'];

                echo '<div class="swiper-container col-lg-4 col-md-6 gallery-items swiper-portfolio row align-items-center section-head-bx lightgallery aos-item" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="400">';

                echo '<div class="dz-box overlay style-1 ">';
                echo '<div class="dz-media">';
                echo '<img src="'.$projectImagePath.'" alt="">';
                echo '</div>';
                echo '<div class="dz-info">';

                // Fetch gallery items for the current project
                $galleryQuery = "SELECT img FROM gallery WHERE project = $projectId";
                $galleryResult = mysqli_query($conn, $galleryQuery);

                // Check if there are any gallery items
                if (mysqli_num_rows($galleryResult) > 0) {
                    // Loop through each gallery item
                    while ($galleryRow = mysqli_fetch_assoc($galleryResult)) {
                        $galleryImageFileName = $galleryRow['img'];
                        $galleryImagePath = 'admin/images/' . $galleryImageFileName;

                        // Display the gallery item in the specified format
                        echo '<span data-exthumbimage="'.$galleryImagePath.'" data-src="'.$galleryImagePath.'" class="view-btn lightimg" title="'.$galleryImagePath.'"></span>';
                    }
                } else {
                    echo 'No gallery items found for the project.';
                }
                
                echo '<h6 class="sub-title">'.$type.'</h6>';
                echo '<h4 class="title m-b15"><a href="#!">'.$projectName.'<span></span></a></h4>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            </div>

        </div>
    </div>
</section>



    </div>

    <?php include('footer.php'); ?>

    </div>


    <?php include('scripts.php'); ?>

</body>

</html>