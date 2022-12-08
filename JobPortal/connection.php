<?php
  $localhost = "localhost";
  $user = "root";
  $pass = "";
  $database = "HR1";
  
  //Connecting a database//
  $con = mysqli_connect($localhost, $user, $pass, $database);
  
  //Check if connected//
  if (!$con) {
    echo "Failed to Connect to database";
    die();
  }
  else{
    echo "Successfully connected to database!";
  }