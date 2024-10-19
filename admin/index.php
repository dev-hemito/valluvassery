<?php

// Start the session
session_start();

// Check if user is already logged in, redirect to admin panel if true
if(isset($_SESSION['user_id'])) {
  header('Location: projects.php');
  exit();
}

// If form submitted, check login credentials
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Connect to the database
include('main/conn.php');
  
  // Sanitize input fields
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  
  // Query database for user with given username and password
  $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);
  
  // Check if query succeeded and a row was returned
  if(mysqli_num_rows($result) == 1) {
    
    // Get user ID from row and set session variable
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    
    // Redirect to admin panel
    $_SESSION["login_time_stamp"] = time(); 
    header('Location: projects.php');
    exit();
    
  } else {
    
    // Display error message
    $error = 'Invalid username or password';
    
  }
  
  // Close database connection
  mysqli_close($conn);
  
}

?>



<!-- HTML code for login page -->
<html>
  <head>
    <title>Login to Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="main/style.css">

  </head>




  <body>

  <div class="col-lg-6 mx-auto login-form bg-light p-3 m-3 mt-5 rounded">
    <h3>Login</h3>
    
    <form method="POST" target="iframe">
      <input type="text" name="username" id="username" required placeholder="Username">
      <br>
      <input type="password" name="password" id="password" required placeholder="Password">
      <br>
      <button type="submit">Login</button>
    </form>
    <?php if(isset($error)) { ?>
      <p class="red"><?php echo $error; ?></p>
    <?php } ?>

    </div>


  </body>
</html>





