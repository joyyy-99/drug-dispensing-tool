<?php
$servername = "localhost";
$username =  "root";
$password = "";
$dbname = "Drug_dispensing_tool";

//Create connection
$conn = new mysqli ($servername, $username, $password,$dbname);


//Check connection
if ($conn->connect_error){
    die ("Connection failed: " .$conn->connect_error);
}
/*echo "Connected successfully";
echo '<br>';

Create database
$sql = "CREATE DATABASE Drug_dispensing_tool";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
*/

?>
