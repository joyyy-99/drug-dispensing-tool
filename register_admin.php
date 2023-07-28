<?php
require_once'connect.php';

$usernames = $_POST['username'];
$passwords = $_POST['password'];

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO admins (Username,Passwords)
VALUES ('$username','$passwords')";
if ($conn->query($sql)=== TRUE){
    echo "Registration Successful!";
}else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>
