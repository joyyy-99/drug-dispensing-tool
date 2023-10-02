<?php
require_once 'connect.php';


// Check if the patient SSN is provided in the URL
if (isset($_GET['patient_ssn']) && !empty($_GET['patient_ssn'])) {
    $patient_ssn = $_GET['patient_ssn'];

    // Check if the patient exists in the database
    $query = "SELECT * FROM patients WHERE SSN = '$patient_ssn'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 0) {
        // Patient SSN not found in the database
        echo '<h2>Error: Patient not found.</h2>';
    } else {
        // Fetch prescriptions for the specified patient from the database
        $queryPrescriptions = "SELECT * FROM prescription WHERE patient_ssn = '$patient_ssn'";
        $resultPrescriptions = mysqli_query($conn, $queryPrescriptions);

        if ($resultPrescriptions) {
            // Start the HTML table
            echo '<h2>Prescriptions for Patient SSN: ' . $patient_ssn . '</h2>';
            echo '<table>
                    <thead>
                        <tr>
                            <th>Trade Name</th>
                            <th>Dosage</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';

            // Function to calculate the total for each prescription
            function calculateTotal($amount, $price) {
                return $amount * $price;
            }

            // Variable to hold the sum of totals
            $sumOfTotals = 0;

            // Loop through the result set and display prescriptions
            while ($row = mysqli_fetch_assoc($resultPrescriptions)) {
                $total = calculateTotal($row['amount'], $row['price']);
                $sumOfTotals += $total;

                echo '<tr>
                        <td>' . $row['tradename'] . '</td>
                        <td>' . $row['dosage'] . '</td>
                        <td>' . $row['amount'] . '</td>
                        <td>' . $row['price'] . '</td>
                        <td>' . $total . '</td>
                      </tr>';
            }

            // Close the HTML table
            echo '</tbody>
                  </table>';

            // Display the sum of totals
            echo '<h3>Total Sum: ' . $sumOfTotals . '</h3>';
        } else {
            // Query execution failed
            echo 'Error: ' . mysqli_error($conn);
        }
    }
} else {
    // If patient SSN is not provided, display an error message
    echo '<h2>Error: Patient SSN not provided.</h2>';
}

// Add the "Add Prescription" button for the specified patient
?>
<form action="prescription.php" method="post">
    <input type="hidden" name="patient_ssn" value="<?php echo $patient_ssn; ?>">
    <input type="submit" value="Add Prescription">
</form>
