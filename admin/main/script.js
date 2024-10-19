  
 // Get the input file element and the image preview div
var imageFile = document.getElementById('imageFile');
var imagePreview = document.getElementById('imagePreview');

// Add event listener for input file change
imageFile.addEventListener('change', function(event) {
  imagePreview.innerHTML = ''; // Clear the image preview div

  // Loop through all selected files
  for (var i = 0; i < event.target.files.length; i++) {
    var file = event.target.files[i]; // Get the current selected file

    // Check if the file is an image
    if (file.type.startsWith('image/')) {
      var reader = new FileReader(); // Create a FileReader object

      // Define the onload event handler for the FileReader
      reader.onload = function() {
        var img = document.createElement('img'); // Create an img element
        img.src = reader.result; // Set the src attribute to the data URL
        img.style.width = '100px'; // Set a fixed width of 50px
        img.style.height = 'auto'; // Maintain aspect ratio
        img.style.float = 'left'; // Float the image to the left
        imagePreview.appendChild(img); // Append the img element to the image preview div
      };

      // Read the selected file as data URL
      reader.readAsDataURL(file);
    } else {
      // Display an error message for non-image files
      imagePreview.innerHTML += '<p>Please select an image file.</p>';
    }
  }
});


  document.getElementById('datePicker').valueAsDate = new Date();



    $(".cancel").click(function(){
      $(".delete-btn .confirm").css("display", "none");
    });


    
    $(document).ready(function(){
      $('#sidebar-btn').click(function(){
        $('#sidebar').toggleClass('visible');
      });
  });

  function confirmDelete() {
    // Show a confirmation dialog
    var confirmed = confirm("Are you sure you want to delete this project?");

    // If the user clicked 'OK', proceed with the link's action
    // If the user clicked 'Cancel', prevent the default action
    return confirmed;
}