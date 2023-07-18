<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Drug_dispensing_tool";

// Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE companies (
    SSN INT(20) PRIMARY KEY AUTO_INCREMENT,
    Nameofcompany VARCHAR(30) ,
    AddressofCompany VARCHAR(50),
    Phonenumber INT(20)
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table companies created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
    ?>