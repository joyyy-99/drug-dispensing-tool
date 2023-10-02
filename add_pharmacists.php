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
$sql = "CREATE TABLE pharmacists (
    SSN INT(20) PRIMARY KEY AUTO_INCREMENT,
    Firstname VARCHAR(30) ,
    Lastname VARCHAR(30) ,
    Homeaddress VARCHAR(50),
    Age INT(20),
    Emailaddress VARCHAR (30),
    Phonenumber INT(20),
    Dateofbirth DATE,
    Placeofwork VARCHAR(30),
    Username VARCHAR (30),
    Passwords VARCHAR (30)
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table pharmacists created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
    ?>