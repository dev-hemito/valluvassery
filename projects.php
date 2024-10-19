<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('links.php'); ?>
</head>

<body id="bg">
	<?php include('header.php'); ?>
	<?php include('admin/main/conn.php'); ?>

	<div class="page-content bg-white">


		<div class="dz-bnr-inr style-1 overlay-white-dark" style="background-image: url(images/banner/bnr5.jpg);">
			<div class="container">
				<div class="dz-bnr-inr-entry">
					<h1>OUR Projects</h1>
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
		<section class="content-inner-2 line-img pb-1 section-title style-1" data-name="Portfolio">
			<div class="container">
				<div class="row align-items-center section-head-bx">
					<div class="col-md-8">
						<div class="section-head style-1">
							<h2 class="title">SEE OUR <span class="text-primary">LATEST WORK</span></h2>
							<div class="dz-separator style-1 text-primary"></div>
						</div>
					</div>

				</div>
			</div>
			<div class="container project-tab-buttons text-center mb-4">
				<button data-target="completed" class="active">Completed</button>
				<button data-target="ongoing">Ongoing</button>
			</div>
			<div class="container project-tab" id="completed">

				<div class="row">
					<?php
					$query = "SELECT * FROM project WHERE project_type IS NULL ORDER BY id DESC";

					$result = mysqli_query($conn, $query);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$id = $row['id'];
							$projectName = $row['name'];
							$type = $row['type'];
							$uniqueFileName = $row['image'];
							$specification = $row['specification'];
							$imagePath = 'admin/images/' . $uniqueFileName;
					?>

							<div class="col-md-6 col-lg-4 mb-3">
								<div class="dz-box  overlay style-1">
									<div class="dz-media">
										<img src="<?php echo $imagePath ?>" alt="">
									</div>
									<div class="dz-info">
										<a href="our-projects.php?id=<?php echo $id ?>&project=<?php echo $projectName ?>" class="view-btn lightimg" title="<?php echo $projectName ?>"></a>
										<h6 class="sub-title"><?php echo $type ?></h6>
										<h4 class="title text-white m-b15"><?php echo $projectName ?></h4>
									</div>
								</div>
							</div>


					<?php
						}
					} else {
						echo "No projects to show";
					}
					?>


				</div>
			</div>
			

			<div class="container project-tab" id="ongoing">
				
			<div class="row">
					<?php
					$query = "SELECT * FROM project WHERE project_type = 'ongoing' ORDER BY id DESC";
					$result = mysqli_query($conn, $query);

					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$id = $row['id'];
							$projectName = $row['name'];
							$type = $row['type'];
							$uniqueFileName = $row['image'];
							$specification = $row['specification'];
							$imagePath = 'admin/images/' . $uniqueFileName;
					?>

							<div class="col-md-6 col-lg-4 mb-3">
								<div class="dz-box  overlay style-1">
									<div class="dz-media">
										<img src="<?php echo $imagePath ?>" alt="">
									</div>
									<div class="dz-info">
										<a href="our-projects.php?id=<?php echo $id ?>&project=<?php echo $projectName ?>" class="view-btn lightimg" title="<?php echo $projectName ?>"></a>
										<h6 class="sub-title"><?php echo $type ?></h6>
										<h4 class="title text-white m-b15"><?php echo $projectName ?></h4>
									</div>
								</div>
							</div>


					<?php
						}
					} else {
						echo "No projects to show";
					}
					?>


				</div>
			</div>
		</section>





		<?php include('contact-form.php'); ?>

	</div>

	<?php include('footer.php'); ?>

	</div>


	<?php include('scripts.php'); ?>

	<script>
    $(document).ready(function() {
        // Show default tab content
        $('#completed').show();

        // Tab click event
        $('button[data-target]').on('click', function(e) {
            e.preventDefault();

            $('button[data-target]').removeClass('active');
            $('.project-tab').hide();

            // Show the selected tab content
            var target = $(this).data('target');
            $('#' + target).show();

			$(this).addClass('active');
        });
    });
</script>

</body>

</html>