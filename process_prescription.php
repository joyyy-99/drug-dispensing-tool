<?php
require_once 'connect.php';

$tradename = $_POST['tradename'];
$amount = $_POST['amount'];
$dosage = $_POST['dosage'];
$patientSSN = $_POST['patient_ssn'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the patient SSN exists in the patients table
$checkQuery = "SELECT SSN FROM patients WHERE SSN = '$patientSSN'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Patient SSN exists, proceed with prescription insertion
    for ($i = 0; $i < count($tradename); $i++) {
        $currentTradename = $conn->real_escape_string($tradename[$i]);
        $currentAmount = $conn->real_escape_string($amount[$i]);
        $currentDosage = $conn->real_escape_string($dosage[$i]);

        // Check if the prescription already exists for the patient
        $existingQuery = "SELECT * FROM prescription WHERE `Patient SSN` = '$patientSSN' AND Tradename = '$currentTradename' AND amount = '$currentAmount' AND Dosage = '$currentDosage'";
        $existingResult = $conn->query($existingQuery);

        if ($existingResult->num_rows > 0) {
            echo "Prescription already exists for the patient: $patientSSN with Tradename: $currentTradename, amount: $currentAmount, and Dosage: $currentDosage<br>";
        } else {
            // Insert the prescription
            $sql = "INSERT INTO prescription (`Tradename`, `amount`, `Dosage`, `Patient SSN`) 
                    VALUES ('$currentTradename', '$currentAmount', '$currentDosage', '$patientSSN')";

            if ($conn->query($sql) === true) {
                echo "Prescription added successfully for the patient: $patientSSN<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        }
    }
} else {
    echo "Error: Patient SSN does not exist in the database.";
}

$conn->close();
?>
