<?php
// prescription.php

// Retrieve patient SSN and full name from the form submission
$patientSSN = $_POST['patient_ssn'];
$patientName = $_POST['patient_name'];

// Display the patient SSN and full name
echo 'Patient SSN: ' . $patientSSN . '<br>';
echo 'Patient Name: ' . $patientName . '<br>';
?>

<form action="process_prescription.php" method="post">
  <input type="hidden" name="patient_ssn" value="<?php echo $patientSSN; ?>">
  <input type="hidden" name="patient_name" value="<?php echo $patientName; ?>">
  <h2>Prescription</h2>
  <div>
    <label for="tradename_1">Trade Name:</label>
    <input type="text" name="tradename[]" id="tradename_1" required>
  </div>
  <div>
    <label for="dosage_1">Dosage:</label>
    <input type="text" name="dosage[]" id="dosage_1" required>
  </div>
  <div>
    <label for="amount_1">Amount:</label>
    <input type="text" name="amount[]" id="amount_1" required>
  </div>
  <?php
  // Display additional drug input fields if submitted data exists
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tradename'])) {
    for ($i = 1; $i < count($_POST['tradename']); $i++) {
      echo '<div>
              <label for="tradename_' . ($i + 1) . '">Trade Name:</label>
              <input type="text" name="tradename[]" id="tradename_' . ($i + 1) . '" required>
            </div>
            <div>
              <label for="dosage_' . ($i + 1) . '">Dosage:</label>
              <input type="text" name="dosage[]" id="dosage_' . ($i + 1) . '" required>
            </div>
            <div>
              <label for="amount_' . ($i + 1) . '">Amount:</label>
              <input type="text" name="amount[]" id="amount_' . ($i + 1) . '" required>
            </div>';
    }
  }
  ?>
  <div>
    <button type="button" onclick="addDrug()">Add Another Drug</button>
  </div>
  <br><br>
  <input type="submit" value="Submit Prescription">
</form>

<?php
// PHP code for dynamically adding another drug input field
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tradename'])) {
    echo '<div id="additional-drugs">';
    $drugCount = count($_POST['tradename']);
    for ($i = 1; $i < $drugCount; $i++) {
        echo '<div>
                <label for="tradename_' . ($i + 1) . '">Trade Name:</label>
                <input type="text" name="tradename[]" id="tradename_' . ($i + 1) . '" required>
              </div>
              <div>
                <label for="dosage_' . ($i + 1) . '">Dosage:</label>
                <input type="text" name="dosage[]" id="dosage_' . ($i + 1) . '" required>
              </div>
              <div>
                <label for="amount_' . ($i + 1) . '">Amount:</label>
                <input type="text" name="amount[]" id="amount_' . ($i + 1) . '" required>
              </div>';
    }
    echo '</div>';
}
?>
