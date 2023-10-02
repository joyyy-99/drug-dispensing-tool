<!DOCTYPE html>
<html>
    <head>
        <title>Prescription</title>
    </head>

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

</body>
</html>