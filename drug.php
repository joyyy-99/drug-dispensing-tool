<?php
require_once 'connect.php';
session_start();

$db = $conn;
$tableName = "drugs";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tradename']) && isset($_POST['original_tradename'])) {
        $tradenameList = $_POST['tradename'];
        $originalTradenameList = $_POST['original_tradename'];

        foreach ($tradenameList as $index => $tradename) {
            // Prevent SQL injection
            $tradename = $db->real_escape_string($tradename);
            $originalTradename = $db->real_escape_string($originalTradenameList[$index]);

            $query = "UPDATE $tableName SET Tradename = '$tradename' WHERE Tradename = '$originalTradename'";
            $result = $db->query($query);

            if ($result === false) {
                echo "Error updating Tradename '$originalTradename': " . mysqli_error($db);
                exit;
            }
        }

        // Fetch the updated data
        $fetchData = fetch_data($db, $tableName, ['Tradename', 'Expirationdate', 'Price']);

        echo "Changes saved successfully!";
    } else {
        echo "No changes to save.";
    }
} else {
    // Fetch the data from the database initially
    $fetchData = fetch_data($db, $tableName, ['Tradename', 'Expirationdate', 'Price']);
}

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
    <title>Drugs Table</title>
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
    <form method="post" action="">
        <table>
            <thead>
                <tr>
                    <th>Tradename</th>
                    <th>Expirationdate</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($fetchData)) {
                    foreach ($fetchData as $data) {
                        ?>
                        <tr>
                            <td>
                                <input type="text" name="tradename[]" value="<?php echo $data['Tradename'] ?? ''; ?>">
                                <input type="hidden" name="original_tradename[]" value="<?php echo $data['Tradename'] ?? ''; ?>">
                            </td>
                            <td><?php echo $data['Expirationdate'] ?? ''; ?></td>
                            <td><?php echo $data['Price'] ?? ''; ?></td>
                        </tr>
                        <?php
                    }
                } else { 
                    ?>
                    <tr>
                        <td colspan="3">
                            <?php echo $fetchData; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>                 
            </tbody>
        </table>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
