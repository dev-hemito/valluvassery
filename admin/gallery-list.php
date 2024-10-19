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
            <h3>Gallery List</h3>

            <div class="row">
                <?php
                $query = "SELECT g.id, g.img, g.project, p.name AS project_name FROM gallery g INNER JOIN project p ON g.project = p.id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $imgName = $row['img'];
                        $projectName = $row['project_name'];

                        // You can customize the image path based on your folder structure
                        $imagePath = 'images/' . $imgName;
                ?>
                        <div class="col-md-6">
                            <div class="project bg-white mb-4 p-2">
                                <img class="h-300" src="<?php echo $imagePath; ?>" alt="<?php echo $projectName; ?>">
                                <div class="content">
                                    <h5 class="mb-2"><?php echo $projectName; ?></h5>
                                    <a href="gallery/delete.php?id=<?php echo $id; ?>&image=<?php echo $imgName; ?>"  onclick="return confirmDelete();" class="bg-danger text-white p-1">Delete</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "No projects found.";
                }
                ?>
            </div>
        </div>
    </div>
</section>


        </div>
    </div>


    <script src="main/script.js"></script>


</body>

</html>