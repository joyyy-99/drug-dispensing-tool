<?php
require_once'connect.php';

$name = $_POST['name'];
$expiration = $_POST['expiration'];
$price = $_POST['price'];


$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO drugs (Tradename,Expirationdate,Price)
VALUES ('$name','$expiration','$price')";
if ($conn->query($sql)=== TRUE){
    echo "Registration Successful!";
}else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$conn->close();
?>

