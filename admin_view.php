<!DOCTYPE html>
<html>
<head>
    <title>Admin Portal</title>
    <link rel="stylesheet" href="patient_views.css">
</head>
<body>
    <header>
        <h1>Welcome to My Afya Drug Dispensing Tool</h1>
        <?php
        session_start();
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $username = $_SESSION['username'];
            echo '<div class="profile-info">';
            echo '<img class="profile-image" src="Images/profile.png" alt="Profile Picture">';
            echo 'Logged in as: ' . $username;
            echo '<br>';
            echo 'Admin';
            echo '<br>';
            echo '<a href ="logout.php"><button>Log Out </button></a>';
            echo '</div>';
        } else {
            header('Location: login.html');
            exit();
        }
        ?>
    </header>
    <div class="navbar">
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
    </div>
    <div class="pic">
    <img src="Images/doctorpic.jpg">
    </div>
</body>
</html>
