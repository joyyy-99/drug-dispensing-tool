<?php
require_once'connect.php';

$name = $_POST['name'];
$address = $_POST['address'];
$phonenumber = $_POST['phonenumber'];
$usernames = $_POST['username'];
$passwords = $_POST['password'];

$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO companies (NameofCompany,Addressofcompany,Phonenumber,Username,Passwords)
VALUES ('$name','$address','$phonenumber','$usernames','$passwords')";
if ($conn->query($sql)=== TRUE){
    echo "Registration Successful!";
}else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>

