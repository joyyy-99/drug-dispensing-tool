<?php
require_once'connect.php';

$name = $_POST['name'];
$expiration = $_POST['expiration'];
$price = $_POST['price'];
$category = $_POST['category'];
$imageData = file_get_contents($_FILES["image"]["tmp_name"]);


$conn = new mysqli($servername,$username,$password,$dbname);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO drugs (Tradename,Expirationdate,Price,Category,image_data)VALUES (?,?,?,?,?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ssdss",$name,$expiration,$price,$category,$imageData);

if ($stmt->execute()){
    echo "Registration Successful!";
}else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
$stmt->close();
$conn->close();
?>

