<?php
require_once 'connect.php';
session_start();

$db = $conn;
$tableName = "patients";
$columns = ['SSN', 'Firstname', 'Lastname', 'Homeaddress', 'Age', 'Emailaddress', 'Phonenumber', 'Dateofbirth','Username','Passwords'];
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

// Edit User Information
if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $editUserQuery = "SELECT * FROM $tableName WHERE SSN = '$editId'";
    $editResult = $db->query($editUserQuery);

    if ($editResult->num_rows == 1) {
        $editData = $editResult->fetch_assoc();
        // Display the form with the existing user information prepopulated
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit User</title>
            <!-- Add your CSS styling here -->
        </head>
        <body>
            <h2>Edit User</h2>
            <form action="login.php" method="post">
                <!-- Include the necessary input fields and values -->
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $editData['Username']; ?>" required><br><br>
                <!-- Add other input fields for editing user information -->
                <input type="submit" value="Update">
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "User not found.";
    }
}

// Update User Information
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    // Retrieve other input field values and update the user information in the database
    // Add your code here
    // After updating, redirect to the page that displays the user information
    header("Location: login.php");
    exit;
}

// Delete User
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteUserQuery = "DELETE FROM $tableName WHERE SSN = '$deleteId'";
    $deleteResult = $db->query($deleteUserQuery);

    if ($deleteResult === true) {
        // User deleted successfully
        // Redirect to the page that displays the user information or any other appropriate page
        header("Location: login.php");
        exit;
    } else {
        echo "Failed to delete user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patients Table</title>
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
                <th>Username</th>
                <th>Passwords</th>
                <th>Edit</th>
                <th>Delete</th>
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
                        <td><?php echo $data['Username'] ?? ''; ?></td>
                        <td><?php echo $data['Passwords'] ?? ''; ?></td>
                        <td>
                            <a href="login.php?edit_id=<?php echo $data['SSN']; ?>">Edit</a>
                        </td>
                        <td>
                            <a href="login.php?delete_id=<?php echo $data['SSN']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
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
<?php
require_once 'connect.php';


$db = $conn;
$tableName = "doctors";
$columns = ['SSN', 'Firstname', 'Lastname', 'Homeaddress', 'Age', 'Emailaddress', 'Phonenumber', 'Dateofbirth', 'Speciality','Yearsofexperience','Username','Passwords'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_doctor_data($db, $tableName, $columns)
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
