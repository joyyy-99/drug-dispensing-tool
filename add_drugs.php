<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Drug_dispensing_tool";

// Create connection
$conn = new mysqli ($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// sql to  create table
$sql = "CREATE TABLE drugs (
    Tradename VARCHAR(30) PRIMARY KEY,
    Expirationdate VARCHAR (30),
    Price INT (20)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table drugs created successfully";
    echo '<br>';
} else {
    echo "Error creating table: " .$conn->error;
}
//sql to insert data into tables
$sql = "INSERT INTO drugs (Tradename, Expirationdate, Price)
VALUES ('Piriton', '05-12-2023', 2100)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
