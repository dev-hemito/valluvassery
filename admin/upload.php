<?php session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}



// if (isset($_SESSION["user_id"])) {
//     if ((time() - $_SESSION["login_time_stamp"]) > 3600) {
//         session_unset();
//         session_destroy();
//         header("Location:index.php");
//     }
// }


include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $heading = $_POST['heading'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // if (isset($_POST['Sortorder'])) {
    // $Sortorder = $_POST['Sortorder'];
    // } else{
    //     $Sortorder = 0;
    // }

    $uploadDir = 'images/';

    // Get the file details
    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Generate a unique file name based on current time
    $uniqueFileName = time() . '_' . $fileName;

    // Construct the target file path
    $targetFilePath = $uploadDir . $uniqueFileName;

    // Upload the file to the target path
    move_uploaded_file($fileTmpName, $targetFilePath);


    $checkbox = $_POST['page'];
    $chk=""; 

    foreach($checkbox as $chk1)  
   {  
      $chk .= $chk1.",";  
   } 

   echo $chk;



    $sql = "INSERT INTO blog (heading, content, image, date, status,page) VALUES ('$heading', '$content','$targetFilePath', '$date','$status','$chk' )";


    if (mysqli_query($conn, $sql)) {
        $success = "New Blog added successfully";
        header("location: admin_panel.php");
    } else {
        $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
};

?>

