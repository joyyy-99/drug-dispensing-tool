<?php
    require_once'connect.php';

    // Get image data from the uploaded file
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
    $imageName = $_FILES["image"]["name"];

    // Prepare and execute the SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO images (image_name, image_data) VALUES (?, ?)");
    $stmt->bind_param("sb", $imageName, $imageData);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

?>
