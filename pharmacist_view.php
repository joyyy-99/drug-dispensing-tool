<?php
require_once 'connect.php';
session_start();

// Check if the user is logged in as a pharmacist
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pharmacist') {
    // Get the username from the session
    $username = $_SESSION['username'];

    // Display the username at the top right corner
    echo '<div class="profile-info">';
    echo '<img class="profile-image" src="Images/profile.png" alt="Profile Picture">';
    echo 'Logged in as: ' . $username;
    echo '</div>';

} else {
    // If the user is not logged in as a pharmacist, redirect to the login page
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pharmacist Portal</title>
    <link rel="stylesheet" href="patient_views.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    
</head>
<body>
    <header><h1>Welcome to My Afya Drug Dispensing Tool</h1></header>
    <div class="navbar">
    <ul>
        <li><a href="prescription1.php">Prescription</a></li>
        <li><a href="">Drugs</a>
            <div class = "sub-menu-1">
                <ul>
                    <li><a href="drug.html">Register Drugs</a><li>
                    <li><a href="#">View Drugs</a><li>
                 </ul>
            </div>   
        </li>
        <li><a href="">Sales</a></li>
        <li><a href="">Invoices</a></li>
    </ul>
    <!--
    </div>
    <h2>Prescription List</h2>
    <?php
// Fetch prescription list from the database
require_once 'connect.php';



$query = "SELECT * FROM prescription";
$result = $conn->query($query);

// Check if there are any prescriptions in the database
if ($result->num_rows > 0) {
    // Create an HTML table to display the prescription list
    echo '<table>
            <thead>
              <tr>
                <th>No</th>
                <th>Tradename</th>
                <th>Amount</th>
                <th>Dosage</th>
                <th>Patient SSN</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>';

    // Fetch and display each prescription
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['No'] . '</td>
                <td>' . $row['Tradename'] . '</td>
                <td>' . $row['amount'] . '</td>
                <td>' . $row['Dosage'] . '</td>
                <td>' . $row['Patient SSN'] . '</td>
                <td><a href="view_prescriptions.php?Patient SSN=' . $row['Patient SSN'] . '">View Prescriptions</a></td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo 'No prescriptions found.';
}

$conn->close();
?>

-->
</body>
</html>
 