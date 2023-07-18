<?php
session_start();

// Check if the user is logged in as a patient
if (isset($_SESSION['role']) && $_SESSION['role'] === 'patient') {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Display the username at the top right corner
    echo '<div style="position: absolute; top: 10px; right: 10px;">Logged in as: ' . $username . '</div>';
} else {
    // If the user is not logged in as a patient, redirect to the login page
    header('Location: login.html');
    exit();
}

if (isset($_POST['viewProfile'])) {
    // Retrieve the user's registration details from the database and display the form
    require_once "connect.php";

    
    $sql = "SELECT * FROM patients WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display the form with the user's registration details
        echo '<h2>User Profile</h2>';
        echo '<form method="POST" action="update_profile.php">';
        echo '   <p><strong>Firstname:</strong> <input type="text" name="Firstname" value="' . $row['Firstname'] . '"></p>';
        echo '   <p><strong>Lastname:</strong> <input type="text" name="Lastname" value="' . $row['Lastname'] . '"></p>';
        echo '   <p><strong>Username:</strong> ' . $row['Username'] . '</p>';
        echo '   <p><strong>Emailaddress:</strong> <input type="text" name="Emailaddress" value="' . $row['Emailaddress'] . '"></p>';
        echo '   <p><strong>Age:</strong> ' . $row['Age'] . '</p>';
        echo '   <p><strong>Phonenumber:</strong> <input type="text" name="Phonenumber" value="' . $row['Phonenumber'] . '"></p>';
        echo '   <p><strong>Passwords:</strong> ********</p>';
        echo '   <button type="submit" name="saveProfile">Save Profile</button>';
        echo '</form>';
    } else {
        echo "Failed to retrieve user details.";
    }

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Portal</title>
    <header><h1>Welcome to Dawa Drug Dispensing Tool</h1></header>
</head>
<body>
   <div style="position: absolute; top: 40px; right: 10px;">
      <h2>User Profile</h2>
      <form method="POST">
        <button type="submit" name="viewProfile">View Profile</button>
      </form>
   </div>
   
   <ul>
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Prescription</a>
      </li>
      <li>
        <a href="">Appointment</a>
      </li>
      <li>
        <a href="">Billing</a>
      </li>
   </ul>
        
</body>
</html>
