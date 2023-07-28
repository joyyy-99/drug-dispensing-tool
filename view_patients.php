<!DOCTYPE html>
<html>
<head>
    <title>Doctor Portal</title>
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
    <header><h1>Welcome to Dawa Drug Dispensing Tool</h1></header>
    <ul>
        <li><a href="">Dashboard</a></li>
        <li><a href="">Prescription</a></li>
        <li><a href="">Appointments</a></li>
        <li><a href="view_patients.php">Patients</a></li>
    </ul>
    <h2>Dawa Patients</h2>
    <!-- Add the "Add Patient" button to the right end of the header -->
    <div style="position: absolute; top: 10px; right: 150px;">
            <a href="register_patients.php">Add Patient</a>
        </div>

    <?php
    // Pagination variables
    $limit = 10; // Number of records to display per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
    $start = ($page - 1) * $limit; // Starting index for records

    // Search functionality
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Construct the search query
    $searchQuery = '';
    if (!empty($search)) {
        $searchQuery = "AND (patients.SSN LIKE '%$search%' OR CONCAT(patients.Firstname, ' ', patients.Lastname) LIKE '%$search%')";
    }

    // Execute the MySQL query with search and pagination
    $query = "SELECT patients.SSN, patients.Firstname, patients.Lastname, patients.Age
              FROM patients
              WHERE 1 $searchQuery
              LIMIT $start, $limit";

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Display the search form
        echo '<form method="GET" action="">
                <input type="text" name="search" placeholder="Search" value="' . htmlspecialchars($search) . '">
                <input type="submit" value="Search">
              </form>';

        // Start the HTML table
        echo '<table>
                <thead>
                  <tr>
                    <th>Patient SSN</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>';

        // Loop through the result set and display the data in table rows
        while ($row = mysqli_fetch_assoc($result)) {
            $fullName = $row['Firstname'] . ' ' . $row['Lastname'];

            echo '<tr>
                    <td>' . $row['SSN'] . '</td>
                    <td>' . $fullName . '</td>
                    <td>' . $row['Age'] . '</td>
                    <td>
                      <form action="prescription.php" method="post">
                        <input type="hidden" name="patient_ssn" value="' . $row['SSN'] . '">
                        <input type="hidden" name="patient_name" value="' . $fullName . '">
                        <input type="submit" name="create_prescription" value="Create Prescription">
                      </form>
                    </td>
                  </tr>';
        }

        // Close the HTML table
        echo '</tbody>
              </table>';

        // Pagination links
        $countQuery = "SELECT COUNT(*) AS total FROM patients  WHERE 1 $searchQuery";
        $countResult = mysqli_query($conn, $countQuery);
        $countRow = mysqli_fetch_assoc($countResult);
        $totalRecords = $countRow['total'];
        $totalPages = ceil($totalRecords / $limit);

        echo '<div style="margin-top: 10px;">';
        echo 'Page: ';
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo '<strong>' . $i . '</strong> ';
            } else {
                echo '<a href="?page=' . $i . '&search=' . urlencode($search) . '">' . $i . '</a> ';
            }
        }
        echo '</div>';
    } else {
        // Query execution failed
        echo 'Error: ' . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
