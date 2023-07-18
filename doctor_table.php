<?php
require_once 'connect.php';
session_start();

$db = $conn;
$tableName = "doctors";
$columns = ['SSN', 'Firstname', 'Lastname', 'Homeaddress', 'Age', 'Emailaddress', 'Phonenumber', 'Dateofbirth', 'Speciality','Yearsofexperience','Username','Passwords'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns)
{
    if (empty($db)) {
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "columns Name must be defined in an indexed array";
    } elseif (empty($tableName)) {
        $msg = "Table Name is empty";
    } else {
        $columnName = implode(", ", $columns);
        $query = "SELECT $columnName FROM $tableName";
        $result = $db->query($query);

        if ($result == true) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_all(MYSQLI_ASSOC);
                $msg = $row;
            } else {
                $msg = "No Data Found";
            }
        } else {
            $msg = mysqli_error($db);
        }
    }
    return $msg;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctors Table</title>
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
    <div class="logged-in-user">
  Logged in as: <?php echo $_SESSION['username']; ?>
</div>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th>SSN</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Homeaddress</th>
                <th>Age</th>
                <th>Emailaddress</th>
                <th>Phonenumber</th>
                <th>Dateofbirth</th>
                <th>Speciality</th>
                <th>Yearsofexperience</th>
                <th>Username</th>
                <th>Passwords</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($fetchData)) {
                foreach ($fetchData as $data) {
                    ?>
                    <tr>
                        <td><?php echo $data['SSN'] ?? ''; ?></td>
                        <td><?php echo $data['Firstname'] ?? ''; ?></td>
                        <td><?php echo $data['Lastname'] ?? ''; ?></td>
                        <td><?php echo $data['Homeaddress'] ?? ''; ?></td>
                        <td><?php echo $data['Age'] ?? ''; ?></td> 
                        <td><?php echo $data['Emailaddress'] ?? ''; ?></td>
                        <td><?php echo $data['Phonenumber'] ?? ''; ?></td>
                        <td><?php echo $data['Dateofbirth'] ?? ''; ?></td>
                        <td><?php echo $data['Speciality'] ?? ''; ?></td>
                        <td><?php echo $data['Yearsofexperience'] ?? ''; ?></td>
                        <td><?php echo $data['Username'] ?? ''; ?></td>
                        <td><?php echo $data['Passwords'] ?? ''; ?></td>   
                    </tr>
                    <?php
                }
            } else { 
                ?>
                <tr>
                    <td colspan="12">
                        <?php echo $fetchData; ?>
                    </td>
                </tr>
                <?php
            }
            ?>                 
        </tbody>
    </table>
</body>
</html>
