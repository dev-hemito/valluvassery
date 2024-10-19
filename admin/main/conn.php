<?php

$conn = mysqli_connect('localhost', 'root' ,'' , 'valluvasserybuilders');
  
  // Check if connection succeeded
  if(!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  ?>
  