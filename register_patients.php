<?php
require_once'connect.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$homeaddress = $_POST['homeaddress'];
$emailaddress = $_POST['emailaddress'];
$bdate = $_POST['bdate'];
$phonenumber = $_POST['phonenumber'];
$age = $_POST['age'];
$usernames = $_POST['username'];
$passwords = $_POST['password'];

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO patients (Firstname,Lastname,Homeaddress,Age,Emailaddress,Phonenumber,Dateofbirth,Username,Passwords)
VALUES ('$fname','$lname','$homeaddress','$age','$emailaddress','$phonenumber','$bdate','$usernames','$passwords')";
if ($conn->query($sql)=== TRUE){
    echo "Registration Successful!";
}else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?> 