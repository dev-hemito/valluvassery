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

                            <form method="POST" enctype="multipart/form-data" action="project/add.php">

                                <input type="text" placeholder="Project Name" name="project-name">
                                <div class="img-upload position-relative">
                                    <div id="imagePreview" class="image-preview"></div>
                                    <h5 class="choose-img">Click to choose Thumb Image</h5>
                                    <input type="file" name="image" id="imageFile" required placeholder="choose image" accept="image/png, image/gif, image/jpeg, image/webp, image/*">
                                </div>
                                <br>

                                <input type="text" placeholder="type" name="type">


                                <label for="" class="mt-3">Specifications</label>
                                <textarea name="specification" id="" cols="20" rows="5"></textarea>

                                <label for="" class="mt-3">Details</label>
                                <textarea name="details" id="" cols="20" rows="5"></textarea>


                                <button type="submit" id="upload_blog">Submit</button>
                            </form>
                            <?php if (isset($error)) { ?>
                                <p class="red"><?php echo $error; ?></p>
                            <?php } elseif (isset($success)) { ?>
                                <p class="green"><?php echo $success; ?></p>
                            <?php } ?>


                        </div>

                    </div>
                </section>

        </div>
    </div>


    <script src="main/script.js"></script>


</body>

</html>