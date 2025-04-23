<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Fitness Center</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="manage_user.php">Manage Members</a></li>
                <li><a href="manage_instructors.php">Manage Instructors</a></li>
                <li><a href="manage_classes.php">Manage Classes</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="payments.php">Payment History</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        
        <main class="content">
        <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
            <div class="dashboard-stats">
                <div class="stat-box">
                    <h3>Total Members</h3>
                    <p>250</p>
                </div>
                <div class="stat-box">
                    <h3>Active Instructors</h3>
                    <p>12</p>
                </div>
                <div class="stat-box">
                    <h3>Today's Classes</h3>
                    <p>8</p>
                </div>
                <div class="stat-box">
                    <h3>Monthly Revenue</h3>
                    <p>$15,000</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>